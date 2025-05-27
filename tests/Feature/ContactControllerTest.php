<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_formulier_kan_worden_bekeken(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }

    public function test_bericht_kan_worden_verstuurd(): void
    {
        $messageData = [
            'name' => 'Test Gebruiker',
            'email' => 'test@example.com',
            'subject' => 'Test Onderwerp',
            'message' => 'Dit is een test bericht.'
        ];

        $response = $this->post('/contact', $messageData);

        $response->assertRedirect();

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Test Gebruiker',
            'email' => 'test@example.com'
        ]);
    }

    public function test_admin_kan_berichten_bekijken(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true
        ]);

        $message = ContactMessage::factory()->create([
            'subject' => 'Test Contact Bericht'
        ]);

        $response = $this->actingAs($admin)->get('/admin/contact');

        $response->assertStatus(200)
            ->assertSee('Test Contact Bericht');
    }

    public function test_admin_kan_bericht_verwijderen(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true
        ]);

        $message = ContactMessage::factory()->create();

        $this->actingAs($admin)
            ->delete("/admin/contact/{$message->id}")
            ->assertRedirect();

        $this->assertDatabaseMissing('contact_messages', [
            'id' => $message->id
        ]);
    }
} 