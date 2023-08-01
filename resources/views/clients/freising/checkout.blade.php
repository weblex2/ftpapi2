@extends('layouts.freisinglayout')
@section('content')
    <div class="content-wrapper content-blue">
        <div class="content tariff relative">
                <form id="frmT1" method="POST" action="{{route("checkout")}}">
                    @csrf
                    <div class="headline mb-5">
                        <div><img class="w-12 h-auto mt-3 mr-4 text-white" src="{{asset('img/ckj13utoq0015ntxqoughe2ek-ckewz14od001kzsxq2b3nhal5-fair-ic.svg')}}"></div>
                        <div>
                            <h3 class=" tariff-h1">Fair</h3>
                            <h4>Von ÖKO-TEST 04/2022 mit "sehr gut" bewertet</h4>
                        </div>
                        <div class="flex items-center justify-center text-2xl">
                            <div>Student</div>
                        </div>
                    </div>

                    <div class="relative">
                        <div id="loader1" class="absolute hidden z-10 w-full h-full flex bg-white bg-opacity-50 items-center justify-center">
                            <img class="w-20 h-auto" src="{{asset('img/buffering-animated-text-icon-loading-u1h739who8u5mtw3.gif')}}">
                        </div>

                        <div class="tariff-details">
                            <div class="flex mb-5">
                                <div class="tariff-details-key">Reduzierte Grundgebühr</div>
                                <div class="tariff-details-value"><strong>Nur 11<sup>35</sup> Euro monatlich</strong></div>
                            </div>
                            <div class="flex mb-5">
                                <div class="tariff-details-key">Förderung</div>
                                <div class="tariff-details-value">Förderung mit 050 netto / 060 brutto Cent / kWh</div>
                            </div>
                            <div class="flex mb-5">
                                <div class="tariff-details-key">Verbrauchskosten</div>
                                <div class="tariff-details-value">{{$_POST['usage']}} kWh × <span id="t1_wpb"></span><sup id="t1_wpb_dec"></sup> Cent / kWh = 1.265<sup>40</sup> Euro im Jahr</div>
                            </div>
                            <div class="flex mb-5">
                                <div class="tariff-details-key">Laufzeit</div>
                                <div class="tariff-details-value">Mindestlaufzeit: 1 Monat</div>
                            </div>
                            <div class="flex mb-5">
                                <div class="tariff-details-key">Abschlag & Jahresenergiekosten</div>
                                <div class="tariff-details-value">119<sup>30</sup> Euro pro Monat / 1.431<sup>60</sup> Euro im Jahr</div>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </div>
    <!-- User Data -->
    <div class="content-wrapper content-white">
        <div class="content">
         <form id="frmChkout" action="/client/submitForm" method="POST">
            @csrf
         <h2>Lieferanschrift</h2>
         <div class="flex mb-5">
            <div class="flex items-center mr-4">
                <input id="salutation" type="radio" value="2" name="salutation" required >
                <label for="salutation1" class="ml-2 text-sm font-medium text-black">Frau</label>
            </div>
            <div class="flex items-center mr-4">
                <input id="salutation2" type="radio" value="1" name="salutation"  required>
                <label for="salutation2" class="ml-2 text-sm font-medium text-black">Herr</label>
            </div>
            <div class="flex items-center mr-4">
                <input id="salutation2" type="radio" value="3" name="salutation"  required>
                <label for="salutation2" class="ml-2 text-sm font-medium text-black">Familie</label>
            </div>
            <div class="flex items-center mr-4">
                <input id="salutation3" type="radio" value="8" name="salutation"  required>
                <label for="salutation3" class="ml-2 text-sm font-medium text-black">Firma</label>
            </div>
            <div class="flex items-center mr-4">
                <input id="salutation4" type="radio" value="9" name="salutation" required >
                <label for="salutation4" class="ml-2 text-sm font-medium text-black">Keine Angabe</label>
            </div>
         </div>

         <!-- lastname / firstname -->
         <div class="form-line">
            <div>Vorname <br/><input  type="text" name="firstName" id="firstName" required/></div>
            <div>Nachname <br/><input type="text" name="surname" id="surname" required/></div>
         </div>

         <div class="form-line">
            <div>PLZ<br/><input type="text" name="zip" id="zip" value="{{$_POST['zip']}}" readonly ></div>
            <div>Ort<br/><x-web.dropdown name="city" :mydata="$cities['data']"  class="dropdown"/></div>
         </div>

         <div class="form-line">
            <div>Straße<br/><x-web.dropdown :mydata="$streets" name="street" id="street" class="dropdown"/></div>
            <div>Hausnummer<br/><input type="text" name="houseNumber"></div>
         </div>
         <!-- Rechnungsadresse -->
         <div class="form-line">
            <div class="flex items-center mr-4">
                <input id="billingAlternativeAddress" name="billingAlternativeAddress" value="0" type="checkbox">
                <label for="billingAlternativeAddress" class="checkbox-label">Rechnungsadresse weicht von Lieferanschrift ab</label>
            </div>
         </div>


         <h2>Rechnungsadresse</h2>

         <div >
            <div class="flex mb-5">
                <div class="flex items-center mr-4">
                    <input id="billingSalutation1" type="radio" value="2" name="billingSalutation" >
                    <label for="billingSalutation1" class="ml-2 text-sm font-medium text-black">Frau</label>
                </div>
                <div class="flex items-center mr-4">
                    <input id="billingSalutation2" type="radio" value="1" name="billingSalutation" >
                    <label for="billingSalutation2" class="ml-2 text-sm font-medium text-black">Herr</label>
                </div>
                <div class="flex items-center mr-4">
                    <input id="billingSalutation3" type="radio" value="3" name="billingSalutation" >
                    <label for="billingSalutation3" class="ml-2 text-sm font-medium text-black">Familie</label>
                </div>
                <div class="flex items-center mr-4">
                    <input id="billingSalutation4" type="radio" value="8" name="billingSalutation" >
                    <label for="billingSalutation4" class="ml-2 text-sm font-medium text-black">Firma</label>
                </div>
                <div class="flex items-center mr-4">
                    <input id="billingSalutation5" type="radio" value="9" name="billingSalutation" >
                    <label for="billingSalutation5" class="ml-2 text-sm font-medium text-black">Keine Angabe</label>
                </div>
             </div>
         </div>

         <!-- lastname / firstname -->
         <div class="form-line">
            <div>Vorname<br/><input  type="text" name="billingFirstname" id="billingFirstname"></div>
            <div>Nachname<br/><input type="text" name="billingsurname" id="billingSurname"></div>
         </div>

         <div class="form-line">
            <div>PLZ<br/><input type="text" name="billingZip" id="billingZip"></div>
            <div>Ort<br/><x-web.dropdown :mydata="$cities['data']" :emptyRow=true name="billingCity"  class="dropdown"/></div>
         </div>

         <div class="form-line">
            <div>Straße<br/><x-web.dropdown :mydata="$streets" :emptyRow=true name="billingStreet" class="dropdown"/></div>
            <div>Hausnummer<br/><input type="text" name="billingHousenumber"></div>
         </div>

         <h2>Kontaktdaten</h2>

         <div class="form-line">
            <div>Geburtsdatum<br/><input type="date" name="birthday" placehoder="TT.MM.JJJJ"></div>
            <div></div>
         </div>

         <div class="form-line">
            <div>Vorwahl<br/><input type="text" name="phoneHomeAreaCode"></div>
            <div>Telefonnummer<br/><input type="text" name="phoneHome"></div>
         </div>

         <div class="form-line">
            <div>Email<br/><input type="text" name="emailPrivate"></div>
            <div>E-Mail wiederholen<br/><input type="text" name="emailPrivateRepeat"></div>
         </div>

         <div class="form-line">
            <div>Passwort<br/><input type="text" name="customerAuthPassword"></div>
            <div>Passwort Wiederholung<br/><input type="text" name="customerAuthPasswordRepeat"></div>
         </div>


         <h2>Stromversorgung</h2>
         <!-- Customer Moved -->
         <div class="form-line">
            <div class="flex items-center mr-4">
                <input id="customerMoved" name="customerMoved" value="" type="checkbox">
                <label for="customerMoved" class="checkbox-label">Ich bin in den letzten sechs Wochen umgezogen oder ziehe demnächst um.</label>
            </div>
         </div>

         <div class="form-line">
            <div>Derzeitiger Versorger<br/><input type="text" name="previousProviderCodeNumber" placeholder="optional"></div>
            <div></div>
         </div>
         <div class="form-line">
            <div>Zählernummer<br/><input type="text" name="counterNumber"></div>
            <div>Marktlokationsnummer<br/><input type="text" name="marketLocationIdentifier"></div>
         </div>

         <div class="form-line">
            <div class="flex items-center mr-4">
                <input id="customerHasTerminated" name="customerHasTerminated" value="" type="checkbox">
                <label for="customerHasTerminated" class="checkbox-label">Ich habe meinen jetzigen Vertrag selbst gekündigt.</label>
            </div>
         </div>

         <div class="form-line">
            <div>Gewünschtes Lieferdatum<br/><input type="text" name="desiredDate"></div>
            <div class="flex items-center mr-4 mt-4">
                <input id="desiredDateAsSoonAsPossible" name="desiredDateAsSoonAsPossible" value="" type="checkbox">
                <label for="desiredDateAsSoonAsPossible" class="checkbox-label">Sobald wie möglich</label>
            </div>
         </div>

         <h2>Zahlung</h2>
         <div class="form-line">
            <div class="flex items-center mr-4 mt-4">
                <input id="noSEPA" name="noSEPA" value="" type="checkbox">
                <label for="noSEPA" class="checkbox-label">Ich überweise die fälligen Abschläge zum ersten Werktag des Monats selbst.</label>
            </div>
         </div>


         <div class="form-line">
            <div>IBAN<br/><input type="text" name="iban"></div>
         </div>

         <div class="form-line">
            <div>Abweichender Kontoinhaber (Vor- und Nachname)<br/><input type="text" name="alternativeAccountHolder" placeholder="optional"></div>
         </div>

         <h2>Aktionscode</h2>
         <div class="form-line">
            <div><input type="text" name="campaignIdentifier" placeholder="optional"></div>
            <div> </div>
         </div>

         <h2>Kirche</h2>
         <div class="form-line">
            <div>
                Gebäudekategorie:<br/>
                <select name="buildingCategory" >
                    <option value="1">Kirche</option>
                    <option value="2">Kapelle</option>
                    <option value="3">Pfarrheim/-zentrum</option>
                    <option value="4">Schwesternhaus</option>
                    <option value="5">Wohngebäude</option>
                    <option value="6">Bürogebäude</option>
                    <option value="7">Altenheim</option>
                </select>
            </div>
            <div>
                Wohngebäude<br/>
                <select name="residentialBuilding">
                    <option value=""></option>
                    <option value="1">Einfamilienhaus</option>
                    <option value="2">Mehrfamilienhaus</option>
                    <option value="3">Pfarrhaus</option>
                </select>
            </div>
         </div>
         <input type="hidden" name="business" value="{{$_POST['business']}}">
         <input type="hidden" name="usage" value="{{$_POST['usage']}}">
         <input type="hidden" name="productCode" value="{{$_POST['tariff']}}">
         <input type="hidden" name="energy" value="electricity">
         <div class="form-line justify-end">
            <input type="submit"  class="btn-primary-odd mt-5 mr-10" value="Weiter"></input>
         </div>

        </form>
        </div>

    </div>

    <script>

$(document).ready(function(){

    $('#billingZip').change(function(){
        updateBillingCities();
    });

    $('#billingAlternativeAddress').change(function(){

        if ($(this).is(':checked')) {
            $('#billingFirstname').prop('required',true);
        }
    })

    $(document).on("keypress", function(e) {
            if (e.which == 115) { //s
                $('input:radio[name="salutation"]').filter('[value="1"]').attr('checked', true);
                $('[name="surName"]').val('API Test AN');
                $('[name="firstName"]').val('Do not confirm!!!');
                $('[name="zip"]').val('82024');
                $('[name="street"]').val('Rosenstr.');
                $('[name="houseNumber"]').val('100');
                $('[name="city"]').val('Taufkirchen');
                $('[name="birthday"]').val('1976-12-31');
                $('[name="emailPrivate"]').val('alex@noppenberger.org');
                $('[name="emailPrivateRepeat"]').val('alex@noppenberger.org');
                $('[name="customerAuthPassword"]').val('12345');
                $('[name="customerAuthPasswordRepeat"]').val('12345');
                $('[name="productCode"]').val('21_ftp_fair_ez');
                $('[name="usage"]').val('10');
                $('[name="business"]').val('0');
                $('[name="salutation"]').val('1');
                $('[name="customerSpecification"]').val('desired_date');
                $('[name="phoneMobileAreaCode"]').val('1279');
                $('[name="phoneMobile"]').val('111111');
                $('[name="phoneHomeAreaCode"]').val('000');
                $('[name="phoneHome"]').val('1111111');
                $('[name="desiredDate"]').val('2030-01-01');
            }
        });
        /*
        $("#frmChkout").submit(function (event) {
            event.preventDefault();
            var formData = $("#frmChkout").serialize();
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: formData,
                cache: false,
                encode: true,
                success: function (data) {
                    var resp = JSON.parse(data);
                    $('#response').html("<pre>"+JSON.stringify(JSON.parse(data), null, 2)+"</pre>");
                    if (resp.success=="true") {
                        $('#pic').show();
                    }
                    else{
                        $('#pic').hide();
                    }
                    console.log(resp);
                    $('#modalOverlay').show().addClass('modal-open');
                },
                error: function(request, status, error) {
                    console.log(error);
                }
            },'json');
        });
        */
    });

    function updateBillingCities() {
        var zip = $('#billingZip').val();
        var url = "{{ route('getCityDropdown', ":zip") }}";
        url = url.replace(':zip', zip);
        $.ajax({
                type: "GET",
                url: url,
                cache: false,
                success: function (data) {
                    var data = JSON.parse(data);
                    console.log(data.length);

                    $('#billingZip').empty();
                    $.each(data, function(key,value) {
                        console.log(key+" "+value);
                        $('#billingZip').append($("<option></option>")
                            .attr("value", value).text(key));
                    },'json');
                },
                error: function(request, status, error) {
                    console.log(error);
                }
            });
    }
    </script>
@endsection
