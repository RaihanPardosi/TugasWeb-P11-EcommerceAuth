<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EagerDemoController extends Controller
{
    private const LIMIT = 25;

    public function __invoke(): View
    {
        $lazy = $this->measure(function () {
            $products = Product::query()->orderBy('id')->limit(self::LIMIT)->get();

            foreach ($products as $product) {
                $product->category->name;
                $product->brand?->name;
            }
        });

        $eager = $this->measure(function () {
            $products = Product::query()->with(['category', 'brand'])->orderBy('id')->limit(self::LIMIT)->get();

            foreach ($products as $product) {
                $product->category->name;
                $product->brand?->name;
            }
        });

        return view('manage.eager-demo', [
            'lazy' => $lazy,
            'eager' => $eager,
            'limit' => self::LIMIT,
        ]);
    }

    private function measure(Closure $callback): array
    {
        DB::flushQueryLog();
        DB::enableQueryLog();

        $start = hrtime(true);
        $callback();
        $milliseconds = (hrtime(true) - $start) / 1_000_000;

        $queries = DB::getQueryLog();
        DB::disableQueryLog();

        return [
            'count' => count($queries),
            'ms' => round($milliseconds, 2),
            'samples' => array_slice(array_column($queries, 'query'), 0, 4),
        ];
    }
}
