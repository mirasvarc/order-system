<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>

    <title>Objednávky - {{$day}}</title>
</head>
<body>
    <style>
        *{ font-family: DejaVu Sans !important;}

        h1 {
            font-size: 22px;
        }

        p {
            margin: 0 !important;
            padding-left: 2px;
        }

        table {
            margin-top: 5px;
        }

        #items {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #items td, #items th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #items tr:nth-child(even){background-color: #f2f2f2;}

        #items tr:hover {background-color: #ddd;}

        #items th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #389fff;
            color: white;
        }
    </style>

    <h1>Objednávky - {{$day}}</h1>

    @if(isset($orders))
        @foreach ($orders as $client)
            @if(isset($client['orders']))
                <p style="font-size:18px;font-weight:bold;margin-bottom:0px !important;">{{$client['client']}}</p>
                <p>{{$client['address']}}, email: {{$client['email']}}, telefon: {{$client['phone']}}</p>
                <p>Poznámka: {{$client['note']}}</p>

                @foreach ($client['orders'] as $order)
                    <table>
                        <tr>
                            <td>Celková cena objednávky:</td>
                            <td>{{$order['price']}} Kč</td>
                        </tr>
                        <tr>
                            <td>Poznámka k objednávce:</td>
                            <td>{{$order['note']}}</td>
                        </tr>
                    </table>
                    <table id="items">
                        <tr>
                            <td style="font-weight:bold;">Zboží</td>
                            <td style="font-weight:bold;">Cena za kg</td>
                            <td style="font-weight:bold;">Množství</td>
                            <td style="font-weight:bold;">Celková cena</td>
                        </tr>
                        @if(isset($order['items'])) {
                            @foreach ($order['items'] as $item)
                                @if($item['quantity'] > 0)
                                <tr>
                                    <td>{{$item['product']}}</td>
                                    <td>{{$item['price_per_kg']}} Kč</td>
                                    <td>{{$item['quantity']}} Kg</td>
                                    <td>{{$item['full_price']}} Kč</td>
                                </tr>
                                @endif
                            @endforeach
                        @endif
                    </table>
                @endforeach
            @endif

        @endforeach
    @endif




</body>
</html>
