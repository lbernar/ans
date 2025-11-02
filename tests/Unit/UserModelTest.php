<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_check_if_user_is_admin()
    {
        $admin = User::factory()->create([
            'level' => User::LEVEL_ADMIN,
        ]);

        $user = User::factory()->create([
            'level' => User::LEVEL_USER,
        ]);

        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($user->isAdmin());
    }

    /** @test */
    public function it_can_check_if_user_is_active()
    {
        $activeUser = User::factory()->create([
            'status' => User::STATUS_ACTIVE,
        ]);

        $inactiveUser = User::factory()->create([
            'status' => User::STATUS_INACTIVE,
        ]);

        $this->assertTrue($activeUser->isActive());
        $this->assertFalse($inactiveUser->isActive());
    }

    /** @test */
    public function it_returns_correct_level_name()
    {
        $admin = User::factory()->create([
            'level' => User::LEVEL_ADMIN,
        ]);

        $user = User::factory()->create([
            'level' => User::LEVEL_USER,
        ]);

        $this->assertEquals('Administrador', $admin->level_name);
        $this->assertEquals('Usuário', $user->level_name);
    }

    /** @test */
    public function it_returns_correct_status_name()
    {
        $activeUser = User::factory()->create([
            'status' => User::STATUS_ACTIVE,
        ]);

        $inactiveUser = User::factory()->create([
            'status' => User::STATUS_INACTIVE,
        ]);

        $this->assertEquals('Ativo', $activeUser->status_name);
        $this->assertEquals('Inativo', $inactiveUser->status_name);
    }

    /** @test */
    public function it_hashes_password_on_creation()
    {
        $user = User::factory()->create([
            'password' => 'password123',
        ]);

        $this->assertTrue(Hash::check('password123', $user->password));
    }

    /** @test */
    public function it_returns_all_available_levels()
    {
        $levels = User::getLevels();

        $this->assertIsArray($levels);
        $this->assertArrayHasKey(User::LEVEL_USER, $levels);
        $this->assertArrayHasKey(User::LEVEL_ADMIN, $levels);
        $this->assertEquals('Usuário', $levels[User::LEVEL_USER]);
        $this->assertEquals('Administrador', $levels[User::LEVEL_ADMIN]);
    }

    /** @test */
    public function it_returns_all_available_statuses()
    {
        $statuses = User::getStatuses();

        $this->assertIsArray($statuses);
        $this->assertArrayHasKey(User::STATUS_INACTIVE, $statuses);
        $this->assertArrayHasKey(User::STATUS_ACTIVE, $statuses);
        $this->assertEquals('Inativo', $statuses[User::STATUS_INACTIVE]);
        $this->assertEquals('Ativo', $statuses[User::STATUS_ACTIVE]);
    }
}
