@extends('layouts.app')

@section('main')

    <div class="container homepage-container">
        <div class="row">
            <div class="col-xs-12 col-md-4 offset-md-2 text-center">
                <a href="/orders"><div class="main-btn">Objednávky</div></a>
            </div>
            <div class="col-xs-12 col-md-4 text-center">
                <a href="/clients"><div class="main-btn">Klienti</div></a>
            </div>
            <div class="col-xs-12 col-md-4 offset-md-2 text-center">
                <a href="/stats"><div class="main-btn">Přehledy<br><span class="text-danger h6">(TEST)</span></div></a>
            </div>
        </div>
    </div>

@endsection
