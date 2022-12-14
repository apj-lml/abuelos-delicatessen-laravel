@push('mystyles')
<style>
        body {
            background-color: #ecedee
        }
    
        .card {
            border: none;
            overflow: hidden
        }
    
        .thumbnail_images ul {
            list-style:
                none;
            justify-content: center;
            display: flex;
            align-items: center;
            margin-top: 10px
        }
    
        .thumbnail_images ul li {
            margin:
                5px;
            padding: 10px;
            border: 2px solid #eee;
            cursor: pointer;
            transition: all 0.5s
        }
    
        .thumbnail_images ul li:hover {
            border: 2px solid #000
        }
    
        .main_image {
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 1px solid #eee;
            height:
                400px;
            width: 100%;
            overflow: hidden
        }
    
    
        .right-side {
            position: relative
        }
    
 
    
        .buttons .btn {
            height: 50px;
            width: 150px;
            border-radius: 0px !important
        }
    </style>
@endpush
<div class="container mt-5 mb-5">
    <div class="card">
    
        <div class="row g-0">
           
            <div class="col-md-6 border-end">
                <div class="d-flex flex-column justify-content-center">
                    <div class="main_image">
                        @foreach ($product->productImages as $image)
                            @if ($image->is_thumbnail == 'thumbnail')
                            <img src="{{ Storage::url($image->image_path.$image->file_name) }}" id="main_product_image" width="350"> </div>
                            @endif
                        @endforeach
                    <div class="thumbnail_images">
                        <ul id="thumbnail">
                            @foreach ($product->productImages as $image)
                                <li><img onclick="changeImage(this)" src="{{ Storage::url($image->image_path.$image->file_name) }}" width="70"></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 right-side">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>{{ $product->product_title }}</h3>
                    </div>
                    <div class="mt-2 pr-3 content">
                        <p>{{ $product->product_description }}</p>
                    </div>
                    <h3>Php {{ $product->product_price }}</h3>
                    <form action="{{ route('cart.store') }}" method="POST" id="" enctype="multipart/form-data">
                                                                        
                        @csrf
                        
                    <div class="input-group mb-2">
                        {{-- <span class="input-group-btn"> --}}
                            <button type="button" class="btn btn-dark btn-number" disabled="disabled" data-type="minus" data-field="quantity">
                                <i class="bi bi-dash"></i>
                            </button>
                        {{-- </span> --}}
                        <input type="text" name="quantity" class="form-control input-number" value="1" min="1" max="30">
                        {{-- <span class="input-group-btn"> --}}
                            <button type="button" class="btn btn-dark btn-number" data-type="plus" data-field="quantity">
                                <i class="bi bi-plus"></i>
                            </button>
                        {{-- </span> --}}
                    </div>

                    <div class="buttons d-flex flex-row mt-5 gap-3"> 
                        {{-- <button class="btn btn-outline-dark">Buy Now</button> --}}
                       
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            <input type="hidden" value="{{ $product->product_title }}" name="name">
                            <input type="hidden" value="{{ $product->product_description }}" name="description">
                            <input type="hidden" value="{{ $product->product_price }}" name="price">            
                                  
                            <button type="submit" class="btn btn-dark"><i class="bi bi-cart"></i> Add to Cart</button> 

                        </form>

                        {{-- <button class="btn btn-dark">Add to Cart</button>  --}}
                    </div>
                    {{-- <div class="search-option"> <i class='bx bx-search-alt-2 first-search'></i>
                        <div class="inputs"> <input type="text" name=""> </div> <i class='bx bx-share-alt share'></i>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@push('myscripts')
<script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
<script type="text/javascript">
        function changeImage(element) {

            var main_prodcut_image = document.getElementById('main_product_image');
            main_prodcut_image.src = element.src;

            }
        $('.btn-number').click(function(e){
            e.preventDefault();
            
            fieldName = $(this).attr('data-field');
            type      = $(this).attr('data-type');
            var input = $("input[name='"+fieldName+"']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if(type == 'minus') {
                    
                    if(currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    } 
                    if(parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if(type == 'plus') {

                    if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function(){
        $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {
            
            minValue =  parseInt($(this).attr('min'));
            maxValue =  parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
            
            name = $(this).attr('name');
            if(valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            
            
        });

        $(".input-number").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) || 
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
</script>

@endpush
