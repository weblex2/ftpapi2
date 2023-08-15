<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PowerCloudRestController extends Controller
{
    private function doRequest($type,$function,$verb, $data) {
        $baseUrl = env("PC_REST_BASE_URL");
        $user    = env("PC_REST_USER");
        $pw      = env("PC_REST_PASSWORD");
        $hash    = env("PC_REST_HASH");


        $baseUrl="https://app.powercloud.de/rest:";
        $user="Fairtrade-Rest-Prod";
        $pw="vQxKgfWgsvAY7Tp7E9FG";
        $hash="9d4da1fe24e7da45dfc5c242af40d913";

        $context=$type."#".$user.":".$pw;
        $credentials = $type."#".$user.":".$pw;
        $headers = array(
            "Content-type: application/json",
            "Accept: text/json",
            "Cache-Control: no-cache",
            "Pragma: no-cache",
            "Authorization: Basic " . base64_encode($credentials)
        );
        $url=$baseUrl.$type."/".$hash."/".$function;
        $url="https://app.powercloud.de/rest:".$type."/"."9d4da1fe24e7da45dfc5c242af40d913"."/".$function;
        if ($verb=="GET"){
            $url.="?".http_build_query($data);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if ($verb=="POST") {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $context);

        curl_setopt($ch, CURLOPT_VERBOSE, true);
        $streamVerboseHandle = fopen('php://temp', 'w+');
        curl_setopt($ch, CURLOPT_STDERR, $streamVerboseHandle);
        $res = curl_exec($ch);
        if ($res === FALSE) {
            printf("cUrl error (#%d): %s<br>\n",
                curl_errno($ch),
                htmlspecialchars(curl_error($ch)).$url);
            ;
        }

        rewind($streamVerboseHandle);
        $verboseLog = stream_get_contents($streamVerboseHandle);
        $result = (json_decode($res,1)!=false) ? json_decode($res,1) : $res;
        if (isset($result['success']) &&  $result['success']=="true"){
            return $result;
        }
        else{
            return $res;
        }
    }


    public function getTariffsInfo(){
        $data  = file_get_contents('http://tc.noppenberger.net?zip=82024&usage=2000');
        $data = json_decode($data, 1);
        dump($data);
    }

    public function getProducts(){
        $res = $this->doRequest('client','getProducts','GET',['limit'=>100, 'offset' => 0]);
        $res = json_decode($res,1);
        dump($res);
    }

    public function getTariffsByCampaign($campaign){
        $res = $this->doRequest('client','getProductsByCampaign','GET',['campaignIdentifier' => $campaign, 'limit'=>100, 'offset' => 0]);
        $res = json_decode($res,1);
        dump($res['data']);
    }

    public function getProductsById(){
        $res = $this->doRequest('contract','getTariffById','GET',['id' => 'C18429', 'limit'=>100, 'offset' => 0]);
        dump($res);
        ##$res = json_decode($res,1);
        #dump($res['data']);
    }
    

    public function test(){
        $res = $this->doRequest('customer','getContractById','GET',['id'=>752543]);
        #$res = $this->doRequest('client','getProducts','GET',['limit'=>100,'offset'=>0]);
        echo "<pre>";
        print_r($res);
    }


    public function createOrder($data){
        $res = $this->doRequest('client','createOrder','POST',$data);
        return $res;
    }


    public function newOrderTest(){
        $json = '{
            "campaignIdentifier":"FTPDEFAULT",
            "energy":"electricity",
            "usage": 10,
            "business": 0,
            "salutation": 1,
            "surname": "API Test  AN",
            "firstName": "Do not confirm!!",
            "zip": "82024",
            "city": "Taufkirchen",
            "street": "Test",
            "houseNumber": "TEST",
            "productCode": "21_ftp_wp_ez",
            "billingAlternativeAddress": false,
            "customerSpecification": "desired_date",
            "phoneMobileAreaCode": "0272",
            "phoneMobile": "111111111",
            "phoneHomeAreaCode":"089",
            "phoneHome": "11111"
        }';
        $data = json_decode($json);
        $res['message'] = $this->doRequest('client','createOrder','POST',$data);
        return $res;
    }
}
