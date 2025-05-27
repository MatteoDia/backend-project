<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::with('items')->get();
        return view('faq.index', compact('categories'));
    }

    public function show(FaqCategory $category)
    {
        return view('faq.show', compact('category'));
    }
} 