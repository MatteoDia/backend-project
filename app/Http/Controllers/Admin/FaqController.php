<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use App\Models\FaqItem;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::with('items')->get();
        return view('admin.faq.index', compact('categories'));
    }

    public function create()
    {
        $categories = FaqCategory::all();
        return view('admin.faq.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        FaqCategory::create([
            'name' => $validated['category_name'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'FAQ categorie succesvol aangemaakt.');
    }

    public function edit(FaqCategory $category)
    {
        return view('admin.faq.edit', compact('category'));
    }

    public function update(Request $request, FaqCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'FAQ categorie succesvol bijgewerkt.');
    }

    public function destroy(FaqCategory $category)
    {
        $category->delete();

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'FAQ categorie succesvol verwijderd.');
    }

    // FAQ Items methods
    public function storeItem(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        FaqItem::create($validated);

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'FAQ vraag succesvol toegevoegd.');
    }

    public function updateItem(Request $request, FaqItem $item)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $item->update($validated);

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'FAQ vraag succesvol bijgewerkt.');
    }

    public function destroyItem(FaqItem $item)
    {
        $item->delete();

        return redirect()->route('admin.faq.categories.index')
            ->with('success', 'FAQ vraag succesvol verwijderd.');
    }
} 