<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_gebruiker_kan_profiel_bekijken(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/profile');

        $response->assertStatus(200)
            ->assertSee($user->name)
            ->assertSee($user->email);
    }

    public function test_gebruiker_kan_profiel_bijwerken(): void
    {
        $user = User::factory()->create();

        $updatedData = [
            'name' => 'Nieuwe Naam',
            'email' => 'nieuw@example.com',
        ];

        $response = $this->actingAs($user)
            ->patch('/profile', $updatedData);

        $response->assertRedirect();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Nieuwe Naam',
            'email' => 'nieuw@example.com'
        ]);
    }

    public function test_admin_kan_gebruikers_bekijken(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true
        ]);

        $normalUser = User::factory()->create([
            'name' => 'Test Gebruiker'
        ]);

        $response = $this->actingAs($admin)
            ->get('/admin/users');

        $response->assertStatus(200)
            ->assertSee('Test Gebruiker');
    }

    public function test_alleen_admin_kan_gebruiker_verwijderen(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true
        ]);

        $userToDelete = User::factory()->create();

        $normalUser = User::factory()->create();

        // Test met normale gebruiker
        $this->actingAs($normalUser)
            ->delete("/admin/users/{$userToDelete->id}")
            ->assertStatus(403);

        // Test met admin
        $this->actingAs($admin)
            ->delete("/admin/users/{$userToDelete->id}")
            ->assertRedirect();

        $this->assertDatabaseMissing('users', [
            'id' => $userToDelete->id
        ]);
    }
} 