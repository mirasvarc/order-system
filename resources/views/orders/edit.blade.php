@extends('layouts.app')

@section('main')

    <div class="container">
        <div class="row client-list-row">
            <div class="col-12">
                <div class="title">
                    <h1><a href="/orders"><i class="fa fa-arrow-left"></a></i>&nbsp;Editace objednávky</h1>
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
                            <div class="form-group mb-2 mt-3 ml-5 mr-5">
                                <label for="note">Poznámka</label>
                                <textarea name="note" class="form-control" rows="10">{{$order->note}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-xs-12 offset-md-3">
                            <div class="product-container">
                                <div class="form-group mb-2 mt-3 ml-5 mr-5">
                                    <h3>Produkty</h3>
                                </div>
                                @foreach ($order_items as $key => $product)
                                    <div class="product-card">
                                        <div class="product-name">
                                            {{$product->product}}
                                        </div>
                                        <div class="product-price">
                                            {{$product->price}} Kč
                                        </div>
                                        <div class="product-count">
                                            <div class="count-minus">-</div>
                                            <input type="hidden" name="product_id[{{$key}}]" value="{{$product->id}}">
                                            <input type="number" name="product[{{$product->id}}]" id="product-count-input" value="{{$product->quantity}}" min="0">
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