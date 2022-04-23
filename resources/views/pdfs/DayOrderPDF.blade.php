<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>

    <title>Objednávky - {{$day}}</title>
</head>
<body>
    <style>
        *{ font-family: DejaVu Sans !important;}
    </style>

    <h1>Objednávky - {{$day}}</h1>
    <table>
        <tr>
            <td>Klient:</td>
            <td>{{$client->name}}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>{{$client->email}}</td>
        </tr>
        <tr>
            <td>Telefon:</td>
            <td>{{$client->phone}}</td>
        </tr>
        <tr>
            <td>Ulice:</td>
            <td>{{$client->street}}</td>
        </tr>
        <tr>
            <td>Číslo:</td>
            <td>{{$client->street_number}}</td>
        </tr>
        <tr>
            <td>Město:</td>
            <td>{{$client->city}}</td>
        </tr>
        <tr>
            <td>PSČ:</td>
            <td>{{$client->zip}}</td>
        </tr>
    </table>


    <h2>Zboží</h2>
    @foreach ($orders as $order)
        <h3>Objendávka č. {{$order['order']->id}}</h3>

        <p>{{$order['items']->product}}</p>

    @endforeach
</body>
</html>
