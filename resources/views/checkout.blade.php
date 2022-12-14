@extends('layouts.app')

@push('mystyles')
          <style>
          .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
          }

          @media (min-width: 768px) {
            .bd-placeholder-img-lg {
              font-size: 3.5rem;
            }
          }
        </style>
@endpush

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Checkout Page</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Cart</li>
          </ol>
        </div>
        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">

    @livewire('checkout-component')

    </section>

</main>
@endsection