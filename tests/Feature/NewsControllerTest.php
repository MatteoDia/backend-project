<?php

namespace Tests\Feature;

use App\Models\NewsItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_nieuws_pagina_kan_worden_bekeken(): void
    {
        $response = $this->get('/news');
        $response->assertStatus(200);
    }

    public function test_nieuws_item_details_kunnen_worden_bekeken(): void
    {
        $newsItem = NewsItem::factory()->create([
            'title' => 'Test Nieuws',
            'content' => 'Dit is test nieuws content'
        ]);

        $response = $this->get("/news/{$newsItem->id}");
        
        $response->assertStatus(200)
            ->assertSee('Test Nieuws')
            ->assertSee('Dit is test nieuws content');
    }

    public function test_alleen_admin_kan_nieuws_maken(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true
        ]);

        $normalUser = User::factory()->create([
            'is_admin' => false
        ]);

        $newsData = [
            'title' => 'Nieuw Artikel',
            'content' => 'Dit is de inhoud van het nieuwe artikel'
        ];

        // Test met normale gebruiker
        $this->actingAs($normalUser)
            ->post('/admin/news', $newsData)
            ->assertStatus(403);

        // Test met admin
        $this->actingAs($admin)
            ->post('/admin/news', $newsData)
            ->assertRedirect();

        $this->assertDatabaseHas('news_items', [
            'title' => 'Nieuw Artikel'
        ]);
    }
} 