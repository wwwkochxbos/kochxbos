<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Exhibition;
use App\Models\News;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'artists' => Artist::count(),
            'exhibitions' => Exhibition::count(),
            'artworks' => Artwork::count(),
            'available' => Artwork::where('is_available', true)->where('is_sold', false)->count(),
            'products' => Product::count(),
            'news' => News::count(),
            'orders' => Order::count(),
        ];

        $recentExhibitions = Exhibition::orderByDesc('created_at')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentExhibitions'));
    }
}
