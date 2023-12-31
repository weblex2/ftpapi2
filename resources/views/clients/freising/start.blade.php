@extends('layouts.freisinglayout')
@section('title', 'Garantiert reine Energie')
@section('content')

<div class="w-full content-blue">
    <div class="lg:flex items-center">
        <div><img src="{{asset('img/kirche/Hand3.png')}}"></div>
        <div class="w-7/8 p-12 text-5xl text-left">Echter Ökostrom</div> 
        <div class="text-2xl mt-5">für die Katholische Kirche in Bayern</div>
    </div>
</div>

    <div class="content-wrapper">  
        <div class="w-full content-blue lg:flex justify-center  items-center p-10">
            <div class="mr-5">Ihre PLZ</div>
            <div class="w-20 mr-5"><input class="text-center text-bold" type="text" pattern="[0-9]{5}" name="calc_zip" id="calc_zip" value="81547" required></div>
            <div class="mr-5">Ihr Jahresverbrauch (in kWh)</div>
            <div class="w-20 mr-5"><input class="text-center text-extrabold" type="number"  min="1" max="99999" name="calc_usage" id="calc_usage" value="2500" required></div>
            <div class="w-max"><button class="btn-primary" onclick="calc()">Berechnen</button></div>
        </div>
    </div>  
    <div  class="content-wrapper flex justify-center">
        <div id="doing-stuff" class="object-center hidden"> 
            <img class="w-[50%]" src="{{asset('img/buffering-animated-text-icon-loading-u1h739who8u5mtw3.gif')}}">
        </div>
    </div>
    <div id="calculator"></div> 
    <div id="calculator_div" class="mb-20"></div>

    <div class="content-wrapper">
        <div class="content leading-7">
            <h2 class=" my-10  text-[#0ac] text-left">Nicht jeder Ökostrom ist ökologisch nachhaltig</h2>
            <div class="lg:flex w-full">
                <div class="lg:w-1/4">
                    <img src="{{asset('img/kirche/Gruener_Strom_empfohlen_RGB_web_1181-300x209.jpg')}}"></div>
                <div class="lg:w-3/4">
                    {{-- <p>
                    Viele Ökostromtarife stammen aus fossilen Quellen und werden mit Zertifikaten grün gewaschen. Nicht so bei Fair Trade Power!
                    </p> --}}
                    <p>
                    Wir freuen uns sehr, Sie im Rahmen der zwischen den bayerischen (Erz-)Diözesen und Fair Trade Power getroffenen Rahmenvereinbarung ab 2024 mit <a href="https://gruenerstromlabel.de/" target="_blank" rel="noreferrer noopener">Grüner Strom-Label </a> zertifiziertem, also mit echtem Ökostrom aus Bayern beliefern zu dürfen.
                    </p>
                    <p>
                    Für Fair Trade Power ist Ökostrom nicht nur eine ökologische, sondern auch eine soziale Frage. Es ist wichtig, dass grüne Energie für alle erschwinglich ist.
                    </p>
                    Aus diesem Grund haben wir uns dazu verpflichtet, echten Ökostrom zu transparenten und fairen Preisen anzubieten. Unser Ansatz besteht darin, den benötigten Ökostrom aus regionalen bayerischen Ökokraftwerken zu beziehen und die Gewinne in den Ausbau neuer Ökostromanlagen zu investieren.
                    <br/><br/>
                    Mehr Informationen finden Sie in unserem Anschreiben, welches Sie unter folgendem Link (<a href="{{asset('img/kirche/Anschreiben-Erz-Dioezesen-in-Bayern.pdf')}}" target="_blank">zum Download</a>) herunterladen können.
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="content-wrapper">
        <div class="content leading-7">
            <h2 class="mb-10 text-[#0ac] text-left">Ökologische Umkehr durch Wahl des richtigen Stromanbieters</h2>
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
    </div> --}}

    <div class="content-wrapper">
        <div class="content leading-7">
            <h2 class="mb-10 text-[#0ac] text-left">Lassen Sie uns gemeinsam für eine umweltfreundliche und nachhaltige Zukunft eintreten!</h2>
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
                
                <!--/form-->
            </div>
        </div>   
    </div> 
    
    
    {{-- <div class="content-wrapper" >
        <div class="content">
                <p>
                Nach Eingabe Ihrer Postleitzahl und Ihres Jahresverbrauchs werden wir Ihnen die jeweiligen Preisoptionen zur Auswahl anzeigen.
                </p>
                <p>
                Mit Ihrem Wechsel zu Fair Trade Power können Sie aktiv an der Beschleunigung der Energiewende mitwirken und gleichzeitig unsere Schöpfung bewahren.
                </p>
        </div>

    </div> --}}

    <script>

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
            console.log('try to change:'+ '#result_'+selected);
            console.log('div tariff selected :' + '#result_'+selected);
            disableScrolling();
            $('.tariff-result').addClass('tarif-hidden');
            $('#result_'+selected).removeClass('tarif-hidden');
            enableScrolling();
            $([document.documentElement, document.body]).animate({
                scrollTop: $('#result_'+selected).offset().top
            }, 0);
           
        };    

        function disableScrolling(){
            var x=window.scrollX;
            var y=window.scrollY;
            window.onscroll=function(){window.scrollTo(x, y);};
        }

        function enableScrolling(){
            window.onscroll=function(){};
        }

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
