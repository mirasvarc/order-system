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
                <div class="row">
                    <div class="col-6 offset-3">
                        <form method="POST" action="/orders/add" class="form-control">
                            @csrf
                            <div class="form-group mb-2 mt-3 ml-5 mr-5">
                                <label for="clients">Klient</label>
                                <select name="clients" class="form-control">
                                    @foreach ($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group mb-3 w-20 ml-5 mr-5">
                                <input type="submit" class="form-control btn btn-success" value="Vytvořit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
