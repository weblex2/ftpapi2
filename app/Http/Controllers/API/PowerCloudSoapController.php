<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PowerCloudSoapController extends Controller
{
    function __construct() {
        //parent::__construct();   
        
    }

    public function getHeader(){
        $auth = new \stdClass();
        $auth->username = 'FairTrade'; 
        $auth->password = 'ca14ad604f16c133f7f3aaa94cd0f3b109390f2c';
        return new \SoapHeader('http://electricity.enet.service.ws.crmi.de/', 'Authorization', $auth);
    }    

    public function getCities($zip){
        $url = "https://ww24pjl1v6.execute-api.eu-central-1.amazonaws.com/prod/getCitiesInZipCode?zip=".$zip;
        $res = file_get_contents($url);
        return(json_decode($res,1));
    }

    public function getStreetsInZipCode($zip){
        $url="https://ww24pjl1v6.execute-api.eu-central-1.amazonaws.com/prod/getStreetsInZipCode?zip=".$zip;
        $res = file_get_contents($url);
        $res = json_decode($res,1)['street'];
        foreach($res as $key => $value){
            $res[$key]['id'] = $value['name'];
        }
        return($res);
    }

    public function getInfo(Request $request){
        $req = $request->all();
        $zip  = $req['zip'];
        $business  = $req['business'];
        $usage  = $req['usage'];
        #$url="https://ww24pjl1v6.execute-api.eu-central-1.amazonaws.com/prod/tariffs?postcode=82024&usage=3500&business=false&energy=electricity";
        #$res = file_get_contents($url);
        //dump($res);
        $cities = $this->getCities($zip);
        $streets = $this->getStreetsInZipCode($zip);
        return view('clients.freising.checkout', compact('cities', 'streets'));
    }
 
    public function getTariffs2(){
        $zip = "82024";
        $this->getCities("82008");
        $this->getStreetsInZipCode($zip);
        return;
        echo "los";
        $options = [
            'trace' => true,
            //'cache_wsdl' => WSDL_CACHE_NONE,
            'pm_process_idle_timeout' => 3,
            'exceptions' => true, 
            'connection_timeout' => 5,
            'soap_version'=> SOAP_1_1,
            'Content-Type' => 'application/soap+xml; charset="utf-8""'
        ];
        
        $credentials = [
            'username' => 'FairTrade',
            'password' => 'ca14ad604f16c133f7f3aaa94cd0f3b109390f2c'
        ];
        $NAMESPACE = 'http://electricity.enet.service.ws.crmi.de/';
        $wdsl = 'https://energy.service-nodes.powercloud.de/service/Electricity?wsdl';
        $url ="https://app.powercloud.de/service:gateway?key=00cf99e4150aeed6def3f9f403f24754&energy=electricity";
        $header = new SoapHeader($NAMESPACE, 'Authorization', $credentials);
        
        $client = new SoapClient($wdsl, $options); // null for non-wsdl mode
        
        
        $client->__setSoapHeaders($this->getHeader());
        $client->__setLocation($url);
        $params = [
            "campaignIdentifier" => 'FTPDEFAULT1',
            "cityId" => 13976,
            "usage" => 2000,
            "netNumber" => false,
            "business" => 0,
            "modules" => 'custom',
            "codeNumberBlacklist" => "",
            "customConfig" => '[{"customIds":[],"importsIds":[],"excludeIds":[]}]',
            "productConfig" => "",
            #productCode => $productCode,
            "fixedConfig" => 0,
            "tariffHost" => "https://app.powercloud.de",
            //"startDate" => '2015-08-01',
            //"endDate" => '2999-09-28',
            "isTariffChange" => 1,
            "settingEco" => 0,
            "settingFakeEco" => 0,
            "ignoreDateFilters" => 1,
            "initialDuration"=>0,
            "settingPackage" => 0,
            "settingBonus" =>0,
            "settingPrepaid" => 0,
            "settingGuarantee" => 0,
            "skipModuleFiltering" => 0,
            //"netNumber" => 0,
            //"customerAuthUserName" => 102,
        ];
        echo "<pre>"; 
        print_r($client);
        try{
            //$response = $client->__soapCall("getModuleInformation", $params);
            $result = $client->getModuleInformation($params);
        } catch(\Exception $e){

            //$result = $client->getModuleInformation($params);
            dump($client->__getLastRequest());
            dump($e);
        }    
           
        // 'GetResult' being the name of the soap method
        //print_r($result);
    }
}
