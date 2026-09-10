<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class AuditProductImages extends Command
{
    protected $signature = 'products:audit-images';

    protected $description = 'Проверяет доступность изображений товаров, не изменяя БД';

    public function handle(): int
    {
        $products = Product::query()
            ->select('id', 'name', 'image')
            ->get();

        $total = $products->count();

        $ok = 0;
        $broken = 0;
        $empty = 0;
        $notImage = 0;

        $brokenProducts = [];

        $this->info("Найдено товаров: {$total}");
        $this->newLine();

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        foreach ($products as $product) {

            // Если картинки вообще нет
            if (empty($product->image)) {
                $empty++;

                $brokenProducts[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'url' => '',
                    'reason' => 'EMPTY',
                    'status' => '',
                    'content_type' => '',
                ];

                $bar->advance();
                continue;
            }

            try {
                $response = Http::withoutVerifying()
    ->timeout(15)
    ->connectTimeout(10)
    ->withHeaders([
        'User-Agent' => 'Mozilla/5.0',
        'Accept' => 'image/avif,image/webp,image/apng,image/svg+xml,image/*,*/*;q=0.8',
    ])
    ->get($product->image);

                $status = $response->status();

                $contentType = strtolower(
                    $response->header('Content-Type') ?? ''
                );

                // ВАЖНО:
                // одного 200 недостаточно.
                // Сервер Smorodina иногда отдаёт HTML с кодом 200.
                $isImage = str_starts_with($contentType, 'image/');

                if ($response->successful() && $isImage) {
                    $ok++;
                } else {
                    if ($response->successful() && !$isImage) {
                        $notImage++;
                        $reason = 'NOT_IMAGE';
                    } else {
                        $broken++;
                        $reason = 'HTTP_ERROR';
                    }

                    $brokenProducts[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'url' => $product->image,
                        'reason' => $reason,
                        'status' => $status,
                        'content_type' => $contentType,
                    ];
                }

            } catch (\Throwable $e) {
                $broken++;

                $brokenProducts[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'url' => $product->image,
                    'reason' => 'EXCEPTION: ' . $e->getMessage(),
                    'status' => '',
                    'content_type' => '',
                ];
            }

            $bar->advance();
        }

        $bar->finish();

        $this->newLine(2);

        /*
        |--------------------------------------------------------------------------
        | Сохраняем CSV с проблемными товарами
        |--------------------------------------------------------------------------
        */

        $csvPath = storage_path('app/broken_product_images.csv');

        $file = fopen($csvPath, 'w');

        // BOM, чтобы Excel нормально понимал UTF-8
        fwrite($file, "\xEF\xBB\xBF");

        fputcsv(
            $file,
            [
                'ID',
                'Название товара',
                'URL',
                'Причина',
                'HTTP status',
                'Content-Type',
            ],
            ';'
        );

        foreach ($brokenProducts as $item) {
            fputcsv(
                $file,
                [
                    $item['id'],
                    $item['name'],
                    $item['url'],
                    $item['reason'],
                    $item['status'],
                    $item['content_type'],
                ],
                ';'
            );
        }

        fclose($file);

        /*
        |--------------------------------------------------------------------------
        | Итог
        |--------------------------------------------------------------------------
        */

        $this->info('=== РЕЗУЛЬТАТ ===');
        $this->line("Всего товаров:       {$total}");
        $this->line("<fg=green>Живые картинки:      {$ok}</>");
        $this->line("<fg=red>HTTP-ошибки:         {$broken}</>");
        $this->line("<fg=yellow>200, но НЕ картинка: {$notImage}</>");
        $this->line("<fg=yellow>Пустое поле image:   {$empty}</>");

        $problemCount = count($brokenProducts);

        $this->newLine();

        if ($problemCount === 0) {
            $this->info('🎉 ВСЕ КАРТИНКИ ЖИВЫ.');
        } else {
            $percent = $total > 0
                ? round(($problemCount / $total) * 100, 1)
                : 0;

            $this->warn(
                "Проблемных изображений: {$problemCount} из {$total} ({$percent}%)"
            );

            $this->line("CSV сохранён:");
            $this->line($csvPath);
        }

        return self::SUCCESS;
    }
}
