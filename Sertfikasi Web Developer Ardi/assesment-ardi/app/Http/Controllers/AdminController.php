<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalValue    = Product::sum('harga');
        $avgPrice      = Product::avg('harga');

        // Kartu statistik ala SB: ambil dari DB
        $now = now();
        $earnMonthly = Product::whereYear('created_at', $now->year)
                              ->whereMonth('created_at', $now->month)
                              ->sum('harga');
        $earnAnnual  = Product::whereYear('created_at', $now->year)->sum('harga');
        $withThumb   = Product::whereNotNull('thumbnail')->count();
        $tasksPct    = (int) round(($withThumb / max($totalProducts,1)) * 100);
        $pendingReq  = Product::whereNull('thumbnail')->count();

        // Grafik (dummy penjualan bulanan + komposisi produk)
        $months   = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $lineData = [5,9,7,11,12,8,15,13,18,20,22,25];

        $pieLabels = ['Iphone','Samsung','Xiaomi'];
        $pieData   = [
            Product::where('product','Iphone')->count(),
            Product::where('product','Samsung')->count(),
            Product::where('product','Xiaomi')->count(),
        ];

        return view('dashboard', compact(
            'totalProducts','totalValue','avgPrice',
            'earnMonthly','earnAnnual','tasksPct','pendingReq',
            'months','lineData','pieLabels','pieData'
        ));
    }
}
