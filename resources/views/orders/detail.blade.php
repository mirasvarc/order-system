@extends('layouts.app')

@section('main')


<div class="container client-detail-container">
    <br>
    <a href="/orders" class="client-detail-back">Zpět</a>
    <br>
    <div class="row client-detail-row">
        <div class="col-12 client-detail-col">
            <h2>Detail objednávky č.{{$order->id}} &nbsp; <a href="edit/{{$order->id}}" class="btn btn-success">Upravit</a></h2>
            <br>
            <table>
                <tr>
                    <td>Číslo objednávky:</td>
                    <td>{{$order->id}}</td>
                </tr>
                <tr>
                    <td>Datum objednávky:</td>
                    <td>{{$order->date}}</td>
                </tr>
                <tr>
                    <td>Klient:</td>
                    <td>{{$order->client}}</td>
                </tr>
                <tr>
                    <td>Cena objednávky:</td>
                    <td>{{$order->full_price}} Kč</td>
                </tr>
                <tr>
                    <td>Den závozu:</td>
                    <td>{{$order->day}}</td>
                </tr>
                <tr>
                    <td>Poznámka:</td>
                    <td>{{$order->note}}</td>
                </tr>
            </table>
            <br>
            <br>
            <h3>Produkty:</h3>
            <br>
            <table>
                <tr>
                    <th>Produkt</th>
                    <th>Cena</th>
                    <th>Množství</th>
                    <th>Cena celkem</th>
                    <th></th>
                </tr>
                @foreach ($order_items as $item)
                    @if($item->quantity > 0)
                    <tr>
                        <td>{{$item->product}}</td>
                        <td>{{$item->price}} Kč/{{$item->unit}}</td>
                        <td>{{$item->quantity}} {{$item->unit}}</td>
                        <td>{{$item->quantity * $item->price}} Kč</td>
                        <td><a href="item/edit/{{$item->id}}">Upravit</a></td>
                    </tr>
                    @endif
                @endforeach
            </table>

        </div>
    </div>

</div>




@endsection
