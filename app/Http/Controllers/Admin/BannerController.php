<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::first();
        return view('admin.banners.index', compact('banner'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
            'background_color' => 'required|string|max:50',
        ]);

        $banner = Banner::first() ?? new Banner();
        $banner->message = $request->message;
        $banner->background_color = $request->background_color;
        $banner->is_active = $request->has('is_active');
        $banner->save();

        return redirect()->route('admin.banner.index')->with('success', 'Banner updated successfully!');
    }
}
