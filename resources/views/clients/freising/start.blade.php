@extends('layouts.freisinglayout')
@section('title', 'Garantiert reine Energie')
@section('content')

    <div class="w-full content-blue">
        <div class="lg:flex items-center">
            <div><img src="{{asset('img/kirche/Hand3.png')}}"></div>
            <div class="w-7/8 p-12 text-5xl">Echter Ökostrom für die Katholische Kirche in Bayern</div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="content leading-7">
            <h2 class=" my-10  text-[#0ac]">Nicht jeder Ökostrom ist ökologisch nachhaltig</h2>
            <div class="lg:flex w-full">
                <div class="lg:w-1/4">
                    <img src="{{asset('img/kirche/Gruener_Strom_empfohlen_RGB_web_1181-300x209.jpg')}}"></div>
                <div class="lg:w-3/4">
                    <p>
                    Viele Ökostromtarife stammen aus fossilen Quellen und werden mit Zertifikaten grün gewaschen. Nicht so bei Fair Trade Power!
                    </p>
                    <p>
                    Wir freuen uns sehr, Sie im Rahmen der zwischen den bayerischen (Erz-)Diözesen und Fair Trade Power getroffenen Rahmenvereinbarung ab 2024 mit <a href="https://gruenerstromlabel.de/" target="_blank" rel="noreferrer noopener">Grüner Strom-Label </a> zertifiziertem, also mit echtem Ökostrom aus Bayern beliefern zu dürfen.
                    </p>
                    <p>
                    Für Fair Trade Power ist Ökostrom nicht nur eine ökologische, sondern auch eine soziale Frage. Es ist wichtig, dass grüne Energie für alle erschwinglich ist.
                    </p>
                    Aus diesem Grund haben wir uns dazu verpflichtet, echten Ökostrom zu transparenten und fairen Preisen anzubieten. Unser Ansatz besteht darin, den benötigten Ökostrom aus regionalen bayerischen Ökokraftwerken zu beziehen und die Gewinne in den Ausbau neuer Ökostromanlagen zu investieren.
                    <br/><br/>
                    Mehr Informationen finden Sie in unserem Anschreiben, welches Sie unter folgendem Link (zum Download) herunterladen können.
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="content leading-7">
            <h2 class="mb-10 text-[#0ac]">Ökologische Umkehr durch Wahl des richtigen Stromanbieters</h2>
            <div>
                <p>
                    Wir freuen uns, Sie im Rahmen der zwischen den bayerischen (Erz-)Diözesen und Fair Trade Power getroffenen Rahmenvereinbarung ab 2024 mit Grüner Strom-Label zertifiziertem Ökostrom aus Bayern beliefern zu dürfen.
                </p>
                <p>
                    Für Fair Trade Power ist Ökostrom nicht nur eine ökologische, sondern auch eine soziale Frage. Es ist wichtig, dass grüne Energie für alle erschwinglich ist.
                </p>
                <p>
                    Aus diesem Grund haben wir uns dazu verpflichtet, echten Ökostrom zu transparenten und fairen Preisen anzubieten. Unser Ansatz besteht darin, den benötigten Ökostrom aus regionalen bayerischen Ökokraftwerken zu beziehen und die Gewinne in den Ausbau neuer Ökostromanlagen zu investieren.
                </p>
            </div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="content leading-7">
            <h2 class="mb-10 text-[#0ac]">Lassen Sie uns gemeinsam für eine umweltfreundliche und nachhaltige Zukunft eintreten!</h2>
            <div>
                <p>
                Hier werden wir Ihnen spätestens im 4. Quartal 2023 die Strompreise gemäß Rahmenvereinbarung Strom – Anlage A „Preisblatt und Angebotsprozess“ anzeigen.
                </p>
                <p>
                Wie vereinbart, werden wir Ihnen zwei Optionen anbieten können:
                </p>
                <p>
                Option 1: Floating-Preismodell: Der Strompreis wird jedes Quartal anhand der durchschnittlichen Strompreise an der Börse gemäß der vorangegangenen ersten 20 Werktage des Vormonats berechnet.
                </p>
                <p>
                Option 2: Fixpreis: Dieser beruht auf direkten Stromabnahmeverträgen mit bayerischen Ökokraftwerken.
                </p>

                {{--
                <x-web.tariffCalculator/>
                --}}
                <!--form id="frmCalc"-->
                <div class="content-blue lg:flex justify-start  items-center p-10">
                    <div class="mr-5">Ihre PLZ</div>
                    <div class="w-20 mr-5"><input class="text-center text-bold" type="text" pattern="[0-9]{5}" name="calc_zip" id="calc_zip" value="" required></div>
                    <div class="mr-5">Ihr Jahresverbrauch (in kWh)</div>
                    <div class="w-20 mr-5"><input class="text-center text-extrabold" type="number"  min="1" max="99999" name="calc_usage" id="calc_usage" value="" required></div>
                    <div class="w-max"><button class="btn-primary" onclick="calc()">Berechnen</button></div>
                </div>
                <!--/form-->
            </div>
        </div>   
    </div> 
    <div class="content-wrapper ">
        <div id="doing-stuff" class="hidden">  
            <div class="content flex justify-center">
                <div> 
                    <img class="w-[50%]" src="{{asset('img/buffering-animated-text-icon-loading-u1h739who8u5mtw3.gif')}}">
                </div>
            </div>   
        </div> 
    </div>
    <div class="content-wrapper">  
        <div id="calculator"></div>
    </div>   
    <div class="content-wrapper">
        <div class="content">
                <p>
                Nach Eingabe Ihrer Postleitzahl und Ihres Jahresverbrauchs werden wir Ihnen die jeweiligen Preisoptionen zur Auswahl anzeigen.
                </p>
                <p>
                Mit Ihrem Wechsel zu Fair Trade Power können Sie aktiv an der Beschleunigung der Energiewende mitwirken und gleichzeitig unsere Schöpfung bewahren.
                </p>
        </div>

    </div>

    <script>
        function calc() {
            //e.preventDefault();
            var zip = $('#calc_zip').val();
            var usage= $('#calc_usage').val();
            if (zip=="" || usage=="" || usage==0) {
                return false;
            }     
            $('#doing-stuff').show();
            $('#calculator').hide();   
            axios.get('/client/freising/getTarifHtml/'+zip+"/"+usage)
                .then(response => {
                    console.log(response);
                    $('#calculator').html(response.data);
                    $('#calculator').show();
                    $('#doing-stuff').hide();
                })
                .catch(error => {
                    console.log(error);
                });
        }

        $(function (){
            $('body').on('click', '#show_normal1', function(){
                var prices = $('#normal').val().split("|");
                $('#basePrice1').html(formatPrice(prices[0]));
                $('#workingPrice1').html(formatPrice(prices[1]));
                $('#workingTotal1').html(formatPrice(prices[2]));
                $('#total1').html(formatPrice(prices[3]));
                $('#abschlag1').html(formatPrice(prices[4]));
            });

            $('body').on('click' , '#show_plus1' , function(){
                var prices = $('#plus').val().split("|");
                $('#basePrice1').html(formatPrice(prices[0]));
                $('#workingPrice1').html(formatPrice(prices[1]));
                $('#workingTotal1').html(formatPrice(prices[2]));
                $('#total1').html(formatPrice(prices[3]));
                $('#abschlag1').html(formatPrice(prices[4]));
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
        });
    </script>

@endsection
