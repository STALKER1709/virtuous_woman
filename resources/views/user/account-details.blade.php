@extends('layouts.app')
@section('content')

  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">{{ __('messages.account_details_title') }}</h2>
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

            <form method="POST" action="{{ route('user.details.update') }}">
              @csrf
              @method('PUT')
              <div class="row">
                <div class="col-md-6">
                  <div class="form-label-fixed mb-3">
                    <label class="form-label">{{ __('messages.checkout_full_name') }}</label>
                    <input type="text" name="name" class="form-control form-control_gray" value="{{ old('name', $user->name) }}" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-fixed mb-3">
                    <label class="form-label">{{ __('messages.checkout_email') }}</label>
                    <input type="email" name="email" class="form-control form-control_gray" value="{{ old('email', $user->email) }}" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-fixed mb-3">
                    <label class="form-label">{{ __('messages.checkout_mobile') }}</label>
                    <input type="text" name="mobile" class="form-control form-control_gray" value="{{ old('mobile', $user->mobile) }}" required>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">
                <span>{{ __('messages.account_save_changes') }}</span>
              </button>
            </form>

            <div class="mt-4 pt-3 border-top">
              <h5 class="mb-3">{{ __('messages.account_change_password') }}</h5>
              <form method="POST" action="{{ route('user.password.update') }}">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-label-fixed mb-3">
                      <label class="form-label">{{ __('messages.account_current_password') }}</label>
                      <input type="password" name="current_password" class="form-control form-control_gray" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-label-fixed mb-3">
                      <label class="form-label">{{ __('messages.account_new_password') }}</label>
                      <input type="password" name="password" class="form-control form-control_gray" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-label-fixed mb-3">
                      <label class="form-label">{{ __('messages.account_confirm_password') }}</label>
                      <input type="password" name="password_confirmation" class="form-control form-control_gray" required>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-outline-primary-2">
                  <span>{{ __('messages.account_save_changes') }}</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
