<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoyaltyLevel;
use App\Models\User;

class LoyaltyAdminController extends Controller
{
    public function index()
    {
        // Только админ
        if (auth()->user()?->is_admin != true) {
            abort(403);
        }

        $levels = LoyaltyLevel::orderBy('min_spending')->get();
        $settings = \App\Models\LoyaltySetting::first();

        return view('cabinet.loyalty_admin', compact('levels', 'settings'));
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

