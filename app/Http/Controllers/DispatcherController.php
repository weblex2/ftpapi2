<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\PowerCloudSoapController;
use Illuminate\Http\Request;
use App\Http\Controllers\API\PowerCloudRestController;
use Route;
use App\Models\CustomerOrders;
use App\Http\Controllers\EMailController;
use App\Http\Traits\HtmlFormatTrait;

class DispatcherController extends Controller
{
    use HtmlFormatTrait;
    #const BASEURL = 'aws.noppenberger.net/api/';
    const BASEURL = 'http://127.0.0.1:8000/api/';

    public function getClient(){
        $client =  \Route::current()->parameters['client'];
        return $client;
    }

    public function start($client="freising"){
        /* $mailData['title'] = "Grüß Gott und Willkommen bei Fair Trade Power!";
        $mailData['subject'] = "Willkommen bei Fairtrade Power";
        $mailData['to'] = "alex@noppenberger.net";
        $email  = new EMailController();
        $email->sendMail($mailData);
        die(); */
        //return view('mailtemplates.kirche', compact('mailData'));
        //
        return view('clients.'.$client.'.start',compact('client'));
    }

    public function about($client){
        return view('clients.'.$client.'.about',compact('client'));
    }

    public function register($client, Request $request){

        $req = $request->all();
        $req['zip'] = isset($req['zip']) ? $req['zip'] : "";
        $req['usage'] = isset($req['usage']) ? $req['usage'] : "2000";

        if ($req['zip']=="" || $req['usage']==""){
            return redirect('/client/freising');
        }

        $pc = new PowerCloudSoapController();
        $cities = $pc->getCities($req['zip'])['data'];
        return view('clients.'.$client.'.register',compact('client','req','cities'));
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

    public function getTarifHtml($client, $zip, $usage){
        /*
        $tariff1 = '24_ftp_kirche_bayern';
        $tariff2 = '24_ftp_kirche_bayern_fp';
        $tariff3 = '24_ftp_kirche_bayern_nacht';
        $tariff_student = '24_ftp_kirche_bayern_nacht';
        $data  = [];
        foreach($tariffs as $i => $row) {
            if ($i!="24_ftp_kirche_bayern_ns"){
                $usageHT = round($usage*60/100,2);
                $usageNT = round($usage*40/100,2);
                $workingPriceBruttoHT = number_format(round($tariffs[$i]['workingPriceBrutto'],2),2,'.','');
                $workingPriceBruttoNT = number_format(round($tariffs[$i]['workingPriceNT'],2),2,'.','');
                $basePriceBrutto      = number_format(round(($tariffs[$i]['basePriceBrutto']+ $tariffs[$i]['meterChargeBrutto'])/12 ,2),2,'.','');

                $workingPriceTotal    = number_format(round($workingPriceBruttoHT * $usage/100, 2),2,'.','');
                $workingPriceTotalHT  = number_format(round($workingPriceBruttoHT * $usageHT/100, 2),2,'.','');
                $workingPriceTotalNT  = number_format(round($workingPriceBruttoNT * $usageNT/100, 2),2,'.','');

                $totalPriceBrutto     = number_format($workingPriceTotal + $basePriceBrutto*12,2,'.','');
                $totalPriceBruttoHT   = number_format($workingPriceTotalHT + $basePriceBrutto*12,2,'.','');
                $totalPriceBruttoNT   = number_format($workingPriceTotalHT + $basePriceBrutto*12,2,'.','');

                $abschlag = number_format(round($totalPriceBrutto/12, 2),2,'.','');

                $workingPriceTotalBruttoHT  = number_format(round($workingPriceBruttoHT   * $usageHT/100, 2),2,'.','');
                $workingPriceTotalBruttoNT  = number_format(round($workingPriceBruttoNT * $usageNT/100, 2),2,'.','');
                $data[$i]['basePriceBrutto'] = $basePriceBrutto;
                $data[$i]['workingPriceBrutto'] = $workingPriceBruttoHT;
                $data[$i]['workingPriceBruttoNT'] = $workingPriceBruttoNT;
                $data[$i]['totalWorkingPrice'] = $workingPriceTotal;
                $data[$i]['totalPriceBrutto'] = $totalPriceBrutto;
                $data[$i]['abschlag'] = $abschlag;
                $data[$i]['pstring'] = $basePriceBrutto."|".$workingPriceBruttoHT."|".$workingPriceTotal."|".$totalPriceBrutto."|".$abschlag;
                $data[$i]['basePriceBruttoHtml'] = explode(".",$basePriceBrutto)[0]."<sup>".explode(".",$basePriceBrutto)[1]."</sup>";
                $data[$i]['workingPriceBruttoHtml'] = explode(".",$workingPriceBruttoHT)[0]."<sup>".explode(".",$workingPriceBruttoHT)[1]."</sup>";
                $data[$i]['workingPriceBruttoHtmlHT'] = explode(".",$workingPriceBruttoHT)[0]."<sup>".explode(".",$workingPriceBruttoHT)[1]."</sup>";
                $data[$i]['workingPriceBruttoHtmlNT'] = explode(".",$workingPriceBruttoNT)[0]."<sup>".explode(".",$workingPriceBruttoNT)[1]."</sup>";
                $data[$i]['totalWorkingPriceHtml'] = explode(".",$workingPriceTotal)[0]."<sup>".explode(".",$workingPriceTotal)[1]."</sup>";
                $data[$i]['totalWorkingPriceHtmlHT'] = explode(".",$workingPriceTotalHT)[0]."<sup>".explode(".",$workingPriceTotalHT)[1]."</sup>";
                $data[$i]['totalWorkingPriceHtmlNT'] = explode(".",$workingPriceTotalNT)[0]."<sup>".explode(".",$workingPriceTotalNT)[1]."</sup>";
                $data[$i]['totalPriceBruttoHtml'] = explode(".",$totalPriceBrutto)[0]."<sup>".explode(".",$totalPriceBrutto)[1]."</sup>";
                $data[$i]['abschlagHtml'] = explode(".",$abschlag)[0]."<sup>".explode(".",$abschlag)[1]."</sup>";
                $data[$i]['code'] = $i;
                $data[$i]['name'] = $tariffs[$i]['productName'];
                $data[$i]['zip'] = $zip;
                $data[$i]['usage'] = $usage;
                $data[$i]['usageHT'] = $usageHT;
                $data[$i]['usageNT'] = $usageNT;
            }
        }
        */

        //$showTariffs[0] =
        $tariffs = file_get_contents("http://tc.noppenberger.net?zip=". $zip."&usage=".$usage);
        //dump($tariffs);
        $tariffs = json_decode($tariffs, 1);

        foreach ($tariffs as $key => $tariff){
            $usageHT    = round($usage*60/100,2);
            $usageNT    = round($usage*40/100,2);
            $basePrice  = round($tariff['basePriceBrutto']/12 + $tariff['meterChargeBrutto']/12,2);
            $wpTotal    = round($tariff['workingPriceBrutto'],2)*$usage/100;
            $wpHTTotal  = round($tariff['workingPriceBrutto'],2)*$usageHT/100;
            $wpNTTotal  = round($tariff['workingPriceNTBrutto'],2)*$usageNT/100;
            $total      = round($basePrice*12 + $wpTotal,2);
            $totalHTNT  = round($basePrice*12 + +$wpHTTotal + $wpNTTotal,2);
            if ($tariff['workingPriceNTBrutto']!="0"){
                $total = $totalHTNT;
            }
            $tariffs[$key]['usageHT'] = $usageHT;
            $tariffs[$key]['usageNT'] = $usageNT;
            $tariffs[$key]['bp'] = $this->formatPrice($basePrice);
            $tariffs[$key]['wp'] = $this->formatPrice($tariff['workingPriceBrutto']);
            $tariffs[$key]['wp'] = $this->formatPrice($tariff['workingPriceBrutto']);
            $tariffs[$key]['wpNT'] = $this->formatPrice($tariff['workingPriceNTBrutto']);
            $tariffs[$key]['wpTotal'] = $this->formatPrice($wpTotal);
            $tariffs[$key]['wpHTTotal'] = $this->formatPrice($wpHTTotal);
            $tariffs[$key]['wpNTTotal'] = $this->formatPrice($wpNTTotal);
            $tariffs[$key]['total'] = $this->formatPrice($total);
            $tariffs[$key]['totalHTNT'] = $this->formatPrice($totalHTNT);
            $tariffs[$key]['abschlag'] = $this->formatPrice($total/12);
        }
        //dump($tariffs);

        $data['zip'] = $zip;
        $data['usage'] = $usage;
        $data['tariffs'] = $tariffs;



        /*
        $base = "24_ftp_kirche_bayern";
        $tariff['float_EZ'] = $base;
        $tariff['float_DZ'] = $base."_dz";
        $tariff['fix_EZ']   = $base."_fp";
        $tariff['fix_DZ']   = $base."_dz_fp";

        $tariffs[$base]['zip'] = $zip;
        $tariffs[$base]['name'] = $base;
        $tariffs[$base]['code'] = $base;
        $tariffs[$base]['usage'] = $usage;
        $tariffs[$base]['usageHT'] = $usage*60/100;
        $tariffs[$base]['usageNT'] = $usage*40/100;
        // price // EZ/DZ / FIX/FLOAT
        // normal Tariff float
        $tariffs[$base]['wp_ez_float'] = round($data[$tariff['float_EZ']]['workingPriceBrutto'],2);
        $tariffs[$base]['bp_ez_float'] = round($data[$tariff['float_EZ']]['basePriceBrutto'],2);

        // normal Tariff fix
        $tariffs[$base]['wp_ez_fix'] = round($data[$tariff['fix_EZ']]['workingPriceBrutto'],2);
        $tariffs[$base]['bp_ez_fix'] = round($data[$tariff['fix_EZ']]['basePriceBrutto'],2);

        //dz tariff float
        $tariffs[$base]['wp_dz_float'] = round($data[$tariff['float_DZ']]['workingPriceBrutto'],2);
        $tariffs[$base]['bp_dz_float'] = round($data[$tariff['float_DZ']]['basePriceBrutto'],2);

        //dz tariff fix
        $tariffs[$base]['wp_dz_fix'] = round($data[$tariff['fix_DZ']]['workingPriceBrutto'],2);
        $tariffs[$base]['bp_dz_fix'] = round($data[$tariff['fix_DZ']]['basePriceBrutto'],2);

        // dz NT price
        $tariffs[$base]['wpNT_dz_float'] = round($data[$tariff['float_DZ']]['workingPriceNT'],2);
        $tariffs[$base]['wpNT_dz_fix'] = round($data[$tariff['fix_DZ']]['workingPriceNT'],2);
        dump($tariffs);
        */
        $html = view('components.web.tariffCalculator', ['data' => $data, 'energyUsage' => $usage, 'client'=> $client]);
        return $html;
    }


    public function submitForm(Request $request){

        $data = $request->all();
        #dump($data);
        if (!isset($data['billingAlternativeAddress'])){
            $data['billingAlternativeAddress']=false;
        }
        if ($data['campaignIdentifier']==""){
            $data['campaignIdentifier']="KIRCHE";
        }
        $data['extendedData']['GSL']['gsl_abgabe'] = "0.2";

        $data['extendedData'] = json_encode($data['extendedData']);

        // Send Data to PowerCloud
        $pc = new PowerCloudRestController();
        $result = $pc->createOrder($data);

         // Save Data to DB
        $co  = new CustomerOrders();
        $co->order_detail = json_encode($data);
        $co->result = json_encode($result);
        $co->save();
        #dump($result);

        # Send subscription mail to Alex
        $mailData['title'] = "New Subscription";
        $mailData['subject'] = "New Subscription";
        $mailData['to'] = "alex@noppenberger.org";
        $mailData['data'] = $data;
        $mailData['result'] = $result;
        $mailData['view'] = "mailtemplates.newSubscription";
        $email  = new EMailController();
        $email->sendMail($mailData);

        if (isset($result['success']) &&  $result['success']=="true"){
            $mailData['title'] = "Grüß Gott und Willkommen bei Fair Trade Power!";
            $mailData['subject'] = "Willkommen bei Fairtrade Power";
            $mailData['to'] = $data['emailPrivate'];
            $mailData['view'] = "mailtemplates.kirche";
            $email  = new EMailController();
            $email->sendMail($mailData);
            $success=true;
        }
        else{
            $success=false;
        }
        return view('clients.freising.checkoutsuccess', compact('success'));

    }

    public function checkoutSuccess(){
        $client = $this->getClient();
        return view('clients.'.$client.'.checkoutsuccess');
    }


    public function emailtest(){
        $mailData['title'] = "Grüß Gott und Willkommen bei Fair Trade Power!";
        $mailData['subject'] = "Willkommen bei Fairtrade Power";
        $mailData['to'] = "alex@noppenberger.org";
        $mailData['view'] = "mailtemplates.kirche";
        $email  = new EMailController();
        $email->sendMail($mailData);
        return view($mailData['view'], compact('mailData'));
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
