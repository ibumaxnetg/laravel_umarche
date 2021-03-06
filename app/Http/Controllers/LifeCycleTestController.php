<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeCycleTestController extends Controller
{
    public function showServiceProviderTest() {
        $encrypt = app()->make('encrypter'); // encrypter を使用できるよう make する
        $password = $encrypt->encrypt('password'); // パスワードを暗号化する

        $sanple = app()->make('ServiceProviderTest'); // サービスプロバイダテスト用

        dd($sanple, $password, $encrypt->decrypt($password)); // パスワードをデコードして表示する
    }

    //
    public function showServiceContainerTest() 
    {
        app()->bind('LifeCycleTest', function(){
            return 'ライフサイクルテスト';
        });

        $test = app()->make('LifeCycleTest');

        // サービスコンテナなし
        // $message = new Message();
        // $sample = new Sample($message);
        // $sample->run();

        // サービスコンテナ app() 使用
        app()->bind('sample', Sample::class);
        $sample = app()->make('sample');
        $sample->run();

        dd($test, app());
    }
}

class Sample 
{
    public $message;
    public function __construct(Message $message)
    {
        $this->message = $message; 
    }
    public function run()
    {
        $this->message->send(); 
    } 
}

class Message 
{
    public function send()
    {
        echo('メッセージ表示1'); 
    } 
}