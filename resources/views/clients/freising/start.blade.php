@extends('layouts.freisinglayout')
@section('content')
    <div class="content">
    <h1>Echter Ökostrom.</h1>
    <h2>& neue Erzeugungsanlagen in Verantwortungseigentum!</h2>

    <form method="POST" action="{{route("getInfo")}}">
        @csrf
        <div class="plz-content">
            <div class="grid col-span-2">
                <div>Ihre PLZ </div><div><input pattern="[0-9]{5}" type="text"  name="zip" value="82024"></div>
                <div>Ihr Jahresverbrauch (in kWh)</div><div><input  min="0" max="9999999" type="number" name="usage" value="2000"></div>


                <div class="col-span-2">
                    <br>
                    <span class="float-left mr-10"><strong>oder</strong> Personen im Haushalt</span>
                    <svg class="float-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="45" height="49" viewBox="0 0 45 49">
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
                    </svg>
                    <input type="text" name="persons" class=" -mt-2 ml-5">
                </div>
                <div class="col-span-2">
                <button class="btn-primary" type="submit">Abschicken</button>
                </div>
            </div>
            <input type="hidden" name="business" value="0">
        </form>

    </div>

    </div>
@endsection
