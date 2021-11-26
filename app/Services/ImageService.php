<?php

namespace App\Services;

Use InterventionImage;
Use Illuminate\Support\Facades\Storage;

Class ImageService {
    public static function upload($imageFile, $folderName) { // $imageFile > 一時保存のファイル / $folderName > 保存するフォルダ名

      if(is_array($imageFile)){
        $file = $imageFile['image']; // 配列なので['key’] で取得
        // dd($imageFile['image']);
      } else {
          $file = $imageFile;
          // dd($imageFile['image']);
        }

      $fileName = uniqid(rand().'_'); // ユニークidを作成する
      $extension = $file->extension(); // 拡張子を設定
      $fileNameToStore = $fileName. '.' . $extension; 
      $resizedImage = InterventionImage::make($file)
                      ->resize(1920,1080)
                      ->encode();
      Storage::put('public/' . $folderName . '/' . $fileNameToStore, $resizedImage );
      
      return $fileNameToStore;
  } 
}
