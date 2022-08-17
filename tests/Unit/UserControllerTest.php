<?php

namespace Tests\Unit;

use App\Models\User;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_block_user()
    {
        $admin = User::factory()->create();
        $admin->role = 1;
        $admin->save();

        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $this->post('/dashboard/users/modify',[
            'id' => $user->id,
            'action' => 'block'
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'role' => 2,
        ]);
    }
    public function test_unblock_user()
    {
        $admin = User::factory()->create();
        $admin->role = 1;
        $admin->save();

        $user = User::factory()->create();
        $user->role = 2;
        $user->save();

        $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $this->post('/dashboard/users/modify',[
            'id' => $user->id,
            'action' => 'unblock'
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'role' => 0,
        ]);
    }
    public function test_remove_user()
    {
        $admin = User::factory()->create();
        $admin->role = 1;
        $admin->save();

        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $this->post('/dashboard/users/modify',[
            'id' => $user->id,
            'action' => 'remove'
        ]);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}
