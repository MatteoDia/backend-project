<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class NewsController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(['auth', 'admin'])->only(['create', 'store', 'edit', 'update', 'destroy', 'adminIndex', 'togglePublish']);
    }

    public function index()
    {
        $newsItems = NewsItem::with('author')
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('news.index', compact('newsItems'));
    }

    public function adminIndex()
    {
        $newsItems = NewsItem::with('author')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.news.index', compact('newsItems'));
    }

    public function show(NewsItem $newsItem)
    {
        if (!$newsItem->is_published && !auth()->user()?->isAdmin()) {
            abort(404);
        }

        return view('news.show', compact('newsItem'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $validated['author_id'] = auth()->id();
        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        NewsItem::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'News item created successfully.');
    }

    public function edit(NewsItem $newsItem)
    {
        return view('admin.news.edit', compact('newsItem'));
    }

    public function update(Request $request, NewsItem $newsItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($newsItem->image) {
                Storage::disk('public')->delete($newsItem->image);
            }
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $wasPublished = $newsItem->is_published;
        $willBePublished = $request->has('is_published');

        $validated['is_published'] = $willBePublished;
        
        if (!$wasPublished && $willBePublished) {
            $validated['published_at'] = now();
        } elseif ($wasPublished && !$willBePublished) {
            $validated['published_at'] = null;
        }

        $newsItem->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'News item updated successfully.');
    }

    public function destroy(NewsItem $newsItem)
    {
        if ($newsItem->image) {
            Storage::disk('public')->delete($newsItem->image);
        }

        $newsItem->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News item deleted successfully.');
    }

    public function togglePublish(NewsItem $newsItem)
    {
        $newsItem->update([
            'is_published' => !$newsItem->is_published,
            'published_at' => !$newsItem->is_published ? now() : null
        ]);

        return redirect()->route('admin.news.index')
            ->with('success', 'News item ' . ($newsItem->is_published ? 'published' : 'unpublished') . ' successfully.');
    }
} 