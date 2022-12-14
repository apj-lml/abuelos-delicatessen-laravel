
      <div class="container">
        <main>
          {{-- <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h2>Checkout form</h2>
            <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
          </div> --}}

          <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your cart</span>
                <span class="badge bg-primary rounded-pill">{{ Cart::getTotalQuantity()}}</span>
              </h4>
              <ul class="list-group mb-3">
                @foreach ($cartProducts as $key => $item)
                @php ++$key @endphp
                <li class="list-group-item d-flex justify-content-between lh-sm">
                  <div>
                    <h6 class="my-0">{{ $item->name }}</h6> <span class="text-muted">Qty x {{ $item->quantity }} </span> 
                    <span>
                      <form action="{{ route('cart.remove') }}" id="cartRemove{{ $key }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $item->id }}" name="id">
                        <a href="#" class="" onclick=" document.getElementById('cartRemove{{ $key }}').submit(); //return false;"><i class="bi bi-cart-x"></i> remove</a>
                      </form>
                    </span>
                    <small class="text-muted">{{ $item->description }}</small>
                  </div>
                  <span class="text-muted">Php {{ $item->price }}</span>
                </li>
                
                @endforeach
      
                <li class="list-group-item d-flex justify-content-between">
                  <span>Total (Php)</span>
                  <strong>{{ Cart::getTotal() }}</strong>
                </li>
              </ul>

              <form action="{{ route('cart.clear') }}" method="POST" class="card p-2">
                @csrf
                {{-- <div class="input-group"> --}}
                  {{-- <input type="text" class="form-control" placeholder="Promo code"> --}}
                  <button type="submit" class="btn btn-secondary"><i class="bi bi-cart-x"></i> Empty Cart</button>
                {{-- </div> --}}
              </form>
            </div>
            
              <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Billing Information</h4>
                <form action="{{ route('cart.checkout') }}" method="post" class="needs-validation" novalidate>
                {{-- <form class="needs-validation" novalidate> --}}

                  @csrf

                  

                  <div class="row g-3">

                    <div class="col-sm-4">
                      <label for="invoiceNo" class="form-label">Invoice No.</label>
                      <input type="text" class="form-control" id="invoiceNo" name="invoiceNo" placeholder="" value="{{ substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXZ1234567890'), 0, 16); }}" required readonly>
                      <div class="invalid-feedback">
                        Valid last name is required.
                      </div>
                    </div>


                    <div class="col-sm-12">
                      <label for="fullName" class="form-label">Full Name</label>
                      <input type="text" class="form-control" id="fullName" name="fullName" placeholder="" value="{{ Auth::Check() ? Auth::user()->name : "" }}" required>
                      <div class="invalid-feedback">
                        Valid first name is required.
                      </div>
                    </div>
  
                    {{-- <div class="col-sm-6">
                      <label for="lastName" class="form-label">Last name</label>
                      <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                      <div class="invalid-feedback">
                        Valid last name is required.
                      </div>
                    </div> --}}
  
                    {{-- <div class="col-12">
                      <label for="username" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text">@</span>
                        <input type="text" class="form-control" id="username" placeholder="Username" required>
                      <div class="invalid-feedback">
                          Your username is required.
                        </div>
                      </div>
                    </div> --}}
  
                    <div class="col-12">
                      <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                      <input type="email" class="form-control" id="email" id="email" placeholder="you@example.com" value="{{ Auth::Check() ? Auth::user()->email : ""}}">
                      <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                      </div>
                    </div>
{{--   
                    <div class="col-12">
                      <label for="address" class="form-label">Address</label>
                      <input type="text" class="form-control" id="address" name="address" placeholder="" value="{{ Auth::Check() ? Auth::user()->address : ""}}" required>
                      <div class="invalid-feedback">
                        Please enter your shipping address.
                      </div>
                    </div> --}}
  
                    <div class="col-12">
                      <label for="address2" class="form-label">Billing Address </label>
                      <input type="text" class="form-control" id="address2" name="address2" placeholder="" value="{{ Auth::Check() ? Auth::user()->billing_address : ""}}">
                    </div>
  
                  {{-- <hr class="my-4">
  
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="same-address">
                    <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
                  </div>
  
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="save-info">
                    <label class="form-check-label" for="save-info">Save this information for next time</label>
                  </div> --}}
  
                  <hr class="my-4">
  
                  <h4 class="mb-3">Payment</h4>
  
                  <div class="my-3">
                    <div class="form-check">
                      <input id="credit" name="paymentMethod" type="radio" value="Cash on Delivery" class="form-check-input" checked required>
                      <label class="form-check-label" for="credit">Cash on Delivery</label>
                    </div>
                    <div class="form-check">
                      <input id="credit" name="paymentMethod" type="radio" class="form-check-input" required disabled>
                      <label class="form-check-label" for="credit">Credit card (Coming Soon)</label>
                    </div>
                    <div class="form-check">
                      <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required disabled>
                      <label class="form-check-label" for="debit">Debit card (Coming Soon)</label>
                    </div>
                    <div class="form-check">
                      <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required disabled>
                      <label class="form-check-label" for="paypal">PayPal (Coming Soon)</label>
                    </div>
                  </div>
  
                  {{-- <div class="row gy-3">
                    <div class="col-md-6">
                      <label for="cc-name" class="form-label">Name on card</label>
                      <input type="text" class="form-control" id="cc-name" placeholder="" required>
                      <small class="text-muted">Full name as displayed on card</small>
                      <div class="invalid-feedback">
                        Name on card is required
                      </div>
                    </div>
  
                    <div class="col-md-6">
                      <label for="cc-number" class="form-label">Credit card number</label>
                      <input type="text" class="form-control" id="cc-number" placeholder="" required>
                      <div class="invalid-feedback">
                        Credit card number is required
                      </div>
                    </div>
  
                    <div class="col-md-3">
                      <label for="cc-expiration" class="form-label">Expiration</label>
                      <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                      <div class="invalid-feedback">
                        Expiration date required
                      </div>
                    </div>
  
                    <div class="col-md-3">
                      <label for="cc-cvv" class="form-label">CVV</label>
                      <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                      <div class="invalid-feedback">
                        Security code required
                      </div>
                    </div>
                  </div> --}}
  
                  <hr class="my-4">
                  @if ($countProducts != 0 && Auth::Check())
                    <button class="w-100 btn btn-primary btn-lg">Continue to checkout</button>
                  @else
                    <button class="w-100 btn btn-primary btn-lg" type="submit" disabled>Continue to checkout</button>
                  @endif
                </form>
              </div>
            {{-- </form> --}}



          </div>
        </main>

        {{-- <footer class="my-5 pt-5 text-muted text-center text-small">
          <p class="mb-1">&copy; 2017–2021 Company Name</p>
          <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
          </ul>
        </footer> --}}
      </div>