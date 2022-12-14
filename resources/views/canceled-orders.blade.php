
<!-- /* -------------------------------------------------------------------------- */
/*                           this will be for admin                           */
/* -------------------------------------------------------------------------- */ -->

@extends('layouts.app')

@section('content')
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
  
          <div class="d-flex justify-content-between align-items-center">
            <h2>Canceled Orders</h2>
            <ol>
              <li><a href="/">Home</a></li>
              <li>Canceled Orders</li>
            </ol>
          </div>
          </div>
      </section>
      <!-- End Breadcrumbs Section -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                {{-- <div class="card-header">{{ __('Products') }}</div> --}}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @livewire('canceled-orders-component')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
