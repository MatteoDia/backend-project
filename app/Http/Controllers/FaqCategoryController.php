<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin'])->except(['index']);
    }

    public function index()
    {
        $categories = FaqCategory::with('faqItems')->get();
        return view('faq.index', compact('categories'));
    }

    public function create()
    {
        return view('faq.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        FaqCategory::create($validated);

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ category created successfully.');
    }

    public function edit(FaqCategory $category)
    {
        return view('faq.categories.edit', compact('category'));
    }

    public function update(Request $request, FaqCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category->update($validated);

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ category updated successfully.');
    }

    public function destroy(FaqCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ category deleted successfully.');
    }
} 