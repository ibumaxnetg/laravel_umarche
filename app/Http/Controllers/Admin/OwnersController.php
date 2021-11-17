<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// データ型テスト用
use App\Models\Owner; // エロクアント
use Illuminate\Support\Facades\DB; // QueryBuider

// Carbon
use Carbon\Carbon;

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

        return view('admin.owners.index', compact('e_all', 'q_get'));
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