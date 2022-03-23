@extends('layouts.app')

@section('main')

    <div class="container">
        <div class="row">
            <div class="col-4 offset-2 text-center">
                <a href="/orders"><div class="main-btn">Objednávky</div></a>
            </div>
            <div class="col-4 text-center">
                <a href="/clients"><div class="main-btn">Klienti</div></a>
            </div>
        </div>
    </div>

@endsection
