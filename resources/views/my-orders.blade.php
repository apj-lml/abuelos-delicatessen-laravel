@extends('layouts.app')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>My Orders</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>My Orders</li>
          </ol>
        </div>
        </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page">

    {{-- @livewire('checkout-component') --}}
    @livewire('my-orders-component')
    </section>

</main>
@endsection