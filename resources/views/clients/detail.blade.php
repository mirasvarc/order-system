@extends('layouts.app')

@section('main')


<div class="container client-detail-container">
    <br>
    <a href="/clients" class="client-detail-back">Zpět</a>
    <br>
    <div class="row client-detail-row">
        <div class="col-12 client-detail-col">
            <h2>Osobní údaje</h2>
            <table>
                <tr>
                    <td>Jméno a příjmení:</td>
                    <td>{{$client->name}}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{$client->email}}</td>
                </tr>
                <tr>
                    <td>Telefon:</td>
                    <td>{{$client->phone}}</td>
                </tr>
            </table>
            <br>
            <h2>Adresa</h2>
            <table>
                <tr>
                    <td>Ulice:</td>
                    <td>{{$client->street}}</td>
                </tr>
                <tr>
                    <td>Číslo:</td>
                    <td>{{$client->street_number}}</td>
                </tr>
                <tr>
                    <td>Město:</td>
                    <td>{{$client->city}}</td>
                </tr>
                <tr>
                    <td>PSČ:</td>
                    <td>{{$client->zip}}</td>
                </tr>
                <tr>
                    <td>Stát:</td>
                    <td>{{$client->country}}</td>
                </tr>
            </table>

        </div>
    </div>
</div>


@endsection
