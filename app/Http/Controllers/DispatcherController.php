<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\PowerCloudRestController;

class DispatcherController extends Controller
{
    #const BASEURL = 'aws.noppenberger.net/api/';
    const BASEURL = 'http://127.0.0.1:8000/api/';

    public function start(){
        return view('clients.freising.start');
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
        $pc = new PowerCloudRestController();
        dump();
        $res = $pc->createOrder($data);
        print_r($res);

        /*
        echo "<pre>";
        $data = $request->all();
        print_r($data);
        $token = $this->getToken();
        echo $token;
        $res = $this->sendApiRequest("createOrder",$data, $token);
        #print_r($res);
        */
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
