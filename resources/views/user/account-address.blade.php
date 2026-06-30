@extends('layouts.app')
@section('content')

  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">{{ __('messages.account_address_title') }}</h2>
      <div class="row">
        <div class="col-lg-3">
            @include('user.account-nav')
        </div>
        <div class="col-lg-9">
          <div class="page-content my-account__dashboard">
            @if (session('success'))
              <p class="alert alert-success">{{ session('success') }}</p>
            @endif
            @if ($errors->any())
              <p class="alert alert-danger">{{ $errors->first() }}</p>
            @endif

            <form method="POST" action="{{ route('user.address.update') }}">
              @csrf
              @method('PUT')
              <div class="row">
                <div class="col-md-12">
                  <div class="form-label-fixed mb-3">
                    <label class="form-label">{{ __('messages.checkout_address') }}</label>
                    <input type="text" name="address" class="form-control form-control_gray" value="{{ old('address', $user->address) }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-fixed mb-3">
                    <label class="form-label">{{ __('messages.checkout_city') }}</label>
                    <input type="text" name="city" class="form-control form-control_gray" value="{{ old('city', $user->city) }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-fixed mb-3">
                    <label class="form-label">{{ __('messages.checkout_state') }}</label>
                    <input type="text" name="state" class="form-control form-control_gray" value="{{ old('state', $user->state) }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-fixed mb-3">
                    <label class="form-label">{{ __('messages.checkout_zip') }}</label>
                    <input type="text" name="zip" class="form-control form-control_gray" value="{{ old('zip', $user->zip) }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-fixed mb-3">
                    <label class="form-label">{{ __('messages.checkout_country') }}</label>
                    <input type="text" name="country" class="form-control form-control_gray" value="{{ old('country', $user->country) }}">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">
                <span>{{ __('messages.account_save_changes') }}</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
