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
            <div id="result_{{$productCode}}" base="24_ftp_kirche_bayern" class="{{$hiddenTarif}} tariff-result content-wrapper {{$class= $i%2==0 ? "content-even" : "content-even";}}">
                <div class="content">
                <form method="GET" action="/client/freising/registrierung">
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
    <script>
        /*
        function selectTariff(el){
            var wrapper = el.closest('.content-wrapper');
            var base = wrapper.attr('base');
            var ff = wrapper.find('input[name=ff]:checked').val();
            var ezdz = wrapper.find('input[name=ez_dz]:checked').val();
            
            if (ff==""){
                $('.float').prop('checked', true);
                $('.fix').prop('checked', false);
            }
            else{
                $('.float').prop('checked', false);
                $('.fix').prop('checked', true);
            }
            if (ezdz==""){
                $('.ez').prop('checked', true);
                $('.dz').prop('checked', false);
            }
            else{
                $('.dz').prop('checked', true);
                $('.ez').prop('checked', false);
            }
            
            var selected  =  base+ezdz+ff;
            console.log('wrapper:' + wrapper);
            console.log('ff:' + ff);
            console.log('ez_dz:' + ezdz);
            console.log('div tariff selected :' + '#result_'+selected);
            $('.tariff-result').addClass('tarif-hidden');
            console.log('try to change:'+ '#result_'+selected);
            $('#result_'+selected).removeClass('tarif-hidden');
            /*
            $('#result').hide();
            $('#doing-stuff').show()
            console.log("start");
            var zip = $('#calc_zip').val();
            var usage = $('#calc_usage').val();
            $('#zip').val(zip);
            $('#usage').val(usage);
            var business = 0;
            axios.get('/getTarifHtml/'+zip+"/"+usage)
                .then(response => {
                    $('#doing-stuff').hide();
                    console.log(response.data);
                    var tariff = '21_ftp_fair-ez';
                    var tariffplus ='21_ftp_fair_plus_ez';
                    console.log(response.data[tariff]);
                    var basePriceBrutto = response.data[tariff]['basePriceBrutto'];
                    var workingPriceBrutto = response.data[tariff]['workingPriceBrutto'];
                    basePriceBrutto = (Math.round(basePriceBrutto/12 * 100) / 100).toFixed(2);
                    workingPriceBrutto = (Math.round(workingPriceBrutto * 100) / 100).toFixed(2);
                    var workingPriceTotal = (parseFloat(workingPriceBrutto)*parseFloat(usage)/100).toFixed(2);
                    var total = (parseFloat(basePriceBrutto)*12+parseFloat(workingPriceTotal)).toFixed(2);
                    var abschlag = (parseFloat(total)/12).toFixed(2);
                    console.log("BasePrice" +basePriceBrutto);
                    console.log("WorkingPrice" +workingPriceBrutto);
                    console.log("WorkingPriceTotal" +workingPriceTotal);
                    console.log("Total" +total);
                    console.log("Abschlag" +abschlag);
                    $('#basePrice1').html(formatPrice(basePriceBrutto));
                    $('#workingPrice1').html(formatPrice(workingPriceBrutto));
                    $('#workingTotal1').html(formatPrice(workingPriceTotal));
                    $('#usage1').html(usage);
                    $('#total1').html(formatPrice(total));
                    $('#abschlag1').html(formatPrice(abschlag));
                    $('#result').show();
                    $('#bp1').val(basePriceBrutto);
                    $('#wp1').val(workingPriceBrutto);
                    $('#wto1').val(workingPriceTotal);
                    $('#ab1').val(abschlag);
                    $('#to1').val(total);

                    var basePriceBruttoPlus = response.data[tariffplus]['basePriceBrutto'];
                    var workingPriceBruttoPlus = response.data[tariffplus]['workingPriceBrutto'];
                    basePriceBruttoPlus = (Math.round(basePriceBruttoPlus/12 * 100) / 100).toFixed(2);
                    workingPriceBruttoPlus = (Math.round(workingPriceBruttoPlus * 100) / 100).toFixed(2);
                    var workingPriceTotalPlus = (parseFloat(workingPriceBruttoPlus)*parseFloat(usage)/100).toFixed(2);
                    var totalPlus = (parseFloat(basePriceBruttoPlus)*12+parseFloat(workingPriceTotalPlus)).toFixed(2);
                    var abschlagPlus = (parseFloat(totalPlus)/12).toFixed(2);

                    $('#bpp1').val(basePriceBruttoPlus);
                    $('#wpp1').val(workingPriceBruttoPlus);
                    $('#wtop1').val(workingPriceTotalPlus);
                    $('#abp1').val(abschlagPlus);
                    $('#top1').val(totalPlus);

                })
            .catch(error => {
                console.log(error);
            });
            */    
        }
        </script>
</div>
