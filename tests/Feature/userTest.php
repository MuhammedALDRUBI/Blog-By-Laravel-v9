<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class userTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        User::create([
            'name' => "Muhammed1",
            'email' => "aldroubim7@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
        ]);
//        $this->assertDatabaseHas('users', [
//            'email' => 'aldroubim88@gmail.com',
//        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'aldroubim7@gmail.com',
        ]);


    }
    public function test_example2()
    {

//        $this->assertDatabaseHas('users', [
//            'email' => 'aldroubim7@gmail.com',
//        ]);
        $this->assertDatabaseHas('users', [
            'email' => 'aldroubim88@gmail.com',
        ]);
    }
}
