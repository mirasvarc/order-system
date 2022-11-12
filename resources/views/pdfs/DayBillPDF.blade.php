<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>

    <title>Dodací list</title>
</head>
<body style="margin-top:-35px;">
    <style>
        *{ font-family: DejaVu Sans !important;}

        h1 {
            font-size: 22px;
        }

        p, td {
            font-size:14px
        }

        .page_break { 
            page-break-before: always; 
        }
        
    </style>


    @foreach($final_orders as $client)
        @if(isset($client['orders']))
            @foreach($client['orders'] as $order)
                <table>
                    <tr>
                        <td style="position: relative;width:100%;">
                            <h1 style="position: absolute;right:-480px;top:0px;">{{$order['id']}}</h1>
                            <h1>DODACÍ LIST</h1>
                            <p>Datum vystavení: {{date('d.m.Y' ,strtotime($order['date']))}}</p>

                        </td>
                    </tr>
                </table>
                
                <table style="width:100%">
                    <tr style="width:100%">
                        <td style="width:50%;height:170px;border:1px solid black;border-radius:10px;position:relative;">
                            <p style="position:absolute;top:-15px;left:10px;">Dodavatel:</p>
                            <p style="position:absolute;top:15px;left:10px;">Jméno: Josef Fabičovic</p>
                            <p style="position:absolute;top:35px;left:10px;">Adresa: Ivaň 324, Ivaň 691 23</p>
                            <p style="position:absolute;top:55px;left:10px;">IČ: 75100690</p>
                            <p style="position:absolute;top:75px;left:10px;">DIČ: CZ8706174455</p>
                            <p style="position:absolute;top:95px;left:10px;">Telefon: 773605164</p>
                        </td>
                        <td style="width:50%;height:170px;border:1px solid black;border-radius:10px;position:relative;">
                            <p style="position:absolute;top:-15px;left:10px;">Odběratel:</p>
                            <p style="position:absolute;top:15px;left:10px;">Jméno: {{$client['client']}}</p>
                            <p style="position:absolute;top:35px;left:10px;">Adresa: {{$client['address']}}</p>
                            <p style="position:absolute;top:55px;left:10px;">IČ: {{$client['ic']}}</p>
                            <p style="position:absolute;top:75px;left:10px;">DIČ: {{$client['dic']}}</p>
                            <p style="position:absolute;top:95px;left:10px;">Telefon: {{$client['phone']}}</p>
                        </td>
                    </tr>
                </table>
                @if(isset($order['note']) && $order['note'] != "")
                <p>Poznámka: {{$order['note']}}</p>
                @else
                <br>
                @endif
                @if($order['currency'] == 'CZK')
                    <table style="border: 1px solid black;border-collapse: collapse;">
                        <tr style="border: 1px solid black;border-collapse: collapse;font-size:12px;" >
                            <td style="width: 50px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">Množství</td>
                            <td style="width: 250px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">Název zboží</td>
                            <td style="width: 75px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">Cena za jednot. bez DPH</td>
                            <td style="width: 65px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">Cena celkem bez DPH</td>
                            <td style="width: 45px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">DPH %</td>
                            <td style="width: 60px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">DPH {{$order['currency'] == 'CZK' ? 'Kč' : '€'}}</td>
                            <td style="width: 75px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">Cena celkem s DPH</td>
                        </tr>

                        @php 
                            $count = 0; 
                            $price = 0;
                        @endphp

                        @if(isset($order['items']))
                            @foreach($order['items'] as $item)
                                <tr style="border: 1px solid black;border-collapse: collapse;font-size:12px;" >
                                    <td style="width: 50px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{$item['quantity']}}</td>
                                    <td style="width: 250px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;">{{$item['product']}}</td>
                                    <td style="width: 75px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{$item['price_per_kg']}}</td>
                                    <td style="width: 65px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{$item['price_per_kg'] * $item['quantity']}}</td>
                                    <td style="width: 45px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">15</td>
                                    <td style="width: 60px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{ (($item['price_per_kg'] * $item['quantity'])*1.15)-($item['price_per_kg'] * $item['quantity']) }}</td>
                                    <td style="width: 75px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{ ($item['price_per_kg'] * $item['quantity'])*1.15 }}</td>
                                </tr>
                                @php 
                                    $count++; 
                                    $price += $item['price_per_kg'] * $item['quantity'];
                                @endphp
                            @endforeach
                        @endif
                                
                        @for($i = 0; $i <= (7 - $count); $i++)
                            <tr style="border: 1px solid black;border-collapse: collapse;font-size:12px;" >
                                <td style="width: 50px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;"></td>
                                <td style="width: 250px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;"></td>
                                <td style="width: 75px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;"></td>
                                <td style="width: 65px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;"></td>
                                <td style="width: 45px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;"></td>
                                <td style="width: 60px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;"></td>
                                <td style="width: 75px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;"></td>
                            </tr>
                        @endfor
                        <tr style="border: 0px solid black;border-collapse: collapse;font-size:12px;" >
                            <td colspan="3" style="width: 375px;height:60px;border: 0px solid black;border-collapse: collapse;padding:0px 5px;text-align:left;font-size:20px;">Placeno: <strong>FAKTUROU - HOTOVĚ</strong></td>
                            <td style="width: 65px;height:60px;border: 2px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{ $price }}</td>
                            <td style="width: 45px;height:60px;padding:0px 5px;text-align:center;border: 0px solid black;border-collapse: collapse;"></td>
                            <td style="width: 60px;height:60px;padding:0px 5px;text-align:center;border: 0px solid black;border-collapse: collapse;"></td>
                            <td style="width: 75px;height:60px;border: 2px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{ $price * 1.15}}</td>
                        </tr>
                    </table>
                @else
                    <table style="border: 1px solid black;border-collapse: collapse;">
                        <tr style="border: 1px solid black;border-collapse: collapse;font-size:12px;" >
                            <td style="width: 50px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">Množství</td>
                            <td style="width: 250px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">Název zboží</td>
                            <td style="width: 65px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">Cena za jednotku</td>
                            <td style="width: 85px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">Cena celkem</td>
                        </tr>

                        @php 
                            $count = 0; 
                            $price = 0;
                        @endphp

                        @if(isset($order['items']))
                            @foreach($order['items'] as $item)
                                <tr style="border: 1px solid black;border-collapse: collapse;font-size:12px;" >
                                    <td style="width: 50px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{$item['quantity']}}</td>
                                    <td style="width: 250px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;">{{$item['product']}}</td>
                                    <td style="width: 65px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{$item['price_per_kg']}}</td>
                                    <td style="width: 85px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{$item['price_per_kg'] * $item['quantity']}}</td>
                                </tr>
                                @php 
                                    $count++; 
                                    $price += $item['price_per_kg'] * $item['quantity'];
                                @endphp
                            @endforeach
                        @endif
                                
                        @for($i = 0; $i <= (7 - $count); $i++)
                            <tr style="border: 1px solid black;border-collapse: collapse;font-size:12px;" >
                                <td style="width: 50px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;"></td>
                                <td style="width: 250px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;"></td>
                                <td style="width: 65px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;"></td>
                                <td style="width: 85px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;"></td>
                            </tr>
                        @endfor
                        <tr style="border: 0px solid black;border-collapse: collapse;font-size:12px;" >
                            <td colspan="3" style="width: 600px;height:60px;border: 0px solid black;border-collapse: collapse;padding:0px 5px;text-align:left;font-size:20px;">Placeno: <strong>FAKTUROU - HOTOVĚ</strong></td>
                            <td style="width: 85px;height:60px;border: 2px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{ $price }}</td>
                        </tr>
                    </table>
                @endif

                <table style="border: 1px solid black;border-collapse: collapse;margin-top:15px;">
                    <tr style="border: 1px solid black;border-collapse: collapse;">
                        <td style="width:347px;height:100px;position:relative;border: 1px solid black;border-collapse: collapse;">
                            <p style="position: absolute;top:-10px;left:5px;font-size:12px;">Předal<br>(jméno)</p>
                        </td>
                        
                        <td style="width:347px;height:100px;position:relative;border: 1px solid black;border-collapse: collapse;">
                            <p style="position: absolute;top:-10px;left:5px;font-size:12px;">Převzal<br>(jméno)</p>
                        </td>
                    </tr>
                
                </table>

                @if(!$loop->last)
                    <div class="page_break"></div>
                @endif

      
            @endforeach 
        @endif 
    @endforeach
  
</body>
</html>
