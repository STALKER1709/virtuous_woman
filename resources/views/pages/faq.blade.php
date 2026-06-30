@extends('layouts.app')
@section('title', __('messages.faq_title'))
@section('meta_description', 'Questions fréquentes - Virtuous Woman.')
@section('content')
<main class="pt-90">
  <div class="mb-4 pb-4"></div>
  <section class="container">
    <h1 class="page-title">{{ __('messages.faq_title') }}</h1>

    <div class="accordion" id="faqAccordion">
      @foreach ($faqs = [1,2,3,4,5] as $i)
        <div class="card mb-3">
          <div class="card-header">
            <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $i }}">
              {{ __('messages.faq_q'.$i) }}
            </button>
          </div>
          <div id="faq{{ $i }}" class="collapse" data-bs-parent="#faqAccordion">
            <div class="card-body">{{ __('messages.faq_a'.$i) }}</div>
          </div>
        </div>
      @endforeach
    </div>
  </section>
</main>
@endsection
