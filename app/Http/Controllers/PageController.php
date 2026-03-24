<?php

namespace App\Http\Controllers;

use App\Models\PressItem;

class PageController extends Controller
{
    public function info()
    {
        return view('pages.info');
    }

    public function press()
    {
        $pressItems = PressItem::orderByDesc('published_at')->paginate(20);
        return view('pages.press', compact('pressItems'));
    }
}
