@extends('layouts.app')
@section('title', 'Conditions Générales de Vente')
@section('meta_description', 'Conditions générales de vente de Virtuous Woman.')
@section('content')
<main class="pt-90">
  <div class="mb-4 pb-4"></div>
  <section class="container">
    <h1 class="page-title">Conditions Générales de Vente (CGV)</h1>
    <div class="alert alert-warning">À faire valider par un juriste avant mise en production — modèle générique non contractuel.</div>

    <h5 class="mt-4">1. Objet</h5>
    <p>Les présentes CGV régissent les ventes de produits réalisées sur le site {{ config('app.name') }} entre {{ config('app.name') }} et tout consommateur (« le Client »).</p>

    <h5 class="mt-4">2. Prix</h5>
    <p>Les prix sont indiqués en euros, toutes taxes comprises (TTC), TVA française au taux en vigueur ({{ 20 }} % au jour de la rédaction). Les frais de livraison sont précisés avant validation de la commande.</p>

    <h5 class="mt-4">3. Commande</h5>
    <p>Toute commande passée sur le site vaut acceptation des présentes CGV. Un email de confirmation est envoyé au Client après validation du paiement.</p>

    <h5 class="mt-4">4. Droit de rétractation</h5>
    <p>Conformément à l'article L221-18 du Code de la consommation, le Client dispose d'un délai de <strong>14 jours</strong> à compter de la réception du produit pour exercer son droit de rétractation, sans avoir à justifier de motif ni à payer de pénalité, à l'exception des frais de retour.</p>
    <p>Pour exercer ce droit, le Client doit notifier sa décision par email à {{ config('mail.from.address') }} avant l'expiration du délai. Le remboursement intervient dans un délai maximum de 14 jours suivant la réception du produit retourné.</p>

    <h5 class="mt-4">5. Livraison</h5>
    <p>Les délais de livraison sont communiqués à titre indicatif lors de la commande. {{ config('app.name') }} ne saurait être tenu responsable des retards imputables au transporteur.</p>

    <h5 class="mt-4">6. Garanties</h5>
    <p>Les produits bénéficient de la garantie légale de conformité (articles L217-3 et suivants du Code de la consommation) et de la garantie des vices cachés (articles 1641 et suivants du Code civil).</p>

    <h5 class="mt-4">7. Paiement</h5>
    <p>Le paiement s'effectue selon les moyens proposés au moment de la commande. La commande n'est définitivement validée qu'après confirmation du paiement.</p>

    <h5 class="mt-4">8. Litiges</h5>
    <p>En cas de litige, le Client peut recourir gratuitement à un médiateur de la consommation, conformément à l'article L616-1 du Code de la consommation. À défaut de résolution amiable, les tribunaux français seront seuls compétents.</p>
  </section>
</main>
@endsection
