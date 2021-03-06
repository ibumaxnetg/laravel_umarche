<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

use App\Services\ImageService; // 下記２ファイルはImageService 内で読みます
// use Illuminate\Support\Facades\Storage;
// use InterventionImage; // 

use App\Http\Requests\UploadImageRequest;

class ShopController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:owners');

        // ミドルウェアの設定
        $this->middleware(function($request, $next){
            $id = $request->route()->parameter('shop'); //shopのid取得
            if(!is_null($id)){ // null判定
                $shopsOwnerId = Shop::findOrFail($id)->owner->id;
                $shopId = (int)$shopsOwnerId; // キャスト 文字列→数値に型変換 
                $ownerId = Auth::id();

                if($shopId !== $ownerId){ // 同じでなかったら
                    abort(404); // 404画面表示 
                }
            }
            return $next($request);
        });
             
    }

    public function index()
    {
        $ownerId = Auth::id();
        $shops = Shop::where('owner_id', $ownerId)->get();

        return view('owner.shops.index', compact('shops'));
    }

    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        // dd(Shop::findOrFail($id));
        // phpinfo();

        return view('owner.shops.edit', compact('shop'));
    }

    public function update(UploadImageRequest $request, $id)
    {

        // 受け取った入力をインスタンス化した$requestにバリデーションをかける
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'information' => ['required', 'string', 'max:1000' ],
            'is_selling' => ['required' ],
        ]);
        
        $imageFile = $request->image; // ファイルを作成し一時保存 
        if(!is_null($imageFile) && $imageFile->isValid() ){ // 画像が null でない && いｓValid() 一時保存完了か

            // Storage::putFile('public/shops', $imageFile); // リサイズなし

            $fileNameToStore = ImageService::upload($imageFile, 'shops'); 

            // 下記は[App\Services\ImageService ]に移しました
            /* ここから
             $fileName = uniqid(rand().'_'); // ユニークidを作成する
            $extension = $imageFile->extension(); // 拡張子を設定
            $fileNameToStore = $fileName. '.' . $extension;

            $resizedImage = InterventionImage::make($imageFile)
            ->resize(1920, 1080)
            ->encode();

            // dd($imageFile, $resizedImage);

            Storage::put('public/shops/' . $fileNameToStore, $resizedImage );
            ここまで */
        }

        // DB書き込み処理
        $shop = Shop::findOrFail($id);

        $shop->name = $request->name;
        $shop->information = $request->information;
        $shop->is_selling = $request->is_selling;
        if(!is_null($imageFile) && $imageFile->isValid() ){
            $shop->filename = $fileNameToStore;
        }

        $shop->save();


        return redirect()
            ->route('owner.shops.index')
            ->with([
                'message' => '店舗情報を更新しました',
                'status' => 'info',
            ]);
    }

}
