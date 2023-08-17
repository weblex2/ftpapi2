<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;
use App\Mail\MailController;
class EMailController extends Controller
{
 
    public $mailData;
     /**
     * Write code on Method
     *
     * @return response()
     */

    public function sendMail($mailData)
    {
       $res = Mail::to($mailData['to'])->send(new MailController($mailData));
   
    }
}
