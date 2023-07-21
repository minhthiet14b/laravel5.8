<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait  StorageImageTrait{
    public function storageTraitUpload($request, $fieldName, $foderName){
        if ($request->hasFile($fieldName)){
            $file = $request->$fieldName;
            $filenameOrigin = $file->getClientOriginalName();
            $filenameHash = str_random(20)."-".$file->getClientOriginalExtension();
            $filepath = $request->file($fieldName)->storeAs('public/'. $foderName .'/'.auth()->id(),$filenameHash);
            $dataUploadTrait = [
                'file_name' => $filenameOrigin,
                'file_path' => Storage::url($filepath),
            ];
            return $dataUploadTrait;
        }
        return null;
    }
    public function storageTraiImgUploadMutiple($file, $foderName){
            $filenameOrigin = $file->getClientOriginalName();
            $filenameHash = str_random(20)."-".$file->getClientOriginalExtension();
            $filepath = $file->storeAs('public/'. $foderName .'/'.auth()->id(),$filenameHash);
            $dataUploadTrait = [
                'file_name' => $filenameOrigin,
                'file_path' => Storage::url($filepath),
            ];
            return $dataUploadTrait;
    }
}


