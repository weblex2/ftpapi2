<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\PowerCloudSoapController;
use Illuminate\Http\Request;
use App\Http\Controllers\API\PowerCloudRestController;
use Route;

class DispatcherController extends Controller
{
    #const BASEURL = 'aws.noppenberger.net/api/';
    const BASEURL = 'http://127.0.0.1:8000/api/';

    public function getClient(){
        $client =  \Route::current()->parameters['client'];
        return $client;
    }

    public function start($client){
        return view('clients.'.$client.'.start',compact('client'));
    }

    public function about($client){
        return view('clients.'.$client.'.about',compact('client'));
    }

    public function register($client){
        return view('clients.'.$client.'.register',compact('client'));
    }

    public function getTariffsPage(Request $request){
        $client = $this->getClient();
        $req = $request->all();
        $zip  = $req['zip'];
        $business  = $req['business'];
        $usage  = $req['usage'];
        #$url="https://ww24pjl1v6.execute-api.eu-central-1.amazonaws.com/prod/tariffs?postcode=82024&usage=3500&business=false&energy=electricity";
        #$res = file_get_contents($url);
        //dump($res);
        $pcs = new PowerCloudSoapController();
        $cities = $pcs->getCities($zip);
        $streets = $pcs->getStreetsInZipCode($zip);
        $provider = $pcs->getAllProvider();
        //$tariffs = $this->getTariffs($zip,$usage,$business);
        return view("clients.".$client.".tarife", compact('cities', 'streets','provider','client'));
    }



    public function submitForm(Request $request){
        $data = $request->all();
        if (!isset($data['billingAlternativeAddress'])){
            $data['billingAlternativeAddress']=false;
        }
        if ($data['campaignIdentifier']==""){
            $data['campaignIdentifier']="FTPDEFAULT";
        }
        dump($data);
        // Send Data to PowerCloud
        $pc = new PowerCloudRestController();
        $res = $pc->createOrder($data);
        print_r($res);
    }

    public function checkoutSuccess(){
        $client = $this->getClient();
        return view('clients.'.$client.'.checkoutsuccess');
    }



    public function sendApiRequest($endpoint, $data, $token){
        $url= self::BASEURL.$endpoint;
        echo"<br>" .$url."<br>";
        $headers = 'Accept: application/json';
        $ch = curl_init($url); // Initialise cURL
        $post = $data; // Encode the data array into a JSON string
        $authorization = "Authorization: Bearer ".$token; // Prepare the authorisation token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($headers , $authorization )); // Inject the token into the header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post)); // Set the posted fields
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // This will follow any redirects
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3); //timeout in seconds
        $streamVerboseHandle = fopen('php://temp', 'w+');
        curl_setopt($ch, CURLOPT_STDERR, $streamVerboseHandle);

        #$result = curl_exec($ch); // Execute the cURL statement
        if ($result === FALSE) {
            printf("cUrl error (#%d): %s<br>\n",
                curl_errno($ch),
                htmlspecialchars(curl_error($ch)))
            ;
        }

        rewind($streamVerboseHandle);
        $verboseLog = stream_get_contents($streamVerboseHandle);

        echo "cUrl verbose information:\n",
        "<pre>", htmlspecialchars($verboseLog), "</pre>\n";
        curl_close($ch); // Close the cURL connection
        #print_r($result); // Return the
    }

    public function getToken(){
        $url=self::BASEURL."apiauth";
        echo $url;
        $data['email']="noppenbe@gmx.de";
        $data['password']="hotl!ne03";

        $headers = [
            'Accept: application/json',
        ];



        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        $streamVerboseHandle = fopen('php://temp', 'w+');
        curl_setopt($ch, CURLOPT_STDERR, $streamVerboseHandle);
        $result = curl_exec($ch);


        if ($result === FALSE) {
            printf("cUrl error (#%d): %s<br>\n",
                curl_errno($ch),
                htmlspecialchars(curl_error($ch)))
            ;
        }

        rewind($streamVerboseHandle);
        $verboseLog = stream_get_contents($streamVerboseHandle);

        echo "cUrl verbose information:\n",
        "<pre>", htmlspecialchars($verboseLog), "</pre>\n";

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
