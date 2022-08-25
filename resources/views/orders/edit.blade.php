@extends('layouts.app')

@section('main')

    <div class="container plr-50">
        <div class="row client-list-row">
            <div class="col-12">
                <div class="page-title">
                    <h1 class="title-h1 d-flex">
                        <a href="/orders/{{$order->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        </a>
                        &nbsp;
                        Editace objednávky
                    </h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form method="POST" action="/orders/edit/{{$order->id}}" class="form-control">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-xs-12 offset-md-3">

                            <div class="form-group mt-3 ml-5 mr-5">
                                <h3>Klient</h3>
                                <p>{{$order->client}}</p>
                            </div>
                            <div class="form-group mt-3 ml-5 mr-5">
                                <label for="day">Den závozu</label>
                                <select type="text" name="day" class="form-control">
                                    <option value=""></option>
                                    <option value="Pondělí" {{ $order->day == 'Pondělí' ? 'selected' : '' }}>Pondělí</option>
                                    <option value="Úterý" {{ $order->day == 'Úterý' ? 'selected' : '' }}>Úterý</option>
                                    <option value="Středa" {{ $order->day == 'Středa' ? 'selected' : '' }}>Středa</option>
                                    <option value="Čtvrtek" {{ $order->day == 'Čtvrtek' ? 'selected' : '' }}>Čtvrtek</option>
                                    <option value="Pátek" {{ $order->day == 'Pátek' ? 'selected' : '' }}>Pátek</option>
                                </select>
                            </div>
                        
                            <div class="form-group mt-3 ml-5 mr-5 mb-2">
                                <label for="currency">Měna</label>
                                <select type="text" name="currency" class="form-control">
                                    <option value="CZK" {{ $order->currency == 'CZK' ? 'selected' : '' }}>České koruny</option>
                                    <option value="EUR" {{ $order->currency == 'EUR' ? 'selected' : '' }}>Eura</option>
                                </select>
                            </div> 
                
                            <div class="form-group mt-3 ml-5 mr-5 mb-2">
                                <label for="date">Datum</label>
                                <input type="date" class="form-control" name="date" value="{{$order->date}}">
                            </div>
                            <div class="form-group mb-2 mt-3 ml-5 mr-5">
                                <label for="note">Poznámka</label>
                                <textarea name="note" class="form-control" rows="10">{{$order->note}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-xs-12 offset-md-3">
                               {{--<div class="product-container">
                                <div class="form-group mb-2 mt-3 ml-5 mr-5">
                                    <h3>Produkty</h3>
                                </div>
                                @foreach ($order_items as $key => $product)
                                    <div class="product-card">
                                        <div class="product-name">
                                            {{$product->product}}
                                        </div>
                                        <div class="product-price">
                                            <input class="price-input" type="number" name="price" value="{{$product->price}}">&nbsp; Kč
                                        </div>
                                        <div class="product-count">
                                            <input type="hidden" name="product_id[{{$key}}]" value="{{$product->id}}">
                                            <input type="number" name="product[{{$product->id}}]" id="product-count-input" value="{{$product->quantity}}" min="0">
                                        </div>
                                    </div>
                                @endforeach
                            </div>--}}

                            <div class="form-group mb-3 w-20 ml-5 mr-5">
                                <input type="submit" class="form-control btn btn-success" value="Uložit">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        $(window).on('load', function() {
            $('.count-minus').on('click', function() {
                var curr_val = parseInt($(this).next('#product-count-input').val());
                if(curr_val > 0) {
                    $(this).next('#product-count-input').attr('value', curr_val - 1);
                }
            });
            $('.count-plus').on('click', function() {
                var curr_val = parseInt($(this).prev('#product-count-input').val());
                $(this).prev('#product-count-input').attr('value', curr_val + 1);
            });
        });

    </script>

@endsection
