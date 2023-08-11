<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request\SliderRequest;
use App\Slider;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    use StorageImageTrait;

    private $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    public function index(){
        $sliders = $this->slider->all();
        return view('admin.slider.index')->with('sliders', $sliders);
    }
    public function create(){
        return view('admin.slider.add');
    }
    public function store(SliderRequest $request){
        try{
            DB::beginTransaction();
            $dataSlider = [
                'name' => $request->name,
                'description' => $request->content,
            ];
            $dataImageSlider = $this->storageTraitUpload($request,'image_path','slider');
            if(!empty($dataImageSlider)){
                $dataSlider['image_name'] = $dataImageSlider['file_name'];
                $dataSlider['image_path'] = $dataImageSlider['file_path'];
            }
            $this->slider->create($dataSlider);
            DB::commit();
            return redirect()->route('slider.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Log::error('Messenger: '.$exception->getMessage().'Line: '. $exception->getFile());
        }
    }
    public function edit($id){
        $slider = $this->slider->find($id);
        return view('admin.slider.edit', compact('slider'));
    }
    public function update($id, SliderRequest $request){
        try{
            DB::beginTransaction();
            $dataSlider = [
                'name' => $request->name,
                'description' => $request->content,
            ];
            $dataImageSlider = $this->storageTraitUpload($request,'image_path','slider');
            if(!empty($dataImageSlider)){
                $dataSlider['image_name'] = $dataImageSlider['file_name'];
                $dataSlider['image_path'] = $dataImageSlider['file_path'];
            }
            $this->slider->find($id)->update($dataSlider);
            DB::commit();
            return redirect()->route('slider.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Log::error('Messenger: '.$exception->getMessage().'Line: '. $exception->getFile());
        }
    }
    public function delete($id){
        try{
            $this->slider->find($id)->delete();
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
