<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\ProductImages;

use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

class ProductList extends Component
{

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $showingAddProductModal = false;
    public $isEditMode = false;

    public $productTitle;
    public $category;
    public $productDescription;
    public $productThumbnail;
    public $productImages;
    public $productQty;
    public $productPrice;
    public $iteration;
    public $productImagesDbPhoto = [];
    public $productThumbnailDbPhoto;

    public $changeProductThumbnail;
    public $addProductImages;

    public $current_pid;

    public $editproduct;
    
    protected $rules = [
        'productTitle' => 'required|min:6',
        'category' => 'required',
        'productDescription' => 'required|max:150',
        'productImages' => 'required|image|mimes:jpg,jpeg,png,svg,gif',
        'productQty' => 'required',
        'productPrice' => 'required',
        'productThumbnail' => 'required|image|mimes:jpg,jpeg,png,svg,gif',
    ];
    
    public function showAddProductModal()
    {
        $this->reset();

        $this->isEditMode = false;

        $this->showingAddProductModal = true;
    }

    public function showEditProductModal($id)
    {
        $this->reset();
        
        $this->editproduct = Product::with('productImages')->findOrFail($id);

        $this->productTitle = $this->editproduct->product_title;
        $this->productDescription = $this->editproduct->product_description;
        $this->productPrice = $this->editproduct->product_price;
        $this->productQty = $this->editproduct->product_qty;
        $this->category = $this->editproduct->product_category;
        
        $this->isEditMode = true;

        // $this->showingAddProductModal = true;

        $imagesToEdit = Product::find($id)->productImages;

        foreach($imagesToEdit as $imageToEdit){
            if($imageToEdit->is_thumbnail == "thumbnail"){
                $this->productThumbnailDbPhoto = $imageToEdit;
                // $this->productThumbnailDbPhoto = Storage::url($imageToEdit->image_path.$imageToEdit->file_name);
            }else{
                // $this->productImagesDbPhoto = Storage::url($imageToEdit->image_path.$imageToEdit->file_name);
                $this->productImagesDbPhoto[] = $imageToEdit;
            }
        }
        $this->current_pid = $id;

    }

     public function showAddImagesModal($id)
    {
        $this->reset();
        $this->current_pid = $id;
    }

    public function addProduct()
    {

        // dd("HERE");
        // $this->isEditMode = false;


        // $this->validate();
        
        $create = Product::create([
            'product_title' => $this->productTitle,
            'product_description' => $this->productDescription,
            'product_price' => $this->productPrice,
            'product_qty' => $this->productQty,
            'product_category' => $this->category,
        ]);

        $lastInsertID = $create->id;

        // $thumbnailImage = $this->productThumbnail->store('public/img/product_images');

        $file_name = 'img_'.Carbon::now()->getPreciseTimestamp(3);

        $orginal_name = $this->productThumbnail->getClientOriginalName();
        $fileExtn = explode(".",$orginal_name);

        $this->productThumbnail->storeAs('public/img/product_images/', $file_name.".".$fileExtn[1]);


        $insertThumbnail = ProductImages::create([
            'image_path' => 'public/img/product_images/',
            'file_name' => $file_name.".".$fileExtn[1],
            'product_id' => $lastInsertID,
            'is_thumbnail' => 'thumbnail'
        ]);

        foreach ($this->productImages as $photo) {
            $file_name = 'img_'.Carbon::now()->getPreciseTimestamp(3);

            $orginal_name = $photo->getClientOriginalName();
            $fileExtn = explode(".",$orginal_name);

            $photo->storeAs('public/img/product_images/', $file_name.".".$fileExtn[1]);

            // $dataValid = $this->validate([
            //     $photo => 'required|image|mimes:jpg,jpeg,png,svg,gif',
            // ]);

            $insertImages = ProductImages::create([
                'image_path' => 'public/img/product_images/',
                'file_name' => $file_name.".".$fileExtn[1],
                'product_id' => $lastInsertID,
                'is_thumbnail' => 'content_image'
            ]);
        }

        $this->reset();
        $this->productThumbnail=null;
        $this->iteration++;

        $this->dispatchBrowserEvent('fire-toast', ['message' => 'New product successfully created.']);


    }

    public function addAdditionalImages()
    {

        if($this->addProductImages){
            foreach ($this->addProductImages as $photo) {
                $file_name = 'img_'.Carbon::now()->getPreciseTimestamp(3);
    
                $orginal_name = $photo->getClientOriginalName();
                $fileExtn = explode(".",$orginal_name);
    
                $photo->storeAs('/img/product_images/', $file_name.".".$fileExtn[1]);
    
                // $dataValid = $this->validate([
                //     $photo => 'required|image|mimes:jpg,jpeg,png,svg,gif',
                // ]);
    
                $insertImages = ProductImages::create([
                    'image_path' => 'public/img/product_images/',
                    'file_name' => $file_name.".".$fileExtn[1],
                    'product_id' => $this->current_pid,
                    'is_thumbnail' => 'content_image'
                ]);
            }
        }

        /* -------------------------------------------------------------------------- */
        /*                            CHANGING OF THUMBNAIL                           */
        /* -------------------------------------------------------------------------- */

        if($this->changeProductThumbnail){

            $new_file_name = 'img_'.Carbon::now()->getPreciseTimestamp(3);

            $new_orginal_name = $this->changeProductThumbnail->getClientOriginalName();
            $newfileExtn = explode(".",$new_orginal_name);
    
            $this->changeProductThumbnail->storeAs('/img/product_images/', $new_file_name.".".$newfileExtn[1]);
    
            $updateThumbnail = ProductImages::where('product_id', $this->current_pid)->where('is_thumbnail', 'thumbnail')->update([
                'file_name' => $new_file_name.".".$newfileExtn[1]
            ]);
    
    
            $this->reset();
            $this->changeProductThumbnail=null;
            $this->iteration++;
    
            
    
        }

        if($this->changeProductThumbnail || $this->addProductImages){
            $this->dispatchBrowserEvent('fire-toast', ['message' => 'Successfully saved changes.']);

        }


    }

    public function updateProduct()
    {
        // $this->validate();
        $this->editproduct->update([
            'product_title' => $this->productTitle,
            'product_description' => $this->productDescription,
            'product_price' => $this->productPrice,
            'product_qty' => $this->productQty,
            'product_category' => $this->category,
        ]);

        $this->reset();

        // $this->showEditProductModal($this->current_pid);

        $this->dispatchBrowserEvent('fire-toast', ['message' => 'Successfully saved changes.']);

    }


    public function deleteImage($id, $index){

        // $this->dispatchBrowserEvent('remove-image', ['id' => $index]);

        // array_splice($this->productImagesDbPhoto, $index, 1);
        
        // $this->productImagesDbPhoto->reset();

        // dd($this->productImagesDbPhoto);


        $deleteProductImage = ProductImages::findOrFail($id);
        Storage::delete($deleteProductImage->image_path.$deleteProductImage->file_name);
        $deleteProductImage->delete();

        $this->showEditProductModal($this->current_pid);

    }

    public function removeMe($index)
{
    // dd($this->productImagesDbPhoto);

        array_splice($this->addProductImages, $index);


}

public function clearImages()
{
    $this->reset();
    $this->iteration++;


}
    public function showDeleteProductModal($id)
    {
        $deleteProduct = Product::findOrFail($id);
        $deleteProductImages = ProductImages::where('product_id', '=', $id);
        $imagesToDelete = Product::find($id)->productImages;
        $file_path = $deleteProduct->image_path;

        // dd($deleteProduct);

        foreach($imagesToDelete as $del){
            // dd($del->image_path.$del->file_name);
            Storage::delete($del->image_path.$del->file_name);
        }
        

        $deleteProduct->delete();
        $deleteProductImages->delete();
        $this->reset();
    }


    public function render()
    {
        $products = Product::with('productImages')->paginate(5);

        // dd(DB::getQueryLog());

        return view('livewire.product-list', ['products'=>$products]);
    }

}
