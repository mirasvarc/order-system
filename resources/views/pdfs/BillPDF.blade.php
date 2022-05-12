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

    
        
    </style>

    
        
       
    <table>
        <tr>
            <td><h1>DODACÍ LIST - DAŇOVÝ DOKLAD</h1></td>
            <td style="padding-left: 25px"><p>číslo ....................................................</p></td>
        </tr>
    </table>
    <p style="margin-top: -22px;margin-left:2px;">(nehodící se škrtněte)</p>
    <p>Datum vystavení .......................20........ Datum uskut. zdanitelného plnění ...........................20.......</p>
    <p>Na základě objednávky číslo ..................................................... ze dne ..................................20.......</p>

    <table style="width:100%">
        <tr style="width:100%">
            <td style="width:50%;height:150px;border:1px solid black;border-radius:10px;position:relative;">
                <p style="position:absolute;top:-15px;left:10px;">Dodavatel:</p>
            </td>
            <td style="width:50%;height:150px;border:1px solid black;border-radius:10px;position:relative;">
                <p style="position:absolute;top:-15px;left:10px;">Odběratel:</p>
                <p style="position:absolute;top:15px;left:10px;">Jméno: {{$client->name}}</p>
                <p style="position:absolute;top:35px;left:10px;">Adresa: {{$client->street}} {{$client->street_number}}, {{$client->city}} {{$client->zip}}</p>
                <p style="position:absolute;top:55px;left:10px;">IČ: {{$client->ic}}</p>
                <p style="position:absolute;top:75px;left:10px;">DIČ: {{$client->dic}}</p>
                <p style="position:absolute;top:95px;left:10px;">Telefon: {{$client->phone}}</p>
            </td>
        </tr>
    </table>
    <br>
    <table style="border: 1px solid black;border-collapse: collapse;">
        <tr style="border: 1px solid black;border-collapse: collapse;font-size:12px;" >
            <td style="width: 50px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">Množství</td>
            <td style="width: 250px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">Název zboží</td>
            <td style="width: 75px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">Cena za jednot. bez DPH</td>
            <td style="width: 65px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">Cena celkem bez DPH</td>
            <td style="width: 45px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">DPH %</td>
            <td style="width: 60px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">DPH Kč</td>
            <td style="width: 75px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;font-size:12px;">Cena celkem s DPH</td>
        </tr>

        @foreach($order_items as $item)
            <tr style="border: 1px solid black;border-collapse: collapse;font-size:12px;" >
                <td style="width: 50px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{$item->quantity}}</td>
                <td style="width: 250px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;">{{$item->product}}</td>
                <td style="width: 75px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{$item->price}}</td>
                <td style="width: 65px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{$item->price * $item->quantity}}</td>
                <td style="width: 45px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">15</td>
                <td style="width: 60px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{ (($item->price * $item->quantity)*1.15)-($item->price * $item->quantity) }}</td>
                <td style="width: 75px;height:60px;border: 1px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{ ($item->price * $item->quantity)*1.15 }}</td>
            </tr>
        @endforeach
                
        @for($i = 0; $i <= (7 - count($order_items)); $i++)
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
    </table>
    <table style="margin-top: -3px;margin-left:-5px;"> 
        <tr style="border: 1px solid black;border-collapse: collapse;font-size:12px;" >
            <td style="width: 50px;height:60px;padding:0px 5px;text-align:center;"></td>
            <td style="width: 250px;height:60px;padding:0px 5px;"></td>
            <td style="width: 75px;height:60px;padding:0px 5px;text-align:center;"></td>
            <td style="width: 65px;height:60px;padding:0px 5px;text-align:center;"></td>
            <td style="width: 45px;height:60px;padding:0px 5px;text-align:center;"></td>
            <td style="width: 60px;height:60px;padding:0px 5px;text-align:center;"></td>
            <td style="width: 73px;height:60px;border: 2px solid black;border-collapse: collapse;padding:0px 5px;text-align:center;">{{ $full_price['price_vat']}}</td>
        </tr>
    </table>

    <table style="border: 1px solid black;border-collapse: collapse;margin-top:15px;">
        <tr style="border: 1px solid black;border-collapse: collapse;">
            <td style="width:347px;height:70px;position:relative;border: 1px solid black;border-collapse: collapse;">
                <p style="position: absolute;top:-10px;left:5px;font-size:12px;">Předal<br>(jméno)</p>
            </td>
            
            <td style="width:347px;height:70px;position:relative;border: 1px solid black;border-collapse: collapse;">
                <p style="position: absolute;top:-10px;left:5px;font-size:12px;">Převzal<br>(jméno)</p>
            </td>
        </tr>
      
    </table>
  
</body>
</html>
