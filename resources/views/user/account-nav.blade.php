          <ul class="account-nav">
            <li><a href="{{route('user.index')}}" class="menu-link menu-link_us-s {{ request()->routeIs('user.index') ? 'active' : '' }}">{{ __('messages.account_dashboard') }}</a></li>
            <li><a href="{{ route('user.orders') }}" class="menu-link menu-link_us-s {{ request()->routeIs('user.orders') || request()->routeIs('user.order.details') ? 'active' : '' }}">{{ __('messages.account_orders') }}</a></li>
            <li><a href="{{ route('user.address') }}" class="menu-link menu-link_us-s {{ request()->routeIs('user.address') ? 'active' : '' }}">{{ __('messages.account_addresses') }}</a></li>
            <li><a href="{{ route('user.details') }}" class="menu-link menu-link_us-s {{ request()->routeIs('user.details') ? 'active' : '' }}">{{ __('messages.account_details') }}</a></li>
            <li><a href="{{ route('wishlist.index') }}" class="menu-link menu-link_us-s {{ request()->routeIs('wishlist.index') ? 'active' : '' }}">{{ __('messages.account_wishlist') }}</a></li>
            <li><a href="{{ route('user.export-data') }}" class="menu-link menu-link_us-s">{{ __('messages.account_download_data') }}</a></li>
            <li>
              <a href="#deleteAccountModal" data-bs-toggle="modal" class="menu-link menu-link_us-s text-danger">{{ __('messages.account_delete') }}</a>
            </li>
            <li>
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
            <a href="{{ route('logout') }}" class="menu-link menu-link_us-s" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('messages.account_logout') }}</a>
            </form>
            </li>
          </ul>

          <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form method="POST" action="{{ route('user.delete-account') }}">
                  @csrf
                  @method('DELETE')
                  <div class="modal-header">
                    <h5 class="modal-title">Delete your account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <p>This will permanently delete your account, orders, wishlist and reviews. This action cannot be undone.</p>
                    <div class="form-label-fixed">
                      <label class="form-label">Confirm your password</label>
                      <input type="password" name="password" class="form-control form-control_gray" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete my account</button>
                  </div>
                </form>
              </div>
            </div>
          </div>