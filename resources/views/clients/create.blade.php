@extends('layouts.app')

@section('main')

    <div class="container">
        <div class="row client-list-row">
            <div class="col-12">
                <div class="title">
                    <h1><a href="/clients"><i class="fa fa-arrow-left"></a></i>&nbsp;&nbsp;Přidání nového klienta</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-xs-12 offset-md-3">
                <form method="POST" action="/clients/add" class="form-control">
                    @csrf
                    <div class="form-group mb-2 mt-3 ml-5 mr-5">
                        <label for="name">Jméno a příjmení / Jméno společnosti</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="form-group mb-2 ml-5 mr-5">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="phone">Telefon</label>
                        <input type="text" name="phone" class="form-control">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="street">Ulice</label>
                        <input type="text" name="street" class="form-control">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="street_number">Číslo popisné</label>
                        <input type="text" name="street_number" class="form-control">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="zip">PSČ</label>
                        <input type="text" name="zip" class="form-control">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="city">Město</label>
                        <input type="text" name="city" class="form-control">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="country">Stát</label>
                        <select type="text" name="country" class="form-control">
                            <option value="cz">Česká republika</option>
                        </select>
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="ic">IČ</label>
                        <input type="text" name="ic" class="form-control">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="dic">DIČ</label>
                        <input type="text" name="dic" class="form-control">
                    </div>

                    <div class="form-group mb-3 ml-5 mr-5">
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

                    <div class="form-group mb-3 ml-5 mr-5">
                        <label for="note">Poznámka</label>
                        <textarea name="note" class="form-control" rows="10"></textarea>
                    </div>

                    <div class="form-group mb-3 w-20 ml-5 mr-5">
                        <input type="submit" class="form-control btn btn-success" value="Vytvořit">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
