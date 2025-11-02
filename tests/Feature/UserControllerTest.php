<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $regularUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'level' => User::LEVEL_ADMIN,
            'status' => User::STATUS_ACTIVE,
        ]);

        $this->regularUser = User::factory()->create([
            'level' => User::LEVEL_USER,
            'status' => User::STATUS_ACTIVE,
        ]);
    }

    /** @test */
    public function admin_can_view_users_index_page()
    {
        $response = $this->actingAs($this->admin)->get('/users');

        $response->assertStatus(200);
        $response->assertViewIs('users.index');
    }

    /** @test */
    public function admin_can_view_create_user_page()
    {
        $response = $this->actingAs($this->admin)->get('/users/create');

        $response->assertStatus(200);
        $response->assertViewIs('users.create');
    }

    /** @test */
    public function admin_can_create_user()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'newuser@example.com',
            'password' => 'Password123',
            'phone' => '123456789',
            'level' => User::LEVEL_USER,
            'blood_type' => 'O+',
        ];

        $response = $this->actingAs($this->admin)->post('/users', $userData);

        $response->assertRedirect('/users');
        $response->assertSessionHas('success');
        
        $this->assertDatabaseHas('users', [
            'email' => 'newuser@example.com',
            'name' => 'Test User',
        ]);
    }

    /** @test */
    public function admin_can_view_edit_user_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($this->admin)->get("/users/{$user->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
        $response->assertViewHas('user', $user);
    }

    /** @test */
    public function admin_can_update_user()
    {
        $user = User::factory()->create();

        $updateData = [
            'name' => 'Updated Name',
            'email' => $user->email,
            'phone' => '987654321',
            'level' => User::LEVEL_ADMIN,
            'blood_type' => 'A+',
            'status' => User::STATUS_ACTIVE,
        ];

        $response = $this->actingAs($this->admin)->put("/users/{$user->id}", $updateData);

        $response->assertRedirect('/users');
        $response->assertSessionHas('success');
        
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'level' => User::LEVEL_ADMIN,
        ]);
    }

    /** @test */
    public function admin_can_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($this->admin)->delete("/users/{$user->id}");

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function admin_can_get_users_data_for_datatables()
    {
        User::factory()->count(5)->create();

        $response = $this->actingAs($this->admin)->get('/api/users');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'nome', 'user_id', 'level', 'ativo']
        ]);
    }

    /** @test */
    public function regular_user_cannot_access_user_management()
    {
        $response = $this->actingAs($this->regularUser)->get('/users');

        $response->assertRedirect('/dashboard');
        $response->assertSessionHas('error');
    }

    /** @test */
    public function guest_cannot_access_user_management()
    {
        $response = $this->get('/users');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function email_must_be_unique_when_creating_user()
    {
        $existingUser = User::factory()->create(['email' => 'existing@example.com']);

        $userData = [
            'name' => 'Test User',
            'email' => 'existing@example.com',
            'password' => 'Password123',
            'level' => User::LEVEL_USER,
        ];

        $response = $this->actingAs($this->admin)->post('/users', $userData);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function password_must_meet_requirements()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'short',
            'level' => User::LEVEL_USER,
        ];

        $response = $this->actingAs($this->admin)->post('/users', $userData);

        $response->assertSessionHasErrors('password');
    }
}
