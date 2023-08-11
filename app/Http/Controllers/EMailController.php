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

     /* public function __construct($mailData)
     {
         $this->$mailData = $mailData;
     } */

    public function sendMail($mailData)
    {
        /* $mailData = [
            'title' => 'Grüß Gott und Willkommen bei Fair Trade Power!',
            'body' => 'This is for testing email using smtp.'
        ]; */
         
        $res = Mail::to($mailData['to'])->send(new MailController($mailData));
        //if ($res['messageId']){       
            //dd("Email is sent successfully.");
        //}
        //else{
        //    dd("Email is not sent successfully");
        //}    
    }
}
