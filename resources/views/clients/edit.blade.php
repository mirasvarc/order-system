@extends('layouts.app')

@section('main')

    <div class="container">
        <div class="row client-list-row">
            <div class="col-12">
                <div class="title">
                    <h1><a href="/clients"><i class="fa fa-arrow-left"></a></i>&nbsp;&nbsp;Upravit klienta</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 offset-3">
                <form method="POST" action="/clients/edit/{{$client->id}}" class="form-control">
                    @csrf
                    <div class="form-group mb-2 mt-3 ml-5 mr-5">
                        <label for="name">Jméno a příjmení / Jméno společnosti</label>
                        <input type="text" name="name" class="form-control" value="{{$client->name}}">
                    </div>

                    <div class="form-group mb-2 ml-5 mr-5">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" value="{{$client->email}}">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="phone">Telefon</label>
                        <input type="text" name="phone" class="form-control" value="{{$client->phone}}">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="street">Ulice</label>
                        <input type="text" name="street" class="form-control" value="{{$client->street}}">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="street_number">Číslo popisné</label>
                        <input type="text" name="street_number" class="form-control" value="{{$client->street_number}}">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="zip">PSČ</label>
                        <input type="text" name="zip" class="form-control" value="{{$client->zip}}">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="city">Město</label>
                        <input type="text" name="city" class="form-control" value="{{$client->city}}">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="country">Stát</label>
                        <select type="text" name="country" class="form-control">
                            <option value="cz">Česká republika</option>
                        </select>
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="ic">IČ</label>
                        <input type="text" name="ic" class="form-control" value="{{$client->ic}}">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="dic">DIČ</label>
                        <input type="text" name="dic" class="form-control" value="{{$client->dic}}">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="day">Den závozu</label>
                        <select type="text" name="day" class="form-control">
                            <option value=""></option>
                            <option value="Pondělí" {{ $client->day == 'Pondělí' ? 'selected' : '' }}>Pondělí</option>
                            <option value="Úterý" {{ $client->day == 'Úterý' ? 'selected' : '' }}>Úterý</option>
                            <option value="Středa" {{ $client->day == 'Středa' ? 'selected' : '' }}>Středa</option>
                            <option value="Čtvrtek" {{ $client->day == 'Čtvrtek' ? 'selected' : '' }}>Čtvrtek</option>
                            <option value="Pátek" {{ $client->day == 'Pátek' ? 'selected' : '' }}>Pátek</option>


                        </select>
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="note">Poznámka</label>
                        <textarea name="note" class="form-control" rows="10">{{$client->note}}</textarea>
                    </div>

                    <div class="form-group mb-3 w-20 ml-5 mr-5">
                        <input type="submit" class="form-control btn btn-success" value="Uložit">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
