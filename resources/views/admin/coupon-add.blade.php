@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Coupon information</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.coupons') }}">
                            <div class="text-tiny">Coupons</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New Coupon</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.coupon.store') }}" method="POST">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Coupon Code <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="e.g. SUMMER20" name="code" tabindex="0"
                            value="{{ old('code') }}" aria-required="true" required="">
                    </fieldset>
                    @error('code') <span class="alert alert-danger text-center">{{ $message }}</span> @enderror

                    <fieldset class="name">
                        <div class="body-title">Discount Type <span class="tf-color-1">*</span></div>
                        <select class="flex-grow" name="type" required>
                            <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Percent (%)</option>
                            <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed amount (&euro;)</option>
                        </select>
                    </fieldset>
                    @error('type') <span class="alert alert-danger text-center">{{ $message }}</span> @enderror

                    <fieldset class="name">
                        <div class="body-title">Value <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="number" step="0.01" min="0" placeholder="Value" name="value" tabindex="0"
                            value="{{ old('value') }}" aria-required="true" required="">
                    </fieldset>
                    @error('value') <span class="alert alert-danger text-center">{{ $message }}</span> @enderror

                    <fieldset class="name">
                        <div class="body-title">Max Uses (optional)</div>
                        <input class="flex-grow" type="number" min="1" placeholder="Unlimited" name="max_uses" tabindex="0"
                            value="{{ old('max_uses') }}">
                    </fieldset>
                    @error('max_uses') <span class="alert alert-danger text-center">{{ $message }}</span> @enderror

                    <fieldset class="name">
                        <div class="body-title">Expires At (optional)</div>
                        <input class="flex-grow" type="date" name="expires_at" tabindex="0"
                            value="{{ old('expires_at') }}">
                    </fieldset>
                    @error('expires_at') <span class="alert alert-danger text-center">{{ $message }}</span> @enderror

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
