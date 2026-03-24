<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Artwork;
use App\Models\Exhibition;
use App\Models\News;

class HomeController extends Controller
{
    public function index()
    {
        $currentExhibition = Exhibition::now()->with('artists')->first();
        $upcomingExhibitions = Exhibition::soon()->with('artists')->orderBy('start_date')->get();
        $artists = Artist::where('is_active', true)->orderBy('sort_order')->get();
        $news = News::published()->orderByDesc('published_at')->take(6)->get();
        $availableWorks = Artwork::where('is_available', true)
            ->where('is_sold', false)
            ->with('artist')
            ->take(8)
            ->get();

        return view('home', compact(
            'currentExhibition',
            'upcomingExhibitions',
            'artists',
            'news',
            'availableWorks'
        ));
    }
}
