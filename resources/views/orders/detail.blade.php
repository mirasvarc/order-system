@extends('layouts.app')

@section('main')


<div class="container client-detail-container">
    <br>
    <a href="javascript:history.back()" class="client-detail-back">Zpět</a>
    <br>
    <div class="row client-detail-row">
        <div class="col-12 client-detail-col">
            <h2>Detail objednávky č.{{$order->id}}</h2>
            <br>
            <table>
                <tr>
                    <td>Číslo objednávky:</td>
                    <td>{{$order->id}}</td>
                </tr>
                <tr>
                    <td>Klient:</td>
                    <td>{{$order->client}}</td>
                </tr>
                <tr>
                    <td>Cena:</td>
                    <td>{{$order->full_price}} Kč</td>
                </tr>
            </table>
            <br>
            <br>
            <h3>Produkty:</h3>
            <br>
            <table>
                <tr>
                    <th>Číslo produktu:</th>
                    <th>Produkt</th>
                    <th>Cena</th>
                    <th>Množství</th>
                </tr>
                @foreach ($order_items as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->product}}</td>
                        <td>{{$item->price}} Kč/{{$item->unit}}</td>
                        <td>{{$item->quantity}} {{$item->unit}}</td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>

</div>




@endsection
