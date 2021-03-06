<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use Illuminate\Support\Facades\Log;

// データ型テスト用
use App\Models\Owner; // エロクアント
use App\Models\Shop; 
use Illuminate\Support\Facades\DB; // QueryBuider

// Carbon
use Carbon\Carbon;
use Throwable;

class OwnersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
/*
        // データ型テスト
        $e_all = Owner::all(); //エロクアント
        $q_get = DB::table('owners')->select('name', 'created_at')->get(); // クエリビルダ get()
        $q_first = DB::table('owners')->select('name')->first(); // クエリビルダ first()
        $c_test = collect(['name' => 'てすと']); // コレクション型

        $date_now = Carbon::now();
        $date_parse = Carbon::parse(now());

        echo $date_now."<br>";
        echo $date_parse."<br>";

        // dd($e_all, $q_get, $q_first, $c_test);
*/

        $owners = Owner::select('id', 'name', 'email', 'created_at')
        ->paginate(3);

        return view('admin.owners.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.owners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 受け取った入力をインスタンス化した$requestにバリデーションをかける
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:owners'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 作成の成否確認と、失敗時の処理
        try {
            DB::transaction(function () use ($request) {
                $owner = Owner::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                Shop::create([
                    'owner_id' => $owner->id,
                    'name' => 'ここに名前をいれあます',
                    'information' => '',
                    'filename' => '',
                    'is_selling' => true,
                ]);
            }, 2);
        }
        catch(Throwable $e) {
            Log::error($e);
            throw $e;
        }

        // SQLに書き込む処理

        return redirect()->route('admin.owners.index')
        ->with([
            'message', 'オーナー登録完了しました'],
            'status', 'info',
        );
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
        $owner = Owner::findOrFail($id);

        // dd($owner);

        return view('admin.owners.edit', compact('owner'));
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
        $owner = Owner::findOrFail($id);

        $owner->name = $request->name;
        $owner->email = $request->email;
        $owner->password = Hash::make($request->password);

        $owner->save();

        return redirect()
        ->route('admin.owners.index')
        ->with([
            'message' => 'オーナー情報を更新しました',
            'status' => 'info',
        ]);
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
        // dd('削除処理');
        Owner::findOrFail($id)->delete(); //ソフトデリート 

        return redirect()
        ->route('admin.owners.index')
        ->with([
            'message' => 'オーナー情報を削除しました',
            'status' => 'alert',
        ]);
    }

    public function expiredOwnerIndex()
    {
        $expiredOwners = Owner::onlyTrashed()->get();
        return view('admin.expired-owners', compact('expiredOwners'));
    }
    public function expiredOwnerDestroy($id)
    {
        Owner::onlyTrashed()->findOrFail($id)->forceDelete(); 
        return redirect()->route('admin.expired-owners.index');
    }
}
