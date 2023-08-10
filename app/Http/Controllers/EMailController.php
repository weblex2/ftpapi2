<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;
use App\Mail\MailController;
class EMailController extends Controller
{
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendMail()
    {
        $mailData = [
            'title' => 'Grüß Gott und Willkommen bei Fair Trade Power!',
            'body' => 'This is for testing email using smtp.'
        ];
         
        Mail::to('alex@noppenberger.org')->send(new MailController($mailData));
           
        dd("Email is sent successfully.");
    }
}
