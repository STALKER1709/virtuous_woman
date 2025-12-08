@extends('layouts.app')
@section('content')

  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">My Sisterhood Account</h2>
      <div class="row">
        <div class="col-lg-3">
            @include('user.account-nav')
        </div>
        <div class="col-lg-9">
          <div class="page-content my-account__dashboard">
            <p>Welcome to your <strong>Sisterhood Space</strong> 🌸</p>
            <p>From your empowerment dashboard you can view your <a class="unerline-link" href="account_orders.html">recent
                orders</a>, manage your <a class="unerline-link" href="account_edit_address.html">shipping
                addresses</a>, and <a class="unerline-link" href="account_edit.html">update your personal information</a>.</p>
            <p class="mt-4">Remember, you're part of a community that celebrates <strong>authenticity, style, and empowerment</strong>. 
              Every purchase supports our mission to inspire and uplift women worldwide.</p>
            <div class="mt-4 pt-3 border-top">
              <h5 class="mb-3" style="color: var(--virtuous-orange);">Daily Inspiration</h5>
              <blockquote class="fs-5 fst-italic" style="color: var(--virtuous-dark);">
                "Treme ipsorn dissure exercatocond iac ocp alatet varve strane in he estu tonic ho turned to blueento horinx oport prandi etap."
              </blockquote>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection