<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
    <div id="result-wrapper" class=" relative m-20">

    </div>
    @php
        $i=0;
    @endphp
    <div id="result" class="hidden1">
            @php
                //dump($data);
            @endphp
            @foreach ($data['tariffs'] as $productCode => $tariff)
            @php
                $i++;
                if (strpos($productCode, '_fp')==false && strpos($productCode, '_dz')==false && strpos($productCode, '_ns')==false && strpos($productCode, '_nacht')==false){
                    $hiddenTarif="";
                }
                else{
                    $hiddenTarif="tarif-hidden";
                }
            @endphp
            <div class="content-wrapper">
            <div id="result_{{$productCode}}" base="24_ftp_kirche_bayern" class="{{$hiddenTarif}} tariff-result content-wrapper {{$class= $i%2==0 ? "content-odd" : "content-odd";}}">
                <div class="content">
                <form method="GET" action="/client/{{$client}}/registrierung">
                    <div class="tariff-details {{$tariff['productName']}}">
                        <div class="tc-result-line justify-start items-center text-left">
                            <div class="w-3/4 text-[#0ac]"><h2>{{$tariff['productName']}}</h2></div>
                            <div class="justify-items-end"><img class="h-[70%] w-auto" src="{{asset('img/kirche/Gruener_Strom_empfohlen_RGB_web_1181-300x209.jpg')}}"></div>
                        </div>

                        <div class="tc-result-line">
                            <div class="flex items-center mr-4">
                                <input class="float" type="radio" name="ff" value="" {{strpos($productCode, '_fp')==false ? "checked" : ""}} onclick="selectTariff($(this))">
                                <label for="billingSalutation1" class="ml-2 text-sm font-medium text-black">Floating Preis</label>
                            </div>
                            <div class="flex items-center mr-4">
                                <input class="fix" type="radio" name="ff" value="_fp" {{strpos($productCode, '_fp')==true ? "checked" : ""}} onclick="selectTariff($(this))">
                                <label for="billingSalutation1" class="ml-2 text-sm font-medium text-black">Festpreis</label>
                            </div>
                        </div>

                        <div class="tc-result-line">
                            <div class="flex items-center mr-4">
                                <input class="ez" type="radio" name="ez_dz" value="" {{strpos($productCode, '_dz')==false ? "checked" : ""}} onclick="selectTariff($(this))">
                                <label for="billingSalutation1" class="ml-2 text-sm font-medium text-black">Einzählertarif</label>
                            </div>
                            <div class="flex items-center mr-4">
                                <input class="dz" type="radio" name="ez_dz" value="_dz" {{strpos($productCode, '_dz')==true ? "checked" : ""}} onclick="selectTariff($(this))">
                                <label for="billingSalutation1" class="ml-2 text-sm font-medium text-black">Zweizählertarif</label>
                            </div>
                        </div>



                        <div class="tc-result-line">
                            <div class="tc-detail blue">Grundgebühr</div>
                            <div class="tc-detail-values">
                                Nur <span class="tc-strong">
                                <span class="basePrice">{!!$tariff['bp']!!}</span> Euro monatlich</span>
                            </div>
                        </div>

                        <div class="!hidden tc-result-line items-center">
                            <div class="tc-detail blue ">Förderung</div>
                            <div class="tc-detail-values">
                                <div class="w-full flex justify-start">
                                    <div class="flex items-center w-1/2 pr-8 ">
                                        <input id="show_normal1" checked class="mr-2" type="radio" value="normal" name="show_plus" >
                                        <label for="show_normal1">Förderung mit 0<sup>50</sup> netto / 0<sup>60</sup> brutto Cent / kWh</label>
                                    </div>
                                    <div class="flex items-center w-1/2 px-5 leading-5">
                                        <input id="show_plus1" class="mr-2" type="radio" value="normal" name="show_plus" >
                                        <label for="show_plus1" class="">Förderung <span class="tc-strong">Plus</span> mit 1<sup>50</sup> netto / 1<sup>79</sup> brutto Cent / kWh</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tc-result-line items-center">
                            <div class="tc-detail blue ">Neuanlagenförderung</div>
                            <div class="tc-detail-values">
                                <div class="w-full flex justify-start">
                                    <div class="flex items-center w-full pr-8 ">
                                        Förderung mit 0<sup>20</sup> &nbsp;netto / 0<sup>24</sup> &nbsp;brutto Cent / kWh
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tc-result-line {{strpos($productCode, '_dz')===false ? "" : "!hidden"}}">
                            <div class="tc-detail blue">Verbrauchskosten</div>
                            <div class="tc-detail-values">
                                <span >{{$data['usage']}}</span> kWh ×
                                <span class="tc-strong">{!!$tariff['wp']!!}</span> Cent / kWh =
                                <span class="tc-strong">{!!$tariff['wpTotal']!!}</span> Euro im Jahr
                            </div>
                        </div>
                        <div class="tc-result-line {{strpos($productCode, '_dz')==true ? "" : "!hidden"}}">
                            <div class="tc-detail blue">Verbrauchskosten</div>
                            <div class="tc-detail-values">
                                <div>
                                    <span class="font-bold">HT:</span>
                                    <span>{{$tariff['usageHT']}}</span>
                                    <span>kWh × {!!$tariff['wp']!!} = {!!$tariff['wpHTTotal']!!} Euro im Jahr</span>
                                </div>
                                <div>
                                    <span class="font-bold">NT:</span>
                                    <span>{{$tariff['usageNT']}}</span>
                                    <span>kWh × {!!$tariff['wpNT']!!} = {!!$tariff['wpNTTotal']!!} Euro im Jahr</span>
                                </div>
                            </div>
                        </div>

                        <div class="tc-result-line">
                            <div class="tc-detail blue">Laufzeit</div>
                            <div class="tc-detail-values">Mindestlaufzeit: 1 Monat</div>
                        </div>
                        <div class="tc-result-line">
                            <div class="tc-detail blue">Abschlag &amp; Jahresenergiekosten</div>
                            <div class="tc-detail-values">
                                <span id="abschlag1" class="tc-strong">{!!$tariff['abschlag']!!}</span>
                                Euro pro Monat /
                                <span id="total1" class="tc-strong">{!!$tariff['total']!!}</span> Euro im Jahr</div>
                        </div>
                    </div>
                    <input type="hidden" name="zip" id="zip" value="{{$data['zip']}}">
                    <input type="hidden" name="usage" id="usage" value="{{$data['usage']}}">
                    <input type="hidden" name="tariff" id="tariff" value="{{$productCode}}">
                    <button class="btn-primary-odd">Jetzt bestellen</button>
                </div>
            </div>
            </div>
            </form>
        </div>
        @endforeach
    </div>

</div>
