<?php

namespace Tests\Feature;

 use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
 use Illuminate\Support\Str;
 use Tests\TestCase;

class ExampleTest extends TestCase
{

//    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        User::create([
            'name' => "Muhammed1",
            'email' => "aldroubim88@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'aldroubim88@gmail.com',
        ]);


    }
}
