@extends('layouts.app')

@section('main')

    <div class="container">
        <div class="row pt-3 pb-3 pl-3 pr-3">
            <div class="col-md-12">
                <h1>Changelog:</h1>
                <div class="changelog-block">
                    <p class="title">V 2.2.0 (30.9.2022)</p>
                    <p class="text">
                        - Zpřehlednění PDF Přehledu pro řidiče (s rozdělením i bez)<br>
                        - Řazení objednávek od nejnovější<br>
                        - Přidání poznámky u objednávky do dodacího listu
                    </p>
                    <br>
                    <p class="title">V 2.1.1 (25.9.2022)</p>
                    <p class="text">
                        - Přidání zobrazení tržeb pro vybrané období<br>
                    </p>
                    <br>
                    <p class="title">V 2.1.0 (30.8.2022)</p>
                    <p class="text">
                        - Přidání statistik prodaných produktů<br>
                        - možnost zobrazit prodané produkty pro vybrané období<br>
                    </p>
                    <br>
                    <p class="title">V 2.0.1 (30.8.2022)</p>
                    <p class="text">
                        - Přesměrování na seznam objednávek po přihlášení<br>
                        - rozdělení grafů pro CZK a EUR<br>
                        - zvětšení polí ve  vytváření objednávky<br>
                        - přidání patičky <br>
                    </p>
                    <br>
                    <p class="title">V 2.0.0 (25.8.2022)</p>
                    <p class="text">
                        - Kompletní redesign, změna rozložení<br>
                        - responsivní menu<br>
                    </p>
                    <br>
                    <p class="title">V 1.3.1 (11.8.2022)</p>
                    <p class="text">
                        - Přidání 4 aut do výběru pro řidiče<br>
                        - odstranění DPH z dodacích listů pro platby v EUR<br>
                    </p>
                    <br>
                    <p class="title">V 1.3.0 (10.8.2022)</p>
                    <p class="text">
                        - Přidání možnosti výběru aut pro tisk adres<br>
                        - Přidání podsekce Přehledy<br>
                        - Přidání grafu s denními tržbami<br>
                    </p>

                </div>
            </div>
        </div>
    </div>

@endsection
