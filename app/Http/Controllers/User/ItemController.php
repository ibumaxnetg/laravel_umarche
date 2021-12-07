<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Stock;
use App\Models\PrimaryCategory;
use Illuminate\Support\Facades\DB;

// メール送信用
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
// use App\Jobs\SendThanksMail;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:users');

        // ミドルウェアの設定
        $this->middleware(function($request, $next){
            $id = $request->route()->parameter('item'); //shopのid取得
            if(!is_null($id)){ // null判定
                $itemId = Product::AvailableItems()->where('product_id', $id)->exists(); // 受け取った id が存在するか、あれば true
                if(!$itemId){ // $itemId が false なら
                    abort(404); // 404画面表示
                }
            }
            return $next($request);
        });
    }

        //
    public function index(Request $request)
    {
        // dd($request);
        $categories = PrimaryCategory::with('secondary')
                        ->get();

                        $products = Product::AvailableItems()
                        ->selectCategory($request->category ?? '0')
                        ->searchKeyword($request->keyword)
                        ->sortOrder($request->sort)
                        ->paginate($request->pageination ?? '20');

        /* Models/Product.php に作ったローカルスコープで作動させる
        $stocks = DB::table('t_stocks')
            ->select('product_id', DB::raw('sum(quantity) as quantity'))
            ->groupBy('product_id')
            ->having('quantity', '>', 1);

        $products = DB::table('products')
            ->joinSub($stocks, 'stock', function($join){
                $join->on('products.id', '=', 'stock.product_id');
            })
            ->join('shops', 'products.shop_id', '=', 'shops.id')
            ->join('secondary_categories', 'products.secondary_category_id', '=', 'secondary_categories.id')
            ->join('images as image1', 'products.image1', '=', 'image1.id')
            ->join('images as image2', 'products.image2', '=', 'image2.id')
            ->join('images as image3', 'products.image3', '=', 'image3.id')
            ->join('images as image4', 'products.image4', '=', 'image4.id')
            ->where('shops.is_selling', true)
            ->where('products.is_selling', true)
            ->select('products.id as id', 'products.name as name', 'products.price' ,'products.sort_order as sort_order'
            ,'products.information', 'secondary_categories.name as category' ,'image1.filename as filename')
            ->get();
        */

        // dd($stocks, $products);
        // $products = Product::all();

/* 同期的に送信
        Mail::to('test@example.com') //受信者の指定
            ->send(new TestMail()); //Mailableクラス
*/
        // 非同期に送信
        // SendThanksMail::dispatch();

        return view('user.index', compact('products', 'categories'));
    }

    public function show($id){
        $product = Product::findOrFail($id);

        $quantity = Stock::where('product_id', $product->id)
        ->sum('quantity');

        $quantity = Stock::where('product_id', $product->id)
                            ->sum('quantity');

        if($quantity > 9) {
            $quantity = 9;
        }

        return view('user.show', compact('product', 'quantity'));
      }

}
