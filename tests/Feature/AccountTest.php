<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_their_shipping_address(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put('/account-address', [
            'address' => '12 Rue Test',
            'city' => 'Lyon',
            'state' => '',
            'zip' => '69000',
            'country' => 'France',
        ]);

        $response->assertRedirect(route('user.address'));
        $this->assertSame('Lyon', $user->fresh()->city);
    }

    public function test_user_can_update_their_account_details(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put('/account-details', [
            'name' => 'New Name',
            'email' => $user->email,
            'mobile' => '0699999999',
        ]);

        $response->assertRedirect(route('user.details'));
        $this->assertSame('New Name', $user->fresh()->name);
    }

    public function test_user_cannot_take_another_users_email_or_mobile(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();

        $response = $this->actingAs($user)->put('/account-details', [
            'name' => $user->name,
            'email' => $other->email,
            'mobile' => $user->mobile,
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_user_can_change_their_password_with_correct_current_password(): void
    {
        $user = User::factory()->create(['password' => Hash::make('old-password')]);

        $response = $this->actingAs($user)->put('/account-details/password', [
            'current_password' => 'old-password',
            'password' => 'brand-new-password',
            'password_confirmation' => 'brand-new-password',
        ]);

        $response->assertRedirect(route('user.details'));
        $this->assertTrue(Hash::check('brand-new-password', $user->fresh()->password));
    }

    public function test_password_change_requires_correct_current_password(): void
    {
        $user = User::factory()->create(['password' => Hash::make('old-password')]);

        $response = $this->actingAs($user)->put('/account-details/password', [
            'current_password' => 'wrong-password',
            'password' => 'brand-new-password',
            'password_confirmation' => 'brand-new-password',
        ]);

        $response->assertSessionHasErrors('current_password');
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
    }

    public function test_user_cannot_view_another_users_order(): void
    {
        $owner = User::factory()->create();
        $intruder = User::factory()->create();

        $order = Order::create([
            'order_number' => 'VW-TEST-1',
            'user_id' => $owner->id,
            'name' => $owner->name,
            'email' => $owner->email,
            'mobile' => '0600000000',
            'address' => '1 Rue Test',
            'city' => 'Paris',
            'zip' => '75000',
            'country' => 'France',
            'subtotal' => 50,
            'shipping' => 0,
            'total' => 50,
            'payment_method' => 'cod',
            'status' => 'delivered',
        ]);

        $response = $this->actingAs($intruder)->get('/account-orders/'.$order->order_number);

        $response->assertStatus(404);
    }

    public function test_user_can_request_a_return_on_a_delivered_order_within_window(): void
    {
        Mail::fake();

        $user = User::factory()->create();
        $order = Order::create([
            'order_number' => 'VW-TEST-2',
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'mobile' => '0600000000',
            'address' => '1 Rue Test',
            'city' => 'Paris',
            'zip' => '75000',
            'country' => 'France',
            'subtotal' => 50,
            'shipping' => 0,
            'total' => 50,
            'payment_method' => 'cod',
            'status' => 'delivered',
        ]);

        $response = $this->actingAs($user)->post('/account-orders/'.$order->order_number.'/return', [
            'reason' => 'Wrong size received.',
        ]);

        $response->assertRedirect(route('user.order.details', $order->order_number));
        $this->assertDatabaseHas('order_returns', [
            'order_id' => $order->id,
            'user_id' => $user->id,
            'status' => 'requested',
        ]);
    }
}
