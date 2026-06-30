@extends('layouts.app')
@section('title', __('messages.about_title'))
@section('meta_description', 'À propos de Virtuous Woman.')
@section('content')
<main class="pt-90">
  <div class="mb-4 pb-4"></div>
  <section class="container">
    <h1 class="page-title">{{ __('messages.about_title') }}</h1>
    <p>{{ __('messages.about_intro') }}</p>
    <p>{{ __('messages.about_mission') }}</p>
  </section>
</main>
@endsection
