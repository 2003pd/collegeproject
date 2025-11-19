<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|string',
        ]);

        // ✅ Upload image if available
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blogs', 'public');
        }

        // ✅ Handle YouTube embed URL conversion
        $videoUrl = $request->video_url;
        if ($videoUrl) {
            $videoUrl = trim($videoUrl);
            if (Str::contains($videoUrl, 'watch?v=')) {
                $videoUrl = str_replace('watch?v=', 'embed/', $videoUrl);
            } elseif (Str::contains($videoUrl, 'youtu.be/')) {
                $videoUrl = str_replace('youtu.be/', 'www.youtube.com/embed/', $videoUrl);
            } elseif (Str::contains($videoUrl, 'shorts/')) {
                $videoUrl = str_replace('shorts/', 'embed/', $videoUrl);
            }
        }

        // ✅ Save to database
        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path,
            'video_url' => $videoUrl,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog added successfully!');
    }
}
