<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
    <div class="content-blue lg:flex justify-start  items-center p-10">
        <div class="mr-5">Ihre PLZ</div>
        <div class="w-20 mr-5"><input type="text" name="calc_zip" id="calc_zip" value="82024"></div>
        <div class="mr-5">Ihr Jahresverbrauch (in kWh)</div>
        <div class="w-20 mr-5"><input type="text" name="calc_usage" id="calc_usage" value="2000"></div>
        <div class="w-max"><button class="btn-primary" onclick="calculateTariff()">Berechnen</button></div>
    </div>


    <div id="result-wrapper" class=" relative my-20">
        <div id="doing-stuff" class=" bg-opacity-20 hidden pb-20 w-full h-full">
            <div class="flex p-10   justify-center items-center">
                <img class="w-[20%]" src="{{asset('img/buffering-animated-text-icon-loading-u1h739who8u5mtw3.gif')}}">
            </div>
        </div>
        <div id="result" class="hidden">
            <div id="result1">
                <div class="tariff-details">
                    <div class="flex mb-5">
                        <div class="tc-detail blue">Grundgebühr</div>
                        <div class="tc-detail-values">
                            Nur <span class="tc-strong">
                            <span id="basePrice1">{basePrice}</span> Euro monatlich</span>
                        </div>
                    </div>

                    <div class="flex mb-5 items-center">
                        <div class="tc-detail blue">Förderung</div>
                        <div class="tc-detail-values">
                            <div class="w-full flex pl-24">
                                <div class="flex items-center w-1/2 px-8  leading-5">
                                    <input id="show_plus" class="mr-2" type="radio" value="normal" name="show_plus" >
                                    <label for="show_plus">Förderung mit 0<sup>50</sup> netto / 0<sup>60</sup> brutto Cent / kWh</label>
                                </div>
                                <div class="flex items-center w-1/2 px-5 leading-5">
                                    <input id="show_plus1" class="mr-2" type="radio" value="normal" name="show_plus" >
                                    <label for="show_plus1" class="">Förderung <span class="tc-strong">Plus</span> mit 1<sup>50</sup> netto / 1<sup>79</sup> brutto Cent / kWh</label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="flex mb-5">
                        <div class="tc-detail blue">Verbrauchskosten</div>
                        <div class="tc-detail-values">
                            <span id="usage1">{usage}</span> kWh ×
                            <span id="workingPrice1" class="tc-strong">{working}</span> Cent / kWh =
                            <span id="workingTotal1" class="tc-strong">{total}</span> Euro im Jahr</div>
                    </div>
                    <div class="flex mb-5">
                        <div class="tc-detail blue">Laufzeit</div>
                        <div class="tc-detail-values">Mindestlaufzeit: 1 Monat</div>
                    </div>
                    <div class="flex mb-5">
                        <div class="tc-detail blue">Abschlag &amp; Jahresenergiekosten</div>
                        <div class="tc-detail-values">
                            <span id="abschlag1" class="tc-strong">{Abschlag}</span>
                            Euro pro Monat /
                            <span id="total1" class="tc-strong">{Total}</span> Euro im Jahr</div>
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
                    console.log(response.data);
                    var t1 = '21_ftp_fair-ez';
                    var t2 ='21_ftp_auto_S_dz';
                    var tariff = t1;
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

            })
            .catch(error => {
                console.log(error);
            });

            function formatPrice(price, subbold=false){
                p = price.toString().split('.');
                if (p[1]==undefined) {
                    p[1]="00";
                }
                if (subbold){
                    return p[0]+"<sup class='subbold'>"+p[1]+"</sup>";
                }
                else {
                    return p[0] + "<sup>" + p[1] + "</sup>";
                }
            }
        }
        </script>
</div>
