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

                <x-web.tariffCalculator />
                
                <p>
                Nach Eingabe Ihrer Postleitzahl und Ihres Jahresverbrauchs werden wir Ihnen die jeweiligen Preisoptionen zur Auswahl anzeigen.
                </p>
                <p>
                Mit Ihrem Wechsel zu Fair Trade Power können Sie aktiv an der Beschleunigung der Energiewende mitwirken und gleichzeitig unsere Schöpfung bewahren.
                </p>
            </div>
        </div>
    </div>
@endsection
