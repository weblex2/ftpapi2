<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
    <div class="content-blue lg:flex justify-start  items-center p-10 ">
        <div class="mr-5">Ihre PLZ</div>
        <div class="w-20 mr-5"><input type="text" name="calc_zip" id="calc_zip" value="82024"></div>
        <div class="mr-5">Ihr Jahresverbrauch (in kWh)</div>
        <div class="w-20 mr-5"><input type="text" name="calc_usage" id="calc_usage" value="2000"></div>
        <div class="w-max"><button class="btn-primary" onclick="calculateTariff()">Berechnen</button></div>
    </div>
    <div id="result-wrapper" class=" relative mb-10">
        <div id="doing-stuff" class="hidden  w-full h-full">
            <div class="flex bg-red-500 p-10 bg-opacity-60  justify-center items-center">    
                <img class="w-[20%]" src="{{asset('img/buffering-animated-text-icon-loading-u1h739who8u5mtw3.gif')}}">
            </div>
        </div>    
        <div id="result" class="hidden">
            <div id="result1">
                <div class="tariff-details">
                    <div class="flex mb-5">
                        <div class="text-[#0ac] text-sm text-bold mr-10 w-[40%]">Reduzierte Grundgebühr</div>
                        <div class="text-black text-sm"><strong>Nur <span id="euro_month1">0.00</span> Euro monatlich</strong></div>
                    </div>
                    <div class="flex mb-5">
                        <div class="text-[#0ac] text-sm text-bold mr-10 w-[40%]">Förderung</div>
                        <div class="text-black text-sm">Förderung mit 050 netto / 060 brutto Cent / kWh</div>
                    </div>
                    <div class="flex mb-5">
                        <div class="text-[#0ac] text-sm text-bold mr-10 w-[40%]">Verbrauchskosten</div>
                        <div class="text-black text-sm">2000 kWh × <span id="t1_wpb">63</span><sup id="t1_wpb_dec">27</sup> Cent / kWh = 1.265<sup>40</sup> Euro im Jahr</div>
                    </div>
                    <div class="flex mb-5">
                        <div class="text-[#0ac] text-sm text-bold mr-10 w-[40%]">Laufzeit</div>
                        <div class="text-black text-sm">Mindestlaufzeit: 1 Monat</div>
                    </div>
                    <div class="flex mb-5">
                        <div class="text-[#0ac] text-sm text-bold mr-10 w-[40%]">Abschlag &amp; Jahresenergiekosten</div>
                        <div class="text-black text-sm">119<sup>30</sup> Euro pro Monat / 1.431<sup>60</sup> Euro im Jahr</div>
                    </div>
                </div>
            </div>    
            <form method="GET" action="/client/freising/registrierung">
                <input type="hidden" name="zip" id="zip" value="82024">
                <input type="hidden" name="usage" id="usage" value="2300">
                <button class="btn-primary-odd">Registrieren</button> 
            </form>
        </div>
        
    </div>

    <script>
        function calculateTariff(){
            $('#result').hide();
            $('#doing-stuff').show()
            console.log("start");
            var zip = $('#calc_zip').val();
            var usage = $('#calc_usage').val();
            $('#zip').val(zip);
            $('#usage').val(usage);

            var business = 0;
            axios.get('/getTariffs/'+zip+"/"+usage+"/"+business)
                .then(response => {
                    $('#doing-stuff').hide();
                    
                    $('#euro_month1').html(response.data['23_sondertarif12']['basePriceNetto']);
                    $('#result').show();
                    console.log(response.data['23_sondertarif12']);
            })
            .catch(error => {
                console.log(error);
            });
        }
        </script>
</div>