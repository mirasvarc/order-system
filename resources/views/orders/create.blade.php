@extends('layouts.app')

@section('main')

    <div class="container">
        <div class="row client-list-row">
            <div class="col-12">
                <div class="title">
                    <h1>Vytvoření objednávky</h1>
                    <a href="/clients" class="btn btn-primary">Zpět</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form method="POST" action="/orders/add" class="form-control">
                    @csrf
                    <div class="row">
                        <div class="col-6 offset-3">

                            <div class="form-group mb-2 mt-3 ml-5 mr-5">
                                <h3>Klient</h3>
                                <select name="clients" class="form-control">
                                    @foreach ($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 offset-3">
                            <div class="product-container">
                                <div class="form-group mb-2 mt-3 ml-5 mr-5">
                                    <h3>Produkty</h3>
                                </div>
                            @foreach ($products as $product)
                                <div class="product-card">
                                    <div class="product-name">
                                        {{$product->name}}
                                    </div>
                                    <div class="product-price">
                                        {{$product->price}} Kč
                                    </div>
                                    <div class="product-count">
                                        <div class="count-minus">-</div>
                                        <input type="number" name="product-{{$product->id}}" disabled id="product-count-input" value="0" min="0">
                                        <div class="count-plus">+</div>
                                    </div>
                                </div>
                            @endforeach
                            </div>

                            <div class="form-group mb-3 w-20 ml-5 mr-5">
                                <input type="submit" class="form-control btn btn-success" value="Vytvořit">
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
