@extends('layouts.app')

@section('main')

    <div class="container plr-50">
        <div class="row client-list-row">
            <div class="col-12">
                <div class="page-title">
                    <h1 class="title-h1 d-flex">
                        <a href="/orders">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                        </a>
                        &nbsp;
                        Vytvoření objednávky
                    
                    </h1>
                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form method="POST" action="/orders/add" class="form-control">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-xs-12 offset-md-3">

                            <div class="form-group mt-3 ml-5 mr-5">
                                <h3>Klient</h3>
                                <select name="clients" class="form-control js-example-basic-single">
                                    @foreach ($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-3 ml-5 mr-5">
                                <label for="day">Den závozu</label>
                                <select type="text" name="day" class="form-control">
                                    <option value=""></option>
                                    <option value="Pondělí">Pondělí</option>
                                    <option value="Úterý">Úterý</option>
                                    <option value="Středa">Středa</option>
                                    <option value="Čtvrtek">Čtvrtek</option>
                                    <option value="Pátek">Pátek</option>
                                </select>
                            </div>
                            <div class="form-group mt-3 ml-5 mr-5">
                                <label for="note">Poznámka</label>
                                <textarea name="note" class="form-control" rows="10"></textarea>
                            </div>
                            <div class="form-group mt-3 ml-5 mr-5 mb-2">
                                <label for="date">Datum</label>
                                <input type="date" class="form-control" name="date">
                            </div>

                            <div class="form-group mt-3 ml-5 mr-5 mb-2">
                                <label for="currency">Měna</label>
                                <select type="text" name="currency" class="form-control">
                                    <option value="CZK">České koruny</option>
                                    <option value="EUR">Eura</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 col-xs-12 offset-md-2 col-lg-6 offset-lg-3">
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
                                        <input class="price-input" type="number" name="product_price[{{$product->id}}]" step="0.1" >&nbsp; Kč (Eur) / Kg
                                    </div>
                                    <div class="product-count">
                                        @if($product->name == "Borůvky")
                                            <input type="number" name="product[{{$product->id}}]" id="product-count-input" step="0.1" min="0">&nbsp; Kg
                                        @else
                                            <input type="number" name="product[{{$product->id}}]" id="product-count-input" min="0">&nbsp; Kg
                                        @endif
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


            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        });

    </script>

@endsection
