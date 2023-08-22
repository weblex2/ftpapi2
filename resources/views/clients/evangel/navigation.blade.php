<div class="bg-white w-full lg:flex justify-center">
    <div class="block lg:hidden mobile-nav w-full h-10 bg-[#0ac]">
        <div id="burger" class="absolute burger text-black right-3 top-3">X</div>
    </div>
    <div class="nav-container hidden md:flex absolute lg:relative w-full bg-white xl:w-[70%] lg:px-20 py-4 flex">
        <div class="hidden lg:block"><a href="/client/freising/"><img class="h-14 w-auto" src="{{ asset('img/logo.svg') }}" alt="logo" /></a></div>
        <div class="w-auto lg:flex w-full text-black justify-end items-center">
            <img class="w-4 h-auto -mr-4" src="{{ asset('img/pdf_icon_2blau_weiss.png') }}" alt="pdf" />
            <div class="nav-item"><a target="_blank" href="{{asset('img/kirche/Anschreiben-Erz-Dioezesen-in-Bayern.pdf')}}">Wichtige Information</a></div>
            <div class="nav-item"><a href="/client/freising/about">Über Fair Trade Power</a></div>
            {{-- <div class="nav-item"><a href="javascript:void(0)" id="link_registration">Registrierung</a></div> --}}
            <div class="nav-item flex justify-center items-center">
                <div>
                <svg class="w-[80%]" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                    <g class="float-left" fill="none" fill-rule="evenodd">
                        <g fill="currentColor">
                            <path d="M24.867 23.033c-1.478-1.901-3.76-3.143-6.363-3.143-.618 0-1.574.582-3.488.582-1.907 0-2.87-.582-3.487-.582-2.598 0-4.881 1.242-6.364 3.143-1.417-1.98-2.258-4.401-2.258-7.018 0-6.677 5.43-12.108 12.109-12.108 6.678 0 12.11 5.43 12.11 12.108 0 2.617-.842 5.039-2.26 7.018m-9.85 5.092c-3.01 0-5.758-1.108-7.877-2.93.902-1.392 2.446-2.338 4.214-2.391 1.259.386 2.458.58 3.663.58 1.205 0 2.404-.187 3.663-.58 1.768.06 3.312.999 4.214 2.39-2.12 1.823-4.868 2.93-7.877 2.93m0-27.124C6.72 1 0 7.72 0 16.015 0 24.31 6.72 31.03 15.016 31.03c8.295 0 15.016-6.721 15.016-15.016C30.032 7.72 23.31 1 15.016 1" transform="translate(0 -1)"></path>
                            <path d="M15.016 15.53c-1.604 0-2.906-1.3-2.906-2.905 0-1.604 1.302-2.906 2.906-2.906s2.906 1.302 2.906 2.906c0 1.605-1.302 2.906-2.906 2.906m0-8.718c-3.21 0-5.812 2.603-5.812 5.812s2.603 5.812 5.812 5.812 5.813-2.603 5.813-5.812c0-3.21-2.604-5.812-5.813-5.812" transform="translate(0 -1)"></path>
                        </g>
                    </g>
                </svg>
                </div>
                <div><a class="float-left" target="_blank" href="https://kunden.fairtradepower.de">Login</a></div>
            </div>
            <div class="nav-item flex justify-center items-center">
                <div>
                    <svg class="w-[80%]" role="img" xmlns="http://www.w3.org/2000/svg" width="21" height="35" viewBox="0 0 21 35">
                        <g fill="none" fill-rule="evenodd">
                            <g fill="currentColor">
                                <g>
                                    <path d="M15.5 32h-10C4.121 32 3 30.88 3 29.5v-3h15v3c0 1.38-1.121 2.5-2.5 2.5zM3 23.5h15v-14H3v14zM5.5 3h10C16.879 3 18 4.123 18 5.5v1H3v-1C3 4.122 4.121 3 5.5 3zm10-3h-10C2.468 0 0 2.468 0 5.5v24C0 32.532 2.468 35 5.5 35h10c3.032 0 5.5-2.468 5.5-5.5v-24C21 2.467 18.532 0 15.5 0z" transform="translate(-1110 -55) translate(1110 55)"></path>
                                    <path d="M10.988 27.535h-1c-.828 0-1.5.672-1.5 1.5s.672 1.5 1.5 1.5h1c.828 0 1.5-.672 1.5-1.5s-.672-1.5-1.5-1.5" transform="translate(-1110 -55) translate(1110 55)"></path>
                                </g>
                            </g>
                        </g>
                    </svg>
                </div> 
                <div>   
                +49 (0)89 21 12 21 99
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#link_registration").click(function() {
    $([document.documentElement, document.body]).animate({
        scrollTop: $("#calculator_div").offset().top -200
    }, 2000);
});
</script>

