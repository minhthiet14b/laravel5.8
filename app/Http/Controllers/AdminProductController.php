<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recusive;
use App\Http\Requests\Request\ProductsRequest;
use App\Product;
use App\ProductImage;
use App\ProductTag;
use App\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use DB;

class AdminProductController extends Controller
{
    //
    use StorageImageTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;
    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }
    public function index(){
        $products = $this->product->paginate(5);
        return view('admin.product.index', compact('products'));
    }
    public function create(){
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.product.add',compact('htmlOption'));
    }
    public function getCategory($parentId){
        $data = $this->category->all();
        $recursive = new Recusive($data);
        $htmlOption = $recursive->categoryRecursive($parentId);
        return $htmlOption;
    }
    public function store(ProductsRequest $request)
    {
        try{
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_img_path', 'product');
            if(!empty($dataUploadFeatureImage)){
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_img_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);
            // dd($dataProductCreate);

            //inset data to image product_images
            if($request->hasFile('img_path')){
                foreach($request->img_path as $fileItem){
                    $dataProductImageDetail = $this->storageTraiImgUploadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);
                }
            }
            if($request->tags){
                foreach($request->tags as $tagItem){
                    //insert to tags
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
                $product->tags()->attach($tagIds);
            }
            // insert tags to product_tag
            DB::commit();
            return redirect()->route('product.index');
        }
        catch(\Exception $exception){
            DB::rollBack();
            Log::error('Messenger: '.$exception->getMessage().'File: '.$exception->getFile().'Line: '. $exception->getLine());
        }
    }

    public function edit($id){
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.product.edit',compact('htmlOption','product'));
    }
    public function update($id, ProductsRequest $request){
        try{
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_img_path', 'product');
            if(!empty($dataUploadFeatureImage)){
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_img_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);
            // dd($dataProductCreate);

            //inset data to image product_images
            if($request->hasFile('img_path')){
                $this->productImage->where('product_id',$id)->delete();
                foreach($request->img_path as $fileItem){
                    $dataProductImageDetail = $this->storageTraiImgUploadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);
                }
            }

            // insert tags to product_tag
            foreach($request->tags as $tagItem){
                //insert to tags
                $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                $tagIds[] = $tagInstance->id;
            }
            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('product.index');
        }
        catch(\Exception $exception){
            DB::rollBack();
            Log::error('Messenger: '.$exception->getMessage().'File: '.$exception->getFile().'Line: '. $exception->getLine());
        }
    }
    public function delete($id){
        try{
            $this->product->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        }catch(\Exception $exception){
            Log::error('Messenger: '.$exception->getMessage().'Line: '. $exception->getFile());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
