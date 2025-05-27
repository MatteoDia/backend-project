<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = NewsItem::with('author')->latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('news', 'public');

        $news = NewsItem::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'author_id' => auth()->id(),
        ]);

        return redirect()->route('admin.news.index')->with('success', 'News item created successfully.');
    }

    public function edit(NewsItem $newsItem)
    {
        return view('admin.news.edit', compact('newsItem'));
    }

    public function update(Request $request, NewsItem $newsItem)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($newsItem->image);
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $newsItem->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'News item updated successfully.');
    }

    public function destroy(NewsItem $newsItem)
    {
        Storage::disk('public')->delete($newsItem->image);
        $newsItem->delete();

        return redirect()->route('admin.news.index')->with('success', 'News item deleted successfully.');
    }

    public function togglePublish(NewsItem $newsItem)
    {
        $newsItem->update(['published' => !$newsItem->published]);

        return back()->with('success', 'News item publication status updated.');
    }
} 