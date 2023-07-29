<x-guest-layout>
    <div id="tariffs w-full">
        <div class="content-wrapper content-odd fair">
            <div class="content tariff">
                    <div>
                        <div class="headline mb-5">
                            <div><img class="w-12 h-auto mt-3 mr-4" src="{{asset('img/ckj13utoq0015ntxqoughe2ek-ckewz14od001kzsxq2b3nhal5-fair-ic.svg')}}"></div>
                            <div class="w-1/2">
                                <h3 class=" tariff-h1">Fair</h3>
                                <h4>Von ÖKO-TEST 04/2022 mit "sehr gut" bewertet</h4>
                            </div>
                            <div class="flex items-center justify-center text-2xl">
                                <div>Student</div>
                            </div>    
                        </div>    
                        <div class="text-black text-2xl mb-8">Einfach viele Vorteile</div>
                        <div class="tariff-details">
                            <div class="flex mb-5">
                                <div class="text-[#0ac] text-sm text-bold mr-10 w-1/4">Reduzierte Grundgebühr</div>
                                <div class="text-black text-sm"><strong>Nur 11<sup>35</sup> Euro monatlich</strong></div>
                            </div>    
                            <div class="flex mb-5">
                                <div class="text-[#0ac] text-sm text-bold mr-10 w-1/4">Förderung</div>
                                <div class="text-black text-sm">Förderung mit 050 netto / 060 brutto Cent / kWh</div>
                            </div>  
                            <div class="flex mb-5">
                                <div class="text-[#0ac] text-sm text-bold mr-10 w-1/4">Verbrauchskosten</div>
                                <div class="text-black text-sm">{{$_POST['usage']}} kWh × <span id="t1_wpb"></span> Cent / kWh = 1.265<sup>40</sup> Euro im Jahr</div>
                            </div> 
                            <div class="flex mb-5">
                                <div class="text-[#0ac] text-sm text-bold mr-10 w-1/4">Laufzeit</div>
                                <div class="text-black text-sm">Mindestlaufzeit: 1 Monat</div>
                            </div> 
                            <div class="flex mb-5">
                                <div class="text-[#0ac] text-sm text-bold mr-10 w-1/4">Abschlag & Jahresenergiekosten</div>
                                <div class="text-black text-sm">119<sup>30</sup> Euro pro Monat / 1.431<sup>60</sup> Euro im Jahr</div>
                            </div> 
                        </div>
                        
                    </div>      
            </div>     
        </div>    
        <div class="content-wrapper content-even fair-auto-student">
            <div class="content ">
                <h1 class="tariff-h1">Fair</h1>
                <div>Von ÖKO-TEST 04/2022 mit "sehr gut" bewertet</div>
                <div>Einfach viele Vorteile</div>
                <div class="tariff-details">
                    <div class="grid grid-cols-2 gap-3">
                        <div>Reduzierte Grundgebühr</div><div> Nur 11<sup>35</sup> Euro monatlich bei Vorlage einer gültigen Immatrikulationsbescheinigung</div>
                    </div>    
                </div>   
            </div>
        </div>    
        <div class="content-wrapper fair-wp-student">
        </div>    
    </div>
    <x-web.dropdown :mydata="$cities['data']" class="dropdown"/>
    <x-web.dropdown :mydata="$streets" class="dropdown"/>
    <x-web.dropdown :mydata="$provider" class="dropdown"/>


<script>
    var zip      = '<?php echo $_POST['zip']; ?>';
    var usage    = '<?php echo $_POST['usage']; ?>';
    var business = '<?php echo $_POST['business']; ?>';
    $(document).ready(function(){
        $.ajax({
            url: "https://ww24pjl1v6.execute-api.eu-central-1.amazonaws.com/prod/tariffs?postcode="+zip+"&usage="+usage+"&business="+business+"&energy=electricity"
        }).done(function(resp) { 
            var wpb = Math.round(resp.data['21_ftp_fair-ez']['workingPriceBrutto']).toFixed(2);
            $('#t1_wpb').html(wpb);
            console.log(resp.data['21_ftp_fair-ez']['workingPriceBrutto']);
            $('#tariffs').html(resp);
        },'json'); 
    });
</script>    

</x-guest-layout>