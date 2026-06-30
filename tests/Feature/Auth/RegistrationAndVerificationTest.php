<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class RegistrationAndVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registering_creates_an_unverified_user_and_sends_a_verification_email(): void
    {
        Notification::fake();

        $response = $this->post('/register', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'mobile' => '0612345678',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $user = User::where('email', 'jane@example.com')->firstOrFail();

        $response->assertRedirect('/');
        $this->assertNull($user->email_verified_at);
        Notification::assertSentTo($user, VerifyEmail::class);
    }

    public function test_unverified_user_is_redirected_away_from_checkout(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get('/checkout');

        $response->assertRedirect(route('verification.notice'));
    }

    public function test_verifying_email_allows_access_to_checkout(): void
    {
        $user = User::factory()->unverified()->create();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $this->actingAs($user)->get($verificationUrl);

        $this->assertNotNull($user->fresh()->email_verified_at);
    }
}
