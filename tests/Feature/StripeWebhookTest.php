<?php

namespace Tests\Feature;

use Tests\TestCase;

class StripeWebhookTest extends TestCase
{
    public function test_webhook_rejects_requests_with_an_invalid_signature(): void
    {
        config(['services.stripe.webhook_secret' => 'whsec_test_secret']);

        $response = $this->postJson('/stripe/webhook', ['type' => 'checkout.session.completed'], [
            'Stripe-Signature' => 'invalid-signature',
        ]);

        $response->assertStatus(400);
        $response->assertJson(['error' => 'Invalid signature']);
    }

    public function test_webhook_rejects_requests_with_no_signature_header(): void
    {
        config(['services.stripe.webhook_secret' => 'whsec_test_secret']);

        $response = $this->postJson('/stripe/webhook', ['type' => 'checkout.session.completed']);

        $response->assertStatus(400);
    }
}
