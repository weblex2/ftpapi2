@extends('layouts.freisinglayout')
@section('title', 'Garantiert reine Energie')
@section('content')
    <div class="content-wrapper content-blue bg-no-repeat bg-right-top bg-contain bg-auto bg-[url('../../public/img/cke8uyxoe00d67txqmbi3vuo9-headerbild-unsplash.full.png')]">
        <div class="content">
            <div class="w-[80%]">
            <h1>Echter Ökostrom.</h1>
            <h2>& neue Erzeugungsanlagen in Verantwortungseigentum!</h2>
            <p>
                Jeder unserer Tarife liefert 100% Ökostrom aus erneuerbarer Wind-, Wasser- und Sonnenenergie, wobei wir aktuell erheblich mehr in den Ausbau erneuerbarer Anlagen investieren, um zukünftig allen Fair Trade Power Kunden einen langfristigen günstigen Strompreis anbieten zu können.

                Deshalb wurden wir u.a. von Grüner-Strom-Label, Utopia und Robin Wood ausgezeichnet. Diese erhalten nur Unternehmen, die wirklich Ökostrom vertreiben und den Ausbau erneuerbarer Energien fördern.
            </p>
            <form method="POST" action="{{route("getInfo")}}">
                @csrf
                <div class="plz-content">
                    <div class="flex justify-items items-center justify-between w-[70%] my-10">
                        <span>Ihre PLZ</span>
                        <span class="w-20"> <input class="text-center" pattern="[0-9]{5}" type="text"  name="zip" value="82024"></span>
                        <div>Ihr Jahresverbrauch (in kWh)</div><div><input class="text-center" min="0" max="9999999" type="number" name="usage" value="2000"></div>
                    </div>
                    <div class="flex items-center">
                        <div class="float-left pl-10 mr-2"><strong>oder</strong> Personen im Haushalt</div>
                        <div class="w-10"><input class="text-center" type="text" name="persons" class="-mt-2 ml-5"></div>
                        <div><svg class="ml-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="45" height="49" viewBox="0 0 45 49">
                                <defs>
                                    <path id="7eg222fota" d="M0.184 0.083L9.835 0.083 9.835 9.948 0.184 9.948z"></path>
                                    <path id="92yj0w94lc" d="M0 0.036L26.803 0.036 26.803 41 0 41z"></path>
                                    <path id="s3o3jr9chf" d="M0.184 0.083L9.835 0.083 9.835 9.948 0.184 9.948z"></path>
                                    <path id="ljeqvoc5xh" d="M0 0.036L26.803 0.036 26.803 41 0 41z"></path>
                                    <filter id="ui7bxzhsle">
                                        <feColorMatrix in="SourceGraphic" values="0 0 0 0 1.000000 0 0 0 0 1.000000 0 0 0 0 1.000000 0 0 0 0.500000 0"></feColorMatrix>
                                    </filter>
                                </defs>
                                <g fill="none" fill-rule="evenodd">
                                    <g>
                                        <g>
                                            <g transform="translate(9)">
                                                <mask id="1m27unz8mb" fill="#fff">
                                                    <use xlink:href="#7eg222fota"></use>
                                                </mask>
                                                <path fill="#FFF" d="M5.01.082c2.665 0 4.825 2.209 4.825 4.933 0 2.724-2.16 4.933-4.825 4.933S.184 7.739.184 5.015C.184 2.291 2.344.082 5.01.082" mask="url(#1m27unz8mb)"></path>
                                            </g>
                                            <g transform="translate(0 8)">
                                                <mask id="t7fcsx9prd" fill="#fff">
                                                    <use xlink:href="#92yj0w94lc"></use>
                                                </mask>
                                                <path fill="#FFF" d="M15.643.036c-.04.432.165 1.681.165 1.681s4.507 1.423 6.21 6.001l4.669 10.256c.126.342.16.727.049 1.133-.203.738-.86 1.3-1.64 1.39-1.071.125-1.994-.598-2.16-1.57l-.026.006-3.568-6.899.65 27.07c0 1.047-.872 1.896-1.948 1.896-1.034 0-1.878-.786-1.941-1.778l-1.951-17.121h-1.5L10.7 39.222C10.638 40.214 9.794 41 8.759 41c-1.075 0-1.947-.849-1.947-1.896l.65-27.07-3.568 6.899-.027-.005c-.166.971-1.088 1.694-2.16 1.57-.779-.091-1.436-.653-1.64-1.391-.111-.406-.077-.79.05-1.133L4.785 7.718c1.703-4.578 6.21-6.001 6.21-6.001S11.2.468 11.16.037" mask="url(#t7fcsx9prd)"></path>
                                            </g>
                                        </g>
                                        <g filter="url(#ui7bxzhsle)">
                                            <g>
                                                <g transform="translate(18) translate(9)">
                                                    <mask id="f5dgvobt0g" fill="#fff">
                                                        <use xlink:href="#s3o3jr9chf"></use>
                                                    </mask>
                                                    <path fill="#FFF" d="M5.01.082c2.665 0 4.825 2.209 4.825 4.933 0 2.724-2.16 4.933-4.825 4.933S.184 7.739.184 5.015C.184 2.291 2.344.082 5.01.082" mask="url(#f5dgvobt0g)"></path>
                                                </g>
                                                <g transform="translate(18) translate(0 8)">
                                                    <mask id="geo4wkeyri" fill="#fff">
                                                        <use xlink:href="#ljeqvoc5xh"></use>
                                                    </mask>
                                                    <path fill="#FFF" d="M15.643.036c-.04.432.165 1.681.165 1.681s4.507 1.423 6.21 6.001l4.669 10.256c.126.342.16.727.049 1.133-.203.738-.86 1.3-1.64 1.39-1.071.125-1.994-.598-2.16-1.57l-.026.006-3.568-6.899.65 27.07c0 1.047-.872 1.896-1.948 1.896-1.034 0-1.878-.786-1.941-1.778l-1.951-17.121h-1.5L10.7 39.222C10.638 40.214 9.794 41 8.759 41c-1.075 0-1.947-.849-1.947-1.896l.65-27.07-3.568 6.899-.027-.005c-.166.971-1.088 1.694-2.16 1.57-.779-.091-1.436-.653-1.64-1.391-.111-.406-.077-.79.05-1.133L4.785 7.718c1.703-4.578 6.21-6.001 6.21-6.001S11.2.468 11.16.037" mask="url(#geo4wkeyri)"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg></div>
                        <div>
                            <div class="flex items-center ml-6">
                                <input id="student" name="student" value="" type="checkbox">
                                <label for="customerHasTerminated" class="checkbox-label">Ich bin Student.</label>
                            </div>
                        </div>
                        <div class="ml-5">
                            <button class="btn-primary" type="submit">Jetzt berechnen</button>
                        </div>
                    </div>

                    <div class="flex mt-10">
                        Wir arbeiten mit Hochdruck an der Errichtung neuer Anlagen, damit wir unseren Kunden weiterhin immer den bestmöglichen Preis anbieten können und gleichzeitig die Energiewende aktiv voranbringen.
                    </div>

                    <input type="hidden" name="business" value="0">
                </div>
            </form>

            </div>
        </div>
    </div>


    </div>
@endsection
