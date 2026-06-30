<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_requesting_a_reset_link_sends_a_notification_with_a_valid_token(): void
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post('/password/email', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            return Password::tokenExists($user, $notification->token);
        });
    }

    public function test_user_can_reset_password_with_a_valid_token(): void
    {
        $user = User::factory()->create();
        $token = Password::createToken($user);

        $response = $this->post('/password/reset', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-password123',
            'password_confirmation' => 'new-password123',
        ]);

        $response->assertRedirect('/');
        $this->assertTrue(Hash::check('new-password123', $user->fresh()->password));
    }

    public function test_reset_fails_with_an_invalid_token(): void
    {
        $user = User::factory()->create();
        $originalPassword = $user->password;

        $this->post('/password/reset', [
            'token' => 'invalid-token',
            'email' => $user->email,
            'password' => 'new-password123',
            'password_confirmation' => 'new-password123',
        ]);

        $this->assertSame($originalPassword, $user->fresh()->password);
    }
}
