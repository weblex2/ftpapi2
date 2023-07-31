<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DispatcherController extends Controller
{
    public function start(){
        return view('clients.freising.start');
    }
    public function submitForm(Request $request){
        $token = $this->getToken();
        echo $token;
        dump($request);
    }

    public function sendApiRequest($endpoint, $data){

    }

    public function getToken(){
        $url="aws.noppenberger.net/api/apiauth";
        $data['email']="noppenbe@gmx.de";
        $data['password']="hotl!ne03";
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        //curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        // Check if any error occurred
        if (!curl_errno($ch)) {
            $httpinfo = curl_getinfo($ch);
        }

        curl_close($ch);
        if ($httpinfo["http_code"]=="200"){
            $token = explode("|",json_decode($result,1)['data']['token'])[1];
            return $token;
        }
        else{
            //errorhandling
        }
    }
}
