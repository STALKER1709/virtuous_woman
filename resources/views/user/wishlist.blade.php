@extends('layouts.app')
@section('content')

  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">My Wishlist</h2>
      <div class="row">
        <div class="col-lg-3">
            @include('user.account-nav')
        </div>
        <div class="col-lg-9">
          <div class="page-content my-account__dashboard">
            @if ($wishlist->count() > 0)
              <div class="cart-table__wrapper">
                <table class="cart-table">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Price</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($wishlist as $item)
                      <tr>
                        <td>
                          <a href="{{ route('shop.product.details', ['product_slug' => $item->product->slug]) }}" class="cart-table__product d-flex align-items-center">
                            <img src="{{ asset('uploads/products/thumbnails') }}/{{ $item->product->image }}" width="80" height="80" alt="{{ $item->product->name }}" class="me-3">
                            {{ $item->product->name }}
                          </a>
                        </td>
                        <td>{{ number_format($item->product->sale_price ?: $item->product->regular_price, 2) }}&euro;</td>
                        <td>
                          <form method="post" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="name" value="{{ $item->product->name }}">
                            <input type="hidden" name="price" value="{{ $item->product->sale_price ?: $item->product->regular_price }}">
                            <button type="submit" class="btn btn-sm btn-primary">Add to Cart</button>
                          </form>
                        </td>
                        <td>
                          <form method="post" action="{{ route('wishlist.toggle') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <p>Your wishlist is empty. <a class="unerline-link" href="{{ route('shop.index') }}">Start shopping</a>.</p>
            @endif
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection
