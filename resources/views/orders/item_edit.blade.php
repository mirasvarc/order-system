@extends('layouts.app')

@section('main')

    <div class="container">
        <div class="row client-list-row">
            <div class="col-12">
                <div class="title">
                    <h1><a href="javascript:history.back()"><i class="fa fa-arrow-left"></a></i>&nbsp;&nbsp;Editace produktu</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form method="POST" action="/orders/item/edit/{{$item->id}}" class="form-control">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-xs-12 offset-md-3">

                            <div class="form-group mt-3 ml-5 mr-5">
                                <h3>Objednávka č.{{$item->order_id}}</h3>
                                <h4>{{$product->name}}</h4>
                            </div>
                            
                           
                            <div class="product-card product-edit-card">
                                <div class="product-price">
                                    <div class="label">Cena</div>
                                    <input class="price-input" class="form-control" type="number" name="price" step="0.1" value="{{$item->price}}">&nbsp; Kč / Eur
                                </div>
                                <div class="product-count">
                                    <div class="label">Počet</div>
                                    <input type="number" class="price-input" name="quantity" step="0.1" value="{{$item->quantity}}">&nbsp; Kg
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-xs-12 offset-md-3">
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
