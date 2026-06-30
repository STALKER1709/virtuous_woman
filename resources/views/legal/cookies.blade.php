@extends('layouts.app')
@section('title', 'Politique de Cookies')
@section('meta_description', 'Politique de cookies de Virtuous Woman.')
@section('content')
<main class="pt-90">
  <div class="mb-4 pb-4"></div>
  <section class="container">
    <h1 class="page-title">Politique de cookies</h1>

    <h5 class="mt-4">Qu'est-ce qu'un cookie ?</h5>
    <p>Un cookie est un petit fichier texte déposé sur votre terminal lors de la visite du site, permettant de mémoriser des informations sur votre navigation.</p>

    <h5 class="mt-4">Cookies utilisés sur ce site</h5>
    <table class="table table-bordered">
      <thead>
        <tr><th>Cookie</th><th>Finalité</th><th>Type</th><th>Durée</th></tr>
      </thead>
      <tbody>
        <tr><td>laravel_session</td><td>Maintien de la session utilisateur (panier, connexion)</td><td>Essentiel</td><td>Session</td></tr>
        <tr><td>XSRF-TOKEN</td><td>Protection contre les attaques CSRF</td><td>Essentiel</td><td>Session</td></tr>
        <tr><td>vw_cookie_consent</td><td>Mémorisation de votre choix relatif aux cookies</td><td>Essentiel</td><td>Permanent (stockage local du navigateur)</td></tr>
      </tbody>
    </table>
    <p>Le site n'utilise actuellement aucun cookie publicitaire ou de mesure d'audience tiers. Cette page sera mise à jour si de tels cookies sont ajoutés à l'avenir.</p>

    <h5 class="mt-4">Gérer vos préférences</h5>
    <p>Les cookies essentiels listés ci-dessus sont nécessaires au fonctionnement du site (panier, connexion, sécurité) et ne peuvent pas être désactivés. Vous pouvez à tout moment supprimer les cookies déjà déposés via les paramètres de votre navigateur.</p>
  </section>
</main>
@endsection
