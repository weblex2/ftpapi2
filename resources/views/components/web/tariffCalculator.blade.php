<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
    <div id="result-wrapper" class=" relative m-20">
        
    </div>    
    @php
        $i=0;
        //dump($data);
    @endphp
    <div id="result" class="hidden1">
            
            @foreach ($data as $key => $tariff)
            @php 
                $i++;
            @endphp
            <div id="result_{{$key}}" class="content-wrapper {{$class= $i%2==0 ? "content-even" : "content-odd";}}">
                <div class="content">
                <form method="GET" action="/client/freising/registrierung">
                    {{-- <input type="hidden" id="normal"  value="{{$tariff[0]['pstring']}}">
                    <input type="hidden" id="plus"    value="{{$tariff[1]['pstring']}}">
                    <input type="hidden" id="student" value="{{$tariff[1]['pstring']}}"> --}}

                    <div class="tariff-details">
                        <div class="tc-result-line justify-start p-0 relative">
                            <div class="w-3/4"><h2>{{$tariff['name']}}</h2></div>
                            <div><img class="h-[70%] w-auto" src="{{asset('img/kirche/Gruener_Strom_empfohlen_RGB_web_1181-300x209.jpg')}}"></div>
                        </div>
                        <div class="tc-result-line">
                            <div class="tc-detail blue">Grundgebühr</div>
                            <div class="tc-detail-values">
                                Nur <span class="tc-strong">
                                <span id="basePrice1">{!!$tariff['basePriceBruttoHtml']!!}</span> Euro monatlich</span>
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
                            <div class="tc-detail blue ">Förderung</div>
                            <div class="tc-detail-values">
                                <div class="w-full flex justify-start">
                                    <div class="flex items-center w-full pr-8 ">
                                        Förderung mit 0<sup>20</sup> &nbsp;netto / 0<sup>24</sup> &nbsp;brutto Cent / kWh
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="tc-result-line">
                            <div class="tc-detail blue">Verbrauchskosten</div>
                            <div class="tc-detail-values">
                                <span id="usage1">{{$energyUsage}}</span> kWh ×
                                <span id="workingPrice1" class="tc-strong">{!!$tariff['workingPriceBruttoHtml']!!}</span> Cent / kWh =
                                <span id="workingTotal1" class="tc-strong">{!!$tariff['totalWorkingPriceHtml']!!}</span> Euro im Jahr</div>
                        </div>
                        <div class="tc-result-line">
                            <div class="tc-detail blue">Laufzeit</div>
                            <div class="tc-detail-values">Mindestlaufzeit: 1 Monat</div>
                        </div>
                        <div class="tc-result-line">
                            <div class="tc-detail blue">Abschlag &amp; Jahresenergiekosten</div>
                            <div class="tc-detail-values">
                                <span id="abschlag1" class="tc-strong">{!!$tariff['abschlagHtml']!!}</span>
                                Euro pro Monat /
                                <span id="total1" class="tc-strong">{!!$tariff['totalPriceBruttoHtml']!!}</span> Euro im Jahr</div>
                        </div>
                    </div>
                    <input type="hidden" name="zip" id="zip" value="{{$tariff['zip']}}">
                    <input type="hidden" name="usage" id="usage" value="{{$tariff['usage']}}">
                    <input type="hidden" name="tariff" id="tariff" value="{{$tariff['code']}}">
                    <button class="btn-primary-odd">Registrieren</button>
                </div>
            </div>    
            </form>
        </div>
        @endforeach
    </div>

    <script>



        function calculateTariff(){
            console.log("hllo");
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
