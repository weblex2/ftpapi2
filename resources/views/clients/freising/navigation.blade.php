<div class="bg-white w-full lg:flex justify-center">
    <div class="block lg:hidden mobile-nav w-full h-10 bg-[#0ac]">
        <div id="burger" class="absolute burger text-black right-3 top-3">X</div>
    </div>
    <div class="nav-container hidden md:flex absolute lg:relative w-full bg-white xl:w-[70%] lg:px-20 py-4 flex">
        <div class="hidden lg:block"><a href="/client/freising/"><img class="h-14 w-auto" src="{{ asset('img/logo.svg') }}" alt="logo" /></a></div>
        <div class="w-auto lg:flex w-full text-black justify-end items-center">
            <div class="nav-item"><a target="_blank" href="{{asset('img/kirche/Anschreiben-Erz-Dioezesen-in-Bayern.pdf')}}">Wichtige Information</a></div>
            <div class="nav-item"><a href="/client/freising/about">Über Fair Trade Power</a></div>
            <div class="nav-item"><a href="javascript:void(0)" id="link_registration">Registrierung</a></div>
        </div>
    </div>
</div>

<script>
    $("#link_registration").click(function() {
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#calculator_div").offset().top
    }, 2000);
});
</script>

