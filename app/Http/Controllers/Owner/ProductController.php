<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Owner;
use App\Models\Image;
use App\Models\SecondaryCategory;
use App\Models\Product;



class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:owners');

        // ミドルウェアの設定
        $this->middleware(function($request, $next){
            $id = $request->route()->parameter('product'); //shopのid取得
            if(!is_null($id)){ // null判定
                $productsOwnerId = Product::findOrFail($id)->shop->owner->id;
                $productsId = (int)$productsOwnerId; // キャスト 文字列→数値に型変換 

                if($productsId !== Auth::id()){ // 同じでなかったら
                    abort(404); // 404画面表示 
                }
            }
            return $next($request);
        });
             
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $products = Owner::findOrFail(Auth::id())->shop->product;

        // Eager(積極的) Loading で書き直します
        $ownerInfo = Owner::with('shop.product.imageFirst') 
            ->where('id', Auth::id())->get();
        // dd($ownerInfo);

        // foreach($ownerInfo as $owner) 
        //     foreach($owner->shop->product as $product) {
        //         dd($product->imageFirst->filename); 
        //     }
        // }

        return view('owner.products.index', compact('ownerInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
