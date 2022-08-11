@extends('layouts.admin')

@section('main')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Changelog:</h1>
                <div class="changelog-block">

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
