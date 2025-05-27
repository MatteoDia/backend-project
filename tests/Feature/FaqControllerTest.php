<?php

namespace Tests\Feature;

use App\Models\FaqCategory;
use App\Models\FaqItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_faq_pagina_toont_categorien_en_vragen(): void
    {
        $category = FaqCategory::factory()->create([
            'name' => 'Algemene Vragen'
        ]);

        $faqItem = FaqItem::factory()->create([
            'faq_category_id' => $category->id,
            'question' => 'Wat is dit voor website?',
            'answer' => 'Dit is een informatieve website.'
        ]);

        $response = $this->get('/faq');

        $response->assertStatus(200)
            ->assertSee('Algemene Vragen')
            ->assertSee('Wat is dit voor website?')
            ->assertSee('Dit is een informatieve website.');
    }

    public function test_admin_kan_faq_categorie_aanmaken(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true
        ]);

        $categoryData = [
            'name' => 'Nieuwe Categorie',
            'description' => 'Een nieuwe FAQ categorie'
        ];

        $this->actingAs($admin)
            ->post('/admin/faq/categories', $categoryData)
            ->assertRedirect();

        $this->assertDatabaseHas('faq_categories', [
            'name' => 'Nieuwe Categorie'
        ]);
    }

    public function test_admin_kan_faq_vraag_toevoegen(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true
        ]);

        $category = FaqCategory::factory()->create();

        $faqData = [
            'faq_category_id' => $category->id,
            'question' => 'Nieuwe Vraag?',
            'answer' => 'Dit is het antwoord.'
        ];

        $this->actingAs($admin)
            ->post('/admin/faq/items', $faqData)
            ->assertRedirect();

        $this->assertDatabaseHas('faq_items', [
            'question' => 'Nieuwe Vraag?'
        ]);
    }
} 