<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Shop;
use App\Models\SecondaryCategory;
use App\Models\Image;
use App\Models\Stock;


class Product extends Model
{
    use HasFactory;

    public function shop()
    {
      return $this->belongsTo(Shop::class); 
    }    

    // メソッド名を secondary_category_id にしなかったので第２引数に secondary_category_id を入れる
    public function category()
    { 
      return $this->belongsTo(SecondaryCategory::class, 'secondary_category_id');
    }

    // table名と同じ名前は登録できないので imageFirst に設定
    public function imageFirst()  
    {
      // 第２引数に テーブルカラム名、第３引数に イメージモデルの'id'と紐付ける
      return $this->belongsTo(Image::class, 'image1', 'id');
    }

    public function stock()
    {
      return $this->hasMany(Stock::class); 
    }    

}
