@extends('layouts.app')
@section('title', __('messages.contact_title'))
@section('meta_description', 'Contactez Virtuous Woman.')
@section('content')
<main class="pt-90">
  <div class="mb-4 pb-4"></div>
  <section class="container">
    <h1 class="page-title">{{ __('messages.contact_title') }}</h1>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('contact.submit') }}" class="row g-3" style="max-width:600px;">
      @csrf
      <div class="col-md-6">
        <label class="form-label">{{ __('messages.contact_name') }} *</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">{{ __('messages.contact_email') }} *</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
      </div>
      <div class="col-12">
        <label class="form-label">{{ __('messages.contact_subject') }} *</label>
        <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required>
      </div>
      <div class="col-12">
        <label class="form-label">{{ __('messages.contact_message') }} *</label>
        <textarea name="message" rows="5" class="form-control" required>{{ old('message') }}</textarea>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">{{ __('messages.contact_send') }}</button>
      </div>
    </form>
  </section>
</main>
@endsection
