@extends('layouts.app')
@section('title', 'Mentions Légales')
@section('meta_description', 'Mentions légales de Virtuous Woman.')
@section('content')
<main class="pt-90">
  <div class="mb-4 pb-4"></div>
  <section class="container">
    <h1 class="page-title">Mentions légales</h1>
    <div class="alert alert-warning">À compléter avant mise en production : raison sociale, forme juridique, capital, SIREN/SIRET, RCS, n° TVA intracommunautaire, hébergeur.</div>

    <h5 class="mt-4">Éditeur du site</h5>
    <p>
      {{ config('app.name') }}<br>
      [Forme juridique — SAS / EURL / Auto-entrepreneur, etc.]<br>
      [Adresse complète du siège social]<br>
      SIREN/SIRET : [à compléter]<br>
      RCS : [ville d'immatriculation + numéro]<br>
      N° de TVA intracommunautaire : [à compléter]<br>
      Capital social : [à compléter, le cas échéant]
    </p>

    <h5 class="mt-4">Directeur de la publication</h5>
    <p>[Nom du responsable de publication]</p>

    <h5 class="mt-4">Hébergement</h5>
    <p>[Nom de l'hébergeur]<br>[Adresse de l'hébergeur]<br>[Téléphone de l'hébergeur]</p>

    <h5 class="mt-4">Contact</h5>
    <p>Email : {{ config('mail.from.address') }}</p>

    <h5 class="mt-4">Propriété intellectuelle</h5>
    <p>L'ensemble des contenus présents sur ce site (textes, images, logos, mise en page) est la propriété de {{ config('app.name') }}, sauf mention contraire, et est protégé par le droit d'auteur. Toute reproduction sans autorisation préalable est interdite.</p>
  </section>
</main>
@endsection
