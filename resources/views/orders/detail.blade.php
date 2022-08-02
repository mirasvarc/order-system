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
                    <td>{{$order->full_price}} {{$order->currency == 'CZK' ? 'Kč' : '€'}}</td>
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
                    <th></th>
                </tr>
                @foreach ($order_items as $item)
                    @if($item->quantity > 0)
                    <tr>
                        <td>{{$item->product}}</td>
                        <td>{{$item->price}} {{$order->currency == 'CZK' ? 'Kč' : '€'}}/{{$item->unit}}</td>
                        <td>{{$item->quantity}} {{$item->unit}}</td>
                        <td>{{$item->quantity * $item->price}} {{$order->currency == 'CZK' ? 'Kč' : '€'}}</td>
                        <td><a href="item/edit/{{$item->id}}" class="text-success">Upravit</a></td>
                        <td><a href="item/delete/{{$item->id}}" class="text-danger">Odstranit</a></td>
                    </tr>
                    @endif
                @endforeach
            </table>
            <br>
            <button type="button" class="btn btn-success text-black" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="fa-solid fa-circle-plus"></i>&nbsp;Přidat produkt
            </button>

            <br>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Přidat produkt do objednávky</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addProductToOrder') }}" method="POST">
                        @csrf
                        <input type="hidden" name="client" value="{{$order->client}}">
                        <input type="hidden" name="order_id" value="{{$order->id}}">
                        <div class="form-group">
                            <select class="form-control" name="product">
                                @foreach($all_products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group add-product-input-wrapper">
                            <input class="price-input form-control" type="number" name="price" step="0.1" value="0">
                            <p>&nbsp; {{$order->currency == 'CZK' ? 'Kč' : '€'}}</p>
                        </div>
                        <br>
                        <div class="form-group add-product-input-wrapper">
                            <input class="quantity-input form-control" type="number" name="quantity" step="0.1" value="0">
                            <p>&nbsp; Kg</p>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-success" value="Přidat">
                    </form>
                </div>
                
            </div>
        </div>
    </div>

</div>






@endsection
