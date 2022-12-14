<div class="row menu-container">
@foreach ($products as $product)
<div class="col-lg-6 menu-item {{$product->product_category}}">
            <div class="menu-content">
              <a href="/view-product/{{$product->id}}">{{$product->product_title}}</a><span>Php {{$product->product_price}}</span>
            </div>
            <div class="menu-ingredients">
                {{$product->product_description}}
            </div>
          </div>
@endforeach
</div>
