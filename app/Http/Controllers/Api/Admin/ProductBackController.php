<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Resources\ProductRessource;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\Models\Product;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as InterventionImage;
use Spatie\Image\Image;
use App\Http\Resources\UserResource;


class ProductBackController extends Controller
{
    public function index()
    {        
        $products= Product::with('category')
        ->when(request('category'), function($query){
            $query->where('category_id',request('category'));
        })
        ->orderBy('created_at','desc')
        ->paginate(30);

        return ProductRessource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['active'] = $request->has('active');
        $data['tendance'] = $request->has('tendance');

        $image = $data['image'] ?? null;
               
        if ($image) {
            $relativePath = $this->saveImage($image);    
        }
        $product = Product::create($data);
    
        return new ProductRessource($product);
    }

    public function show(Product $product)
    {
        return new ProductRessource($product);
    }

    public function update(Product $product,StoreProductRequest $request)
    {   
        $data = $request->validated();
        $data['active'] = $request->has('active');
        $data['tendance'] = $request->has('tendance');


        // if($request->hasFile('image')){
        //   //  $destinationPath ='img/';
        //     $filename = time() . '.' .$request->file('image')->getClientOriginalName();

        //     $data['image'] = $request->file('image')->storeAs('images',$filename,'public');  
          
        // }

        $image = $data['image'] ?? null;
               
        if ($image) {
            $relativePath = $this->saveImage($image);
        $data['image'] = URL::to(Storage::url($relativePath));           
        }
       $product->update($data);
    
        return new ProductRessource($product);
    }

    private function saveImage(UploadedFile $image)
    {
        $path = 'images/' . Str::random();
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0755, true);
        }
//dd($image);

        // $imagesss = Image::load($image->getClientOriginalName())
        // ->width(200)
        // ->height(200);

       // $imagesss->resize(800, 600);

       // dd($imagesss);

        // $image = InterventionImage::make($image);
        // $image->resize(300, 300);

        if (!Storage::putFileAS('public/' . $path, $image, $image->getClientOriginalName())) {
            throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
        }

        return $path . '/' . $image->getClientOriginalName();
    }


    public function destroy(Product $product)
    {
        $product->delete();

        return response()->noContent();
    }
}
