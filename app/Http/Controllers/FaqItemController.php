<?php

namespace App\Http\Controllers;

use App\Models\FaqItem;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqItemController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function create()
    {
        $categories = FaqCategory::all();
        return view('faq.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string'
        ]);

        $maxOrder = FaqItem::where('category_id', $request->category_id)->max('order') ?? 0;
        $validated['order'] = $maxOrder + 1;

        FaqItem::create($validated);

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ item created successfully.');
    }

    public function edit(FaqItem $faqItem)
    {
        $categories = FaqCategory::all();
        return view('faq.items.edit', compact('faqItem', 'categories'));
    }

    public function update(Request $request, FaqItem $faqItem)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string'
        ]);

        if ($request->category_id !== $faqItem->category_id) {
            $maxOrder = FaqItem::where('category_id', $request->category_id)->max('order') ?? 0;
            $validated['order'] = $maxOrder + 1;
        }

        $faqItem->update($validated);

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ item updated successfully.');
    }

    public function destroy(FaqItem $faqItem)
    {
        $faqItem->delete();

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ item deleted successfully.');
    }

    public function moveUp(FaqItem $faqItem)
    {
        $faqItem->moveUp();
        return back()->with('success', 'FAQ item moved up successfully.');
    }

    public function moveDown(FaqItem $faqItem)
    {
        $faqItem->moveDown();
        return back()->with('success', 'FAQ item moved down successfully.');
    }
} 