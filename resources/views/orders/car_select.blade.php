@extends('layouts.app')

@section('main')

    <div class="container">
        <div class="row client-list-row">
            <div class="col-12">
                <div class="title">
                    <h1><a href="/orders"><i class="fa fa-arrow-left"></a></i>&nbsp;Rozdělení do aut</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="orders-container">
                    <form action="{{route('createBillWithSelection')}}" method="POST">
                    @csrf
                    <div class="order-row">
                        <div>Klient</div>
                        <div>Adresa</div>
                        <div>Auto</div>
                    </div>
                    @foreach($orders as $key => $order)
                    
                        <div class="order-row">
                            <div class="client">{{$order->name}}</div>
                            <div class="address">{{$order->street}} {{$order->street_number}}, {{$order->city}} {{$order->zip}}</div>
                            <div>
                                <select name="order[{{$order->id}}]" class="car-select form-control select">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>

                    @endforeach
                    <br>
                    <div class="w-100 text-center">
                        <input type="submit" class="btn btn-success" value="Exportovat">
                    </div>
                    
                    </form>
                </div>
            </div>
        </div>



    </div>
    


@endsection