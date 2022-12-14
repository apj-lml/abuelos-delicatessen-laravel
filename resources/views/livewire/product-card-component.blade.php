@push('mystyles')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'>
{{-- <link rel="stylesheet" href="./style.css"> --}}

<style>
a,
a:hover {
    text-decoration: none;
    color: inherit;
}

.section-products {
    /* padding: 80px 0 54px; */
}

.section-products .header {
    margin-bottom: 50px;
}

.section-products .header h3 {
    font-size: 1rem;
    color: #fe302f;
    font-weight: 500;
}

.section-products .header h2 {
    font-size: 2.2rem;
    font-weight: 400;
    color: #444444; 
}

.section-products .single-product {
    margin-bottom: 26px;
}

.section-products .single-product .part-1 {
    position: relative;
    height: 290px;
    max-height: 290px;
    margin-bottom: 20px;
    overflow: hidden;
}

.section-products .single-product .part-1::before {
		position: absolute;
		content: "";
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: -1;
		transition: all 0.3s;
}

.section-products .single-product:hover .part-1::before {
		transform: scale(1.2,1.2) rotate(5deg);
}

.section-products #product-1 .part-1::before {
    background: url("https://i.ibb.co/L8Nrb7p/1.jpg") no-repeat center;
    background-size: cover;
		transition: all 0.3s;
}

.section-products #product-2 .part-1::before {
    background: url("https://i.ibb.co/cLnZjnS/2.jpg") no-repeat center;
    background-size: cover;
}

.section-products #product-3 .part-1::before {
    background: url("https://i.ibb.co/L8Nrb7p/1.jpg") no-repeat center;
    background-size: cover;
}

.section-products #product-4 .part-1::before {
    background: url("https://i.ibb.co/cLnZjnS/2.jpg") no-repeat center;
    background-size: cover;
}

.section-products .single-product .part-1 .discount,
.section-products .single-product .part-1 .new {
    position: absolute;
    top: 15px;
    left: 20px;
    color: #ffffff;
    background-color: #fe302f;
    padding: 2px 8px;
    text-transform: uppercase;
    font-size: 0.85rem;
}

.section-products .single-product .part-1 .new {
    left: 0;
    background-color: #444444;
}

.section-products .single-product .part-1 ul {
    position: absolute;
    bottom: -41px;
    left: 20px;
    margin: 0;
    padding: 0;
    list-style: none;
    opacity: 0;
    transition: bottom 0.5s, opacity 0.5s;
}

.section-products .single-product:hover .part-1 ul {
    bottom: 30px;
    opacity: 1;
}

.section-products .single-product .part-1 ul li {
    display: inline-block;
    margin-right: 4px;
}

.section-products .single-product .part-1 ul li a {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    background-color: #ffffff;
    color: #444444;
    text-align: center;
    box-shadow: 0 2px 20px rgb(50 50 50 / 10%);
    transition: color 0.2s;
}

.section-products .single-product .part-1 ul li a:hover {
    color: #fe302f;
}

.section-products .single-product .part-2 .product-title {
    font-size: 1rem;
}

.section-products .single-product .part-2 h4 {
    display: inline-block;
    font-size: 1rem;
}

.section-products .single-product .part-2 .product-old-price {
    position: relative;
    padding: 0 7px;
    margin-right: 2px;
    opacity: 0.6;
}

.section-products .single-product .part-2 .product-old-price::after {
    position: absolute;
    content: "";
    top: 50%;
    left: 0;
    width: 100%;
    height: 1px;
    background-color: #444444;
    transform: translateY(-50%);
}



@media (max-width: 767px){.carousel-inner .carousel-item >div{display: none}.carousel-inner .carousel-item >div:first-child{display: block}}.carousel-inner .carousel-item.active, .carousel-inner .carousel-item-next, .carousel-inner .carousel-item-prev{display: flex}@media (min-width: 768px){.carousel-inner .carousel-item-end.active, .carousel-inner .carousel-item-next{transform: translateX(25%)}.carousel-inner .carousel-item-start.active, .carousel-inner .carousel-item-prev{transform: translateX(-25%)}}.carousel-inner .carousel-item-end, .carousel-inner .carousel-item-start{transform: translateX(0)}

        </style>
@endpush

<div>
   <section class="section-products mt-0 pt-0">
		<div class="container">
                <div class="container text-center my-3">
                    {{-- <h2 class="font-weight-light">Bootstrap Multi Slide Carousel</h2> --}}

                    <div class="d-flex flex-row">
                        <a class="btn btn-dark btn-sm m-2" href="#recipeCarousel" role="button"
                        data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> </a>

                        <a class="btn btn-dark btn-sm m-2" href="#recipeCarousel" role="button"
                        data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> </a>
                    </div>
                    

                    <div class="row mx-auto my-auto justify-content-center">
                        
                        
                        {{-- <a class="btn btn-primary btn-sm" href="#recipeCarousel" role="button"
                        data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> </a>

                        <a class="btn btn-primary btn-sm" href="#recipeCarousel" role="button"
                        data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> </a> --}}

                        <div id="recipeCarousel" class="carousel my-carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                {{-- <div class="carousel-item my-carousel-item active d-none">
                                </div> --}}
                                @foreach ($products as $key => $product)
                                    @php ++$key @endphp
                                    <div class="carousel-item my-carousel-item {{ $key === 1 ? "active" : "" }} ">
                                        <div class="col-md-3 col-sm-2 my-3">
                                            <div class="card shadow-sm m-1">
                                                <div id="product-1" class="single-product">
                                                    {{-- <div class="part-1" style="background-image: url({{asset('/img/slide/scallops.jpg')}}); background-size:cover; transition: all 0.3s;"> --}}
                                                    @forelse ($product->productImages as $image)
                                                        @if ($image->is_thumbnail == 'thumbnail')
                                                            <div class="part-1" style="background-image: url({{ Storage::url($image->image_path.$image->file_name) }}); background-size:cover; transition: all 0.3s;">
                                                        @endif
                                                    @empty
                                                    <div class="part-1" style="background-image: url({{ Storage::url($product->image_path.$product->file_name) }}); background-size:cover; transition: all 0.3s;">

                                                    @endforelse
                                                        @if ($product->product_qty == 0)
                                                            <span class="discount">Out of Stock</span>
                                                        @endif

                                                            <ul>
                                                                    <form action="{{ route('cart.store') }}" method="POST" id="cartForm{{$key}}" enctype="multipart/form-data">
                                                                        
                                                                        @csrf

                                                                        <input type="hidden" value="{{ $product->id }}" name="id">
                                                                        <input type="hidden" value="{{ $product->product_title }}" name="name">
                                                                        <input type="hidden" value="{{ $product->product_description }}" name="description">
                                                                        <input type="hidden" value="{{ $product->product_price }}" name="price">
                                                                        {{-- <input type="hidden" value="{{ $product->image }}"  name="image"> --}}
                                                                        <input type="hidden" value="1" name="quantity">
                                                                        {{-- <button class="px-4 py-2 text-white bg-blue-800 rounded">Add To Cart</button> --}}
                                                                        <li><a href="#" type="submit" onclick=" document.getElementById('cartForm{{$key}}').submit();return false;"><i class="fas fa-shopping-cart"></i></a></li>

                                                                        {{-- <li><a href="#"><i class="fas fa-heart"></i></a></li> --}}
                                                                        {{-- <li><a href="#"><i class="fas fa-plus"></i></a></li> --}}
                                                                        <li><a href="{{ route('view-product', ['id' => $product->id]) }}"><i class="fas fa-expand"></i></a></li>
                                                                </form>

                                                            </ul>
                                                    </div>
                                                    <div class="part-2">
                                                            <h3 class="product-title">{{$product->product_title}}</h3>
                                                            {{-- <h4 class="product-old-price">Php </h4> --}}
                                                            <h4 class="product-price">Php {{$product->product_price}}</h4>

                                                            <h6 class="text-truncate m-2" >{{$product->product_description}}</h6>
                                                    </div>
                                            </div>

                                            {{-- <div class="center">
                                                
                                                <p>
                                                  </p><div class="input-group">
                                                      <span class="input-group-btn">
                                                          <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                            <i class="bi bi-plus"></i>
                                                          </button>
                                                      </span>
                                                      <input type="text" name="quant[1]" class="form-control input-number" value="8" min="8" max="30">
                                                      <span class="input-group-btn">
                                                          <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                                                            <i class="bi bi-dash"></i>
                                                          </button>
                                                      </span>
                                                  </div>
                                                <p></p>



                                            </div> --}}
                                                {{-- <div class="card-img-overlay">Slide 1</div> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                       
                            </div> 

                            {{-- <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button"
                            data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> </a> <a
                            class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button"
                            data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> </a> --}}
                            
                        </div>
                    </div>
                    <h5 class="mt-2 fw-light">Add to Cart Now!</h5>
                </div>


               
</section>
</div>

@push('myscripts')
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    let items = document.querySelectorAll('.my-carousel .my-carousel-item')

    items.forEach((el) => {
        const minPerSlide = 4
        let next = el.nextElementSibling
        for (var i=1; i<minPerSlide; i++) {
            if (!next) {
                // wrap carousel by using first child
                next = items[0]
            }
            let cloneChild = next.cloneNode(true)
            el.appendChild(cloneChild.children[0])
            next = next.nextElementSibling
        }
    })    


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