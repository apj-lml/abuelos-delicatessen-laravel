@push('styles')
<style>
    .container-gallery
    {
        width: 100%;
        -webkit-transform-style: preserve-3d;
        transform-style: preserve-3d;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-perspective: 1000;
        perspective: 1000;
        position: relative;
    }

    .popup
    {
        width: 250px;
        margin: 0 -25px;
        position: relative;
        box-shadow: 0px 0px 40px -5px rgba(0, 0, 0, 0.5);
        background-size: cover;
        background-position: center;
        border-radius: 5px;
        -webkit-transition: .2s;
        transition: .2s;
        cursor: pointer;
    }

        .popup:hover
        {
            -webkit-transition: .2s;
            transition: .2s;
            -webkit-transform: translateZ(5px) translateY(-20px) scale(1.05);
            transform: translateZ(5px) translateY(-20px) scale(1.05);
        }

    .popup-1,
    .popup-4
    {
        -webkit-transform: translateZ(1px);
        transform: translateZ(1px);
    }

    .popup-2,
    .popup-5
    {
        -webkit-transform: translateZ(2px) translateY(-5px);
        transform: translateZ(2px) translateY(-5px);
    }

    .popup-3
    {
        -webkit-transform: translateZ(3px) translateY(-10px);
        transform: translateZ(3px) translateY(-10px);
    }

    .popup-1:hover ~ .popup-2
    {
        -webkit-transform: translateZ(4px) translateY(-15px);
        transform: translateZ(4px) translateY(-15px);
        -webkit-transition: .2s;
        transition: .2s;
    }

    .popup-4
    {
        -webkit-box-ordinal-group: 6;
        -ms-flex-order: 5;
        order: 5;
    }

        .popup-4:hover ~ .popup-5
        {
            -webkit-transform: translateZ(3px) translateY(-15px);
            transform: translateZ(3px) translateY(-15px);
            -webkit-transition: .1s;
            transition: .1s;
        }
</style>
@endpush

<div class="">
<div>
<!-- <button onclick="Livewire.emit('openModal', 'my-modal')" class="btn btn-dark" type="button" >Add Product</button> -->


<div class="table-responsive">
<table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Invoice No</th>
                <th scope="col">Full Name</th>
                <th scope="col">Shipping Address</th>
                <th scope="col">Order Date</th>
                <th scope="col">Status</th>
                <th scope="col">Controls</th>
            </tr>
        </thead>
    <tbody>
        
        @foreach ($customerOrders as $order)
            <tr>
                <td>{{$order->invoice_no}}</td>
                <td>{{$order->full_name}}</td>
                <td>{{$order->shipping_address}}</td>
                <td>{{$order->order_date}}</td>
                <td>{{$order->order_status}}</td>
                <td>
                    <div class="d-flex">
                        
                        <button type="button" class="btn btn-dark m-1" data-bs-toggle="modal" data-bs-target="#exampleModal1" wire:click="showViewOrderParticularsModal('{{$order->invoice_no}}')">
                            View Products
                            </button>
                        {{-- <button type="button" class="btn btn-dark m-1" wire:click="fulfillOrder('{{$order->invoice_no}}')" >
                            Fulfill
                            </button> --}}
                        <button type="button" class="btn btn-dark m-1" wire:click="cancelOrder('{{$order->invoice_no}}')">
                            Cancel
                            </button>
                   
                    </div>
                </td>
            </tr>
        @endforeach

    </tbody>
    <tfoot>
    </tfoot>
    </table>
</div>

    {{ $customerOrders->links() }}

</div>


<!-- Modal -->
<div class="modal fade" wire:ignore.self id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
   
            <h5 class="modal-title" id="exampleModalLabel1">View Order Particulars</h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Order Qty</th>
                <th scope="col">Price</th>
                <th scope="col">Total</th>
                {{-- <th scope="col">Control</th> --}}
              </tr>
            </thead>
            <tbody>
                @if (isset($customerOrderParticulars))
                    @foreach ($customerOrderParticulars as $orderParticulars)
                    <tr>
                        <td>{{ $orderParticulars->product->product_title }}</td>
                        <td>{{ $orderParticulars->order_qty }}</td>
                        <td>{{ $orderParticulars->amount }}</td>
                        <td>{{ $orderParticulars->amount * $orderParticulars->order_qty }}</td>
                        {{-- <td>
                            <button type="button" class="btn btn-dark">
                            Cancel Order
                            </button>
                            <button type="button" class="btn btn-dark">
                                Fulfill Order
                            </button>
                        </td> --}}
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">No Data</td>
                    </tr>
                @endif


            </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
    </div>
</div>


{{-- not used --}}
<div class="modal fade" wire:ignore.self id="fulfillOrderModal" tabindex="-1" aria-labelledby="fulfillOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
     
              <h5 class="modal-title" id="exampleModalLabel1">View Order Particulars</h5>
  
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
      </div>
  </div>

</div>



@push('myscripts')


<script type="text/javascript">
    window.addEventListener('fireFulfillOrderToast', event => {
        Toast.fire({
        icon: "success",
        title: "Order fulfilled!"
        })
    }); 

    window.addEventListener('fireCancelOrderToast', event => {
        Toast.fire({
        icon: "success",
        title: "Order canceled!"
        })
    }); 

</script>


@endpush