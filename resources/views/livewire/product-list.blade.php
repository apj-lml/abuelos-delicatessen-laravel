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
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal1" wire:click = "showAddProductModal">
Add Product
</button>

<div class="table-responsive">
<table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Product</th>
                <th scope="col" class="w-25">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>
                <th scope="col">Category</th>
                <th scope="col">Images</th>
                <th scope="col">Controls</th>
            </tr>
        </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->product_title}}</td>
                <td>{{$product->product_description}}</td>
                <td>{{$product->product_price}}</td>
                <td>{{$product->product_qty}}</td>
                <td>{{$product->product_category}}</td>

                <td>
                    @forelse ($product->productImages as $image)
                        {{-- {{ $image['file_name'] }} --}}
                    @empty
                        <p>No images</p>
                    @endforelse

                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageGallery" wire:click="showAddImagesModal({{$product->id}})">
                        Add Images / Change Thumbnail
                    </a>
                <!-- <img src="https://picsum.photos/200" /> -->
                </td>
                <td>
                    <div class="d-flex">
                        
                            <button class="btn btn-dark btn-sm m-2" wire:click="showEditProductModal({{$product->id}})" data-bs-toggle="modal" data-bs-target="#exampleModal1">Edit</button>
                  
                            <button class="btn btn-danger btn-sm m-2" wire:click="showDeleteProductModal({{$product->id}})">Delete</button>
                   
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
    </tfoot>
    </table>
</div>

    {{ $products->links() }}

</div>


<!-- Modal -->
<div class="modal fade" wire:ignore.self id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
      @if ($isEditMode)
            <h5 class="modal-title" id="exampleModalLabel1">Edit Product</h5>
            @else
            <h5 class="modal-title" id="exampleModalLabel1">Add Product</h5>

            @endif
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div  >
                    <form enctype="multipart/form-data">
                        <div class="col-sm-12">
                            <div class="form-floating mb-3">
                                <!-- <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"> -->
                                <input type="text" id="productTitle" wire:model.defer="productTitle" name="productTitle" value="" class="form-control" placeholder="Product Title"/>
                                <label for="productTitle">Product Title</label>
                            </div>
                            <div class="valid-feedback">
                                @error('productTitle') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="number" id="productPrice" wire:model.defer="productPrice" name="productPrice" value="" class="form-control" placeholder="Product Price"/>
                                        <label for="productPrice">Product Price</label>
                                    </div>
                                    <div class="valid-feedback">
                                        @error('productPrice') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="number" id="productQty" wire:model.defer="productQty" name="productQty" value="" class="form-control" placeholder="Qty"/>
                                        <label for="productPrice">Qty</label>
                                    </div>
                                    <div class="valid-feedback">
                                        @error('productQty') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>  
                        </div>

                        <div class="col-sm-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="category" wire:model..defer="category" aria-label="Category">
                                    <option value="Meat" hidden>-</option>
                                    <option value="Meat">Meat</option>
                                    <option value="Seafood">Seafood</option>
                                </select>
                                <label for="category">Category</label>
                            </div>
                            <div class="valid-feedback">
                                @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Product Description" wire:model.defer="productDescription" id="productDescription"  name="productDescription" style="height: 100px"></textarea>
                                <label for="productDescription">Prodcut Description</label>
                            </div>
                            <div class="valid-feedback">
                                @error('productDescription') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mt-2">
                            @if (!$isEditMode)
                            <div class="mt-1">
                                <label for="productThumbnail" class="form-label">Product Thumbnail</label>
                                <input class="form-control" type="file" id="productThumbnail{{ $iteration }}" wire:model="productThumbnail" name="productThumbnail" required>
                            </div>
                            @endif
                            @if(isset($productThumbnail))
                            <div class="col-sm-4">
                                <label for="thumbnailPreview" class="form-label">Product Thumbnail Preview:</label>
                                <img class="img-fluid img-thumbnail" id="thumbnailPreview{{ rand() }}" src="{{ $productThumbnail->temporaryUrl() }}">
                            </div>
                            @endif

                            @if(isset($productThumbnailDbPhoto))
                            <div class="col-sm-4">
                                <label for="thumbnailPreview" class="form-label">Product Thumbnail Preview:</label>
                                <img class="img-fluid img-thumbnail" id="thumbnailPreview{{ rand() }}" src="{{ Storage::url($productThumbnailDbPhoto->image_path.$productThumbnailDbPhoto->file_name) }}">
                            </div>
                            @endif
                            <div class="valid-feedback">
                                @error('productThumbnail') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-sm-12 mt-2">
                            @if (!$isEditMode)
                            <div class="mt-1">
                                <label for="productImages" class="form-label">Product Images</label>
                                <input class="form-control" type="file" id="productImages{{ $iteration }}" wire:model="productImages" name="productImages" multiple required>
                            </div>
                            @endif
                            {{-- @if (isset($productImages))
                            <label for="productImages" class="form-label">Preview:</label>
                            <div class="row">
                            @foreach ($productImages as $image)
                                <div class="col-sm-4 position-relative">
                                    <img class="img-fluid img-thumbnail" id="productImages{{ rand() }}" src="{{ $image->temporaryUrl() }}">
                                    <button type="button" class="btn-close position-absolute top-0 end-0" style="z-index:999;" aria-label="Close"></button>
                                </div>
                                @endforeach
                            </div>
                            @endif --}}

                            @if (isset($productImagesDbPhoto))
                            <label for="productImages" class="form-label">Product Images Preview:</label>
                            <div class="row">
                            @foreach ($productImagesDbPhoto as $image)


                                    <div class="col-sm-4" wire:key="{{$loop->index}}">
                                        <div class="col-sm-12 position-relative" >
                                            <img class="img-fluid img-thumbnail" id="productImages{{ rand() }}" src="{{ Storage::url($image->image_path.$image->file_name) }}">

                                            {{-- <button wire:click="removeMe({{$loop->index}})">Remove</button> --}}
                                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 start-0" wire:click="deleteImage({{$image->id}}, {{$loop->index}})"><i class="bi bi-trash"></i>Remove</button>
                                        </div>
                                    </div>
                              
                                @endforeach
                            </div>
                            @endif
                            <div class="valid-feedback">
                                @error('productImages') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </form>
                  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        @if ($isEditMode)
        <button type="button" class="btn btn-primary" wire:click="updateProduct">Update</button>
        @else
        <button type="submit" class="btn btn-primary" wire:click="addProduct">Add</button>

        @endif
      </div>
    </div>
    </div>
</div>

<div class="modal fade" wire:ignore.self id="imageGallery" tabindex="-1" aria-labelledby="imageGalleryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="imageGalleryLabel">Add Images / Change Thumbnail</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form enctype="multipart/form-data">

                <div class="col-sm-12">
                    <div class="mt-1">
                        <label for="changeProductThumbnail" class="form-label">Change Product Thumbnail</label>
                        <input class="form-control" type="file" id="changeProductThumbnail{{ $iteration }}" wire:model="changeProductThumbnail" name="changeProductThumbnail" required>
                    </div>
                    @if(isset($changeProductThumbnail))
                    <div class="col-sm-4">
                        <label for="thumbnailPreview" class="form-label">Preview:</label>
                        <img class="img-fluid img-thumbnail" id="changeProductThumbnail{{ rand() }}" src="{{ $changeProductThumbnail->temporaryUrl() }}">
                    </div>
                    @endif


                    <div class="valid-feedback">
                        @error('changeProductThumbnail') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="mt-1">
                        <label for="addProductImages" class="form-label">Add Product Images</label>
                        <input class="form-control" type="file" id="addProductImages{{ $iteration }}" wire:model="addProductImages" name="addProductImages" multiple required>
                    </div>
                    @if (isset($addProductImages))
                        <label for="addProductImages" class="form-label">Preview:</label>
                        <div class="row">
                    @foreach ($addProductImages as $image)
                        <div class="col-sm-4 position-relative" wire:key="{{$loop->index}}">
                            <img class="img-fluid img-thumbnail" id="addProductImages{{ rand() }}" src="{{ $image->temporaryUrl() }}">
                            {{-- <button type="button" class="btn-close position-absolute top-0 end-0" style="z-index:999;" aria-label="Close"></button> --}}
                            {{-- <button type="button" class="btn btn-sm btn-danger position-absolute top-0 start-0" wire:click="removeMe( {{$loop->index}})"><i class="bi bi-trash"></i>Remove</button> --}}

                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="col-sm-12 mt-2">
                    <button class="btn btn-dark btn-sm" wire:click.prevent="clearImages">Clear Inputs</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" wire:click="addAdditionalImages">Save Changes</button>
        </div>
        </div>
    </div>
    </div>

</div>

@push('myscripts')
<script type="text/javascript">

    window.addEventListener('fire-toast', event => {
        Toast.fire({
        icon: 'success',
        title: `${event.detail.message}`,
        })
    })

    window.addEventListener('remove-image', event => {
        console.log(123);
       document.getElementById(`${event.detail.id}`).innerHtml = "";
    })

</script>
@endpush