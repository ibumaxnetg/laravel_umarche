<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThanksMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $products;
    public $user;

    public function __construct($products, $user)
    {
        //
        $this->products = $products;
        $this->user = $user;
      }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('テスト送信完了') //タイトル
        ->subject('ご購入ありがとうございます')
        ->view('mail.thunks'); //本文
    }
}
