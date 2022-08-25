@extends('layouts.app')

@section('main')


        <div class="title mb-3">
            <h1 class="title-h1"><a href="/orders"><i class="fa fa-arrow-left"></a></i>&nbsp;&nbsp;Rozdělení do aut</h1>
        </div>



        <div class="orders-container" style="padding: 0 50px;">
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
                            <option value="3">3</option>
                            <option value="4">4</option>
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
    


@endsection