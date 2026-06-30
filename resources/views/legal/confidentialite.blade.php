@extends('layouts.app')
@section('title', 'Politique de Confidentialité')
@section('meta_description', 'Politique de confidentialité et protection des données de Virtuous Woman.')
@section('content')
<main class="pt-90">
  <div class="mb-4 pb-4"></div>
  <section class="container">
    <h1 class="page-title">Politique de confidentialité (RGPD)</h1>
    <div class="alert alert-warning">À compléter avec le nom du Délégué à la Protection des Données (DPO) le cas échéant, et la durée précise de conservation de chaque type de donnée.</div>

    <h5 class="mt-4">1. Responsable du traitement</h5>
    <p>{{ config('app.name') }}, éditeur du site, est responsable du traitement des données personnelles collectées. Contact : {{ config('mail.from.address') }}</p>

    <h5 class="mt-4">2. Données collectées</h5>
    <ul>
      <li>Données de compte : nom, email, mot de passe (chiffré), numéro de téléphone</li>
      <li>Données de commande : adresse de livraison/facturation, historique d'achat</li>
      <li>Données de navigation : cookies techniques et, le cas échéant, cookies analytiques (voir notre <a href="{{ route('legal.cookies') }}">politique de cookies</a>)</li>
    </ul>

    <h5 class="mt-4">3. Finalités du traitement</h5>
    <p>Gestion des comptes clients, traitement des commandes, prévention de la fraude (limitation du débit de connexion), envoi d'emails transactionnels (confirmation de commande, suivi de statut), amélioration du service.</p>

    <h5 class="mt-4">4. Base légale</h5>
    <p>Exécution du contrat de vente, intérêt légitime (sécurité, prévention de la fraude), consentement (cookies non essentiels).</p>

    <h5 class="mt-4">5. Durée de conservation</h5>
    <p>Les données de compte sont conservées tant que le compte est actif. Les données de facturation sont conservées 10 ans conformément aux obligations comptables et fiscales.</p>

    <h5 class="mt-4">6. Vos droits</h5>
    <p>Conformément au RGPD, vous disposez d'un droit d'accès, de rectification, d'effacement, de limitation, de portabilité et d'opposition concernant vos données personnelles. Vous pouvez exercer ces droits depuis votre espace <a href="{{ route('user.index') }}">Mon Compte</a> ou en nous contactant à {{ config('mail.from.address') }}.</p>
    <p>Vous disposez également du droit d'introduire une réclamation auprès de la CNIL (www.cnil.fr).</p>

    <h5 class="mt-4">7. Sécurité</h5>
    <p>Les mots de passe sont stockés sous forme chiffrée. Le site applique des mesures de sécurité (limitation du débit de connexion, en-têtes de sécurité HTTP) pour protéger vos données.</p>
  </section>
</main>
@endsection
