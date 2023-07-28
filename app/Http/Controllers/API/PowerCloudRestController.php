<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PowerCloudRest extends Controller
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

        $context=$type.$user.":".$pw;
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
		
		//file_put_contents('../../public/log.txt', $verboseLog);
		//file_put_contents('../../public/log2.txt', $res);
		return $res;
    }


    public function test(){
        $res['message'] = $this->doRequest('client','getContractById','GET',['id'=>752543]);
        return $res;
    }
   

    public function createOrder($dataIn){
        $dataOut = $dataIn;
        $res['message'] = $this->doRequest('client','createOrder','POST',$dataOut);
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


    function setNewOrderData($data){
        //Is Business
    	if ($res['is_business']=='true'){
    		$res['business']="1";
    		$res['email_business']=$res['email'];
    	}
    	else {
    		$res['business']="0";
    		$res['email_business']='';
    		$res['company_name']='';
    	}
    
    	 
    
    
    	//Billing Address
    	if (
    			($res['bill_address_street']!="")||
    			($res['bill_address_house_number']!="")||
    			($res['bill_address_addition']!="")||
    			($res['bill_address_zipcode']!="")||
    			($res['bill_address_city']!="")
    			) {
    				$res['billingAlternativeAddress'] = 1;
    				$res['billingPhone']         = $res['phone'];
    				$res['billingPhoneAreaCode'] = $res['phoneAreaCode'];
    				$res['billingEmail']         = $res['email'];
    			}
    
    			else {
    				 
    				$res['billingAlternativeAddress'] = 0;
    				$res['billingPhone'] = "";
    				$res['billingPhoneAreaCode'] = "";
    
    			}
    
    			// Creating Extended Data for GSL
    			$gslplus = Array('ftp_fair_plus_2017', 'ftp_plus');
    			if (in_array($res['tariff_type'],$gslplus)) $extData['GSL']['gsl_abgabe'] = '1.5';
    			else $extData['GSL']['gsl_abgabe'] = '0.5';
    
    			
    			// DZ Tariffs
    			if (in_array($res['tariff_type'],Array('ftp_np_dz','ftp_wp_dz'))){
    				$DZJson = $this->getJSONPriceString($res['deliv_address_zipcode'],$res['tariff_type'],$res['annual_consumption']);
    				$res['productBasePrice'] = $DZJson['productBasePrice'];
    				$res['productWorkingPrice'] = $DZJson['productWorkingPrice'];
    
    			}
    
    			// External ID
    			$extId="C-".date('ymd').str_pad($res['contract_id'],5,'0',STR_PAD_LEFT);
    
    			if ($res['action_code']=='SPATZ') $campaignIdentifier = 'KAMPAGNESPATZ1';
    			elseif ($res['action_code']=='EMPFEHLUNG') {
    				$campaignIdentifier = 'EMPFEHLUNG';
    				$extId .= "-".$res['recruited_from'];
    			}
    			else {
    				$campaignIdentifier='FTPDEFAULT';
    				 
    			}
    
    
    
    			$data['campaignIdentifier']             =  $campaignIdentifier;
    			$data['energy']                         = 'electricity';
    			$data['usage']                          = $res['annual_consumption'];
    			$data['business']                       = $res['business'];
    			$data['customerSpecification']          = $res['subscription_reason'];  #'desired_date','earliest_possible_date';
    			$data['salutation']                     = $res['salutation'];
    			$data['surname']                        = $res['last_name'];
    			$data['firstName']                      = $res['first_name'];
    			$data['company']                        = $res['company_name'];
    			$data['dateOfBirth']                    = $res['date_of_birth'];
    			$data['zip']                            = $res['deliv_address_zipcode'];
    			$data['city']                           = $res['deliv_address_city'];
    			$data['street']                         = $res['deliv_address_street'];
    			$data['houseNumber']                    = $res['deliv_address_house_number'];
    			
    			$data['productCode']                    = $res['tariff_type'];
    			$data['billingAlternativeAddress']      = $res['billingAlternativeAddress'];
    			$data['iban']                           = $res['iban'];
    			$data['customerAuthUserName']         	= $res['email'];
    			$data['customerAuthPassword']           = $res['password'];
    			$data['billingCompany']                 = $res['company_name'];
    			$data['billingSalutation']              = $res['salutation'];
    			$data['billingSurname']                 = $res['last_name'];
    			$data['billingFirstName']               = $res['first_name'];
    			$data['billingZip']                     = $res['bill_address_zipcode'];
    			$data['billingCity']                    = $res['bill_address_city'];
    			$data['billingStreet']                  = $res['bill_address_street'];
    			$data['billingHouseNumber']             = $res['bill_address_house_number'];
    			$data['billingEmail']                   = $res['billingEmail'];
    			//$data['billingPhone']                  = '';
    			//$data['billingPhoneAreaCode']          = '';
    			//$data['billingFax']                    = '';
    			//$data['billingFaxAreaCode']            = '';
    			$data['previousProviderCodeNumber']     = $res['previous_provider'];
    			
    			if ($res['subscription_reason']=="desired_date") {
    			    $data['desiredDate']                    = $res['delivery_start'];
    			}
    			if ($res['subscription_reason']=="terminated_in_person") {
    			    $data['terminationDate']                = $res['delivery_start'];
    			}
    			if ($res['subscription_reason']=="relocation_at") {
    			    $data['relocationDate']                 = $res['delivery_start'];
    			}
    			if ($res['subscription_reason']=="basic_supply_registration") {
    			    $data['basicSupplyDate']                = $res['delivery_start'];
    			}
    			//$data['previousProductId']            = '';
    			//$data['previousProduct']              = '';
    			//$data['previousVariant']              = '';
    			$data['phoneHome']                      = $res['phone'];
    			$data['phoneHomeAreaCode']              = $res['phoneAreaCode'];
    			$data['phoneMobile']                    = $res['phoneMobile'];
    			$data['phoneMobileAreaCode']            = $res['phoneMobileAreaCode'];
    			//$data['phoneBusiness']                = $res['phoneBusiness'];
    			//$data['phoneBusinessAreaCode']        = $res['phoneBusinessAreaCode'];
    			$data['emailPrivate']                   = $res['email'];
    			$data['emailBusiness']                  = $res['email'];
    			#$data['customerNumber']                 = $res['pc_customer_id'];
    			$data['counterNumber']                  = $res['meter_id'];
    			//$data['alternativeAccountHolder']     = '';
    			$data['adsPhone']                       = 'false';
    			$data['adsMail']                        = 'false';
    			$data['adsPost']                        = 'false';
    			$data['optionalAddOns']                 = 'false';
    			$data['signatureDate']                  = date("Y-m-d");
    			$data['vpCode']                         = '';
    			$data['uvpCode']                        = '';
    			$data['customerId']                     = $res['pc_customer_id'];
    			$data['externalId']                     = $extId;
    			$data['productBasePrice']               = $res['productBasePrice'];
    			$data['productWorkingPrice']            = $res['productWorkingPrice'];
    			//$data['productBonus']                   = '';
    			//$data['productBonusPercent']            = '';
    			//$data['productInstantBonus']            = '';
    			$data['fixedPriceType']                 = "FIX";
    			//$data['fixedPriceMonths']               = '';
    			$data['extendedData']                   = json_encode($extData);
    }
}
