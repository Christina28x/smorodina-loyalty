<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoyaltyLevel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use App\Models\Product;


class LoyaltyAdminController extends Controller
{
    public function index()
    {
        // Только админ
        if (auth()->user()?->is_admin != true) {
            abort(403);
        }

        $user = Auth::user();
        $orderCount = $user->orders()->count();
        $levels = LoyaltyLevel::orderBy('min_spending')->get();
        $settings = \App\Models\LoyaltySetting::first();

        $topCategories = \App\Models\Discount::select('target_id', \DB::raw('count(*) as total'))
            ->groupBy('target_id')
            ->orderByDesc('total')
            ->with('target')
            ->take(3)
            ->get();

        $categoryStats = \App\Models\Discount::select('target_id', \DB::raw('count(*) as total'))
            ->groupBy('target_id')
            ->with('target')
            ->get()
            ->filter(fn($item) => $item->target); // чтобы не было null

        $chartLabels = $categoryStats->pluck('target.rus_name');
        $chartData = $categoryStats->pluck('total');
        $topThree = $categoryStats->sortByDesc('total')->take(3);


        $loyaltyDistribution = User::select('loyalty_level_id', \DB::raw('count(*) as total'))
            ->groupBy('loyalty_level_id')
            ->with('loyaltyLevel') // связь user → loyaltyLevel
            ->get();

        $levelLabels = $loyaltyDistribution->map(fn($item) => $item->loyaltyLevel->level_name)->toArray();
        $levelData = $loyaltyDistribution->map(fn($item) => $item->total)->toArray();

        
        $ordersWithBonuses = Order::where('bonus_used', '>', 0)->count();
        $ordersWithoutBonuses = Order::where('bonus_used', 0)->count();

        $bonusUsageLabels = ['С бонусами', 'Без бонусов'];
        $bonusUsageData = [$ordersWithBonuses, $ordersWithoutBonuses];


        $productId = 42; // выбери ID продукта
        $product = Product::findOrFail($productId);
        $salesPerMonth = [];

        $months = ['2025-03', '2025-04', '2025-05', '2025-06'];

        foreach ($months as $month) {
            $start = Carbon::parse($month)->startOfMonth();
            $end = Carbon::parse($month)->endOfMonth();

            $total = OrderItem::where('product_id', $productId)
                ->whereHas('order', function ($q) use ($start, $end) {
                    $q->whereBetween('created_at', [$start, $end]);
                })
                ->sum('quantity');

            $salesPerMonth[] = $total;
        }

        // Получаем прогноз на июнь
        $forecast = $this->exponentialSmoothing($salesPerMonth);
        $forecastForJune = end($forecast);

        $monthLabels = ['Март', 'Апрель', 'Май', 'Июнь', 'Июль (прогноз)'];
        $monthData = array_merge($salesPerMonth, [round($forecastForJune)]);


        return view('cabinet.loyalty_admin', compact('levels', 'settings', 'orderCount',
         'topCategories', 'chartLabels','chartData','topThree', 'product',
         'levelLabels', 'levelData', 'bonusUsageLabels','bonusUsageData', 'monthLabels','monthData'));
    }

    function exponentialSmoothing(array $data, float $alpha = 0.6): array {
        $forecast = [$data[0]]; // первое значение = начальный прогноз

        for ($i = 1; $i < count($data); $i++) {
            $forecast[] = $alpha * $data[$i - 1] + (1 - $alpha) * $forecast[$i - 1];
        }

        return $forecast;
    }


    public function update(Request $request)
    {
        if (auth()->user()?->is_admin != true) {
            abort(403);
        }

        foreach ($request->levels as $id => $data) {
            $level = LoyaltyLevel::find($id);
            if ($level) {
                $level->update([
                    'level_name'     => $data['level_name'],
                    'min_spending'   => $data['min_spending'],
                    'bonus_percent'  => $data['bonus_percent'],
                    'description'    => match ((int) $level->id) {
                        1 => "<p>{$data['bonus_percent']}% от суммы заказа в виде бонусных баллов, доступен сразу после регистрации.</p>",
                        2 => "<p>{$data['bonus_percent']}% от суммы заказа в виде бонусных баллов. Присваивается при общей сумме покупок от {$data['min_spending']} рублей.</p>",
                        3 => "<p>{$data['bonus_percent']}% от суммы заказа. Присваивается при покупках от {$data['min_spending']} ₽, <b>ранний доступ к новинкам</b>.</p>",
                        default => '',
                    }
                ]);
            }
        }

        // Пересчёт уровня у всех пользователей
        $users = User::all();
        $levels = LoyaltyLevel::orderByDesc('min_spending')->get();

        foreach ($users as $user) {
            foreach ($levels as $level) {
                if ($user->total_spent >= $level->min_spending) {
                    $user->loyalty_level_id = $level->id;
                    $user->save();
                    break;
                }
            }
        }

        $settings = \App\Models\LoyaltySetting::first();
        $settings->update([
            'recommendations_enabled' => $request->has('recommendations_enabled'),
            'discount_choice_enabled' => $request->has('discount_choice_enabled'),
        ]);

        return redirect()->back()->with('success', 'Уровни лояльности обновлены');
    }
}

