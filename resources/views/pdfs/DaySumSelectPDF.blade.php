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

    <h1>Přehled pro {{$final_orders_1[0]['order']['date']}}</h1>
  
    <h3>Adresy:</h3>

    @foreach($final_orders_1 as $key => $order)
        @if(isset($order['order']))   
            <table>
                <tr style="border-bottom:1px solid grey">
                    <td style="min-width:150px;">{{$key+1}}) {{$order['client']}}</td>
                    <td style="min-width:350px;">{{$order['address']}}</td>
                    <td style="min-width:250px;">{{$order['phone']}}</td>
                </tr>
                @if(isset($order['note']))
                <tr style="border-bottom:1px solid grey">
                    <td style="min-width:150px;">Poznámka:</td>
                    <td style="min-width:350px;">
                           {{$order['note']}}
                    </td>
                    <td></td>
                </tr>
                @endif
            </table>
        @endif 
    @endforeach

 
    @php
        $items = [
            'brambory_k' => 0,
            'brambory_m' => 0,
            'brambory_l' => 0,
            'brambory_v' => 0,
            'brambory_c' => 0,
            'cibule' => 0,
            'cesnek' => 0,
            'boruvky' => 0,
        ];
    @endphp
   
    @foreach($final_orders_1 as $order)
        @if(isset($order['order']))
            
               
            @foreach($order['order']['items'] as $item)
                
                @switch($item['product_id'])
                    @case(1)
                        @php $items['brambory_k'] += $item['quantity'] @endphp
                        @break
                    @case(2)
                        @php $items['cibule'] += $item['quantity'] @endphp
                        @break
                    @case(3)
                        @php $items['boruvky'] += $item['quantity'] @endphp
                        @break
                    @case(4)
                        @php $items['cesnek'] += $item['quantity'] @endphp
                        @break
                    @case(5)
                        @php $items['brambory_m'] += $item['quantity'] @endphp
                        @break
                    @case(6)
                        @php $items['brambory_l'] += $item['quantity'] @endphp
                        @break
                    @case(7)
                        @php $items['brambory_v'] += $item['quantity'] @endphp
                        @break
                    @case(8)
                        @php $items['brambory_c'] += $item['quantity'] @endphp
                        @break
                    @default
                        
                @endswitch
            @endforeach
               
         
        @endif
    @endforeach

    <h3>Zboží:</h3>
    <table>
        @if($items['brambory_k'] > 0)
        <tr>
            <td>Brambory konzumní:</td>
            <td>&nbsp;</td>
            <td>{{$items['brambory_k']}} Kg</td>
        </tr>
        @endif
        @if($items['brambory_m'] > 0)
        <tr>
            <td>Brambory malé:</td>
            <td>&nbsp;</td>
            <td>{{$items['brambory_m']}} Kg</td>
        </tr>
        @endif
        @if($items['brambory_l'] > 0)
        <tr>
            <td>Brambory loupané:</td>
            <td>&nbsp;</td>
            <td>{{$items['brambory_l']}} Kg</td>
        </tr>
        @endif
        @if($items['brambory_v'] > 0)
        <tr>
            <td>Brambory vařené:</td>
            <td>&nbsp;</td>
            <td>{{$items['brambory_v']}} Kg</td>
        </tr>
        @endif
        @if($items['brambory_c'] > 0)
        <tr>
            <td>Brambory červené:</td>
            <td>&nbsp;</td>
            <td>{{$items['brambory_c']}} Kg</td>
        </tr>
        @endif
        @if($items['cibule'] > 0)
        <tr>
            <td>Cibule:</td>
            <td>&nbsp;</td>
            <td>{{$items['cibule']}} Kg</td>
        </tr>
        @endif
        @if($items['cesnek'] > 0)
        <tr>
            <td>Česnek</td>
            <td>&nbsp;</td>
            <td>{{$items['cesnek']}} Kg</td>
        </tr>
        @endif
        @if($items['boruvky'] > 0)
        <tr>
            <td>Borůvky:</td>
            <td>&nbsp;</td>
            <td>{{$items['boruvky']}} Kg</td>
        </tr>
        @endif
    </table>





    <div class="page_break"></div>



    @if(!empty($final_orders_2))
    @php $items = []; @endphp
    <h1>Přehled pro {{$final_orders_2[0]['order']['date']}}</h1>
    <br><br>
    <h3>Adresy:</h3>

    @foreach($final_orders_2 as $key => $order)
        @if(isset($order['order']))   
            <table>
                <tr style="border-bottom:1px solid grey">
                    <td style="min-width:150px;">{{$key+1}}) {{$order['client']}}</td>
                    <td style="min-width:350px;">{{$order['address']}}</td>
                    <td style="min-width:250px;">{{$order['phone']}}</td>
                </tr>
                @if(isset($order['note']))
                <tr style="border-bottom:1px solid grey">
                    <td style="min-width:150px;">Poznámka:</td>
                    <td style="min-width:350px;">
                           {{$order['note']}}
                    </td>
                    <td></td>
                </tr>
                @endif
            </table>
        @endif 
    @endforeach

 
    @php
        $items = [
            'brambory_k' => 0,
            'brambory_m' => 0,
            'brambory_l' => 0,
            'brambory_v' => 0,
            'brambory_c' => 0,
            'cibule' => 0,
            'cesnek' => 0,
            'boruvky' => 0,
        ];
    @endphp
   
    @foreach($final_orders_2 as $key => $order)
        @if(isset($order['order']))
            
               
            @foreach($order['order']['items'] as $item)
                
                @switch($item['product_id'])
                    @case(1)
                        @php $items['brambory_k'] += $item['quantity'] @endphp
                        @break
                    @case(2)
                        @php $items['cibule'] += $item['quantity'] @endphp
                        @break
                    @case(3)
                        @php $items['boruvky'] += $item['quantity'] @endphp
                        @break
                    @case(4)
                        @php $items['cesnek'] += $item['quantity'] @endphp
                        @break
                    @case(5)
                        @php $items['brambory_m'] += $item['quantity'] @endphp
                        @break
                    @case(6)
                        @php $items['brambory_l'] += $item['quantity'] @endphp
                        @break
                    @case(7)
                        @php $items['brambory_v'] += $item['quantity'] @endphp
                        @break
                    @case(8)
                        @php $items['brambory_c'] += $item['quantity'] @endphp
                        @break
                    @default
                        
                @endswitch
            @endforeach
               
         
        @endif
    @endforeach

    <h3>Zboží:</h3>
    <table>
        @if($items['brambory_k'] > 0)
        <tr>
            <td>Brambory konzumní:</td>
            <td>&nbsp;</td>
            <td>{{$items['brambory_k']}} Kg</td>
        </tr>
        @endif
        @if($items['brambory_m'] > 0)
        <tr>
            <td>Brambory malé:</td>
            <td>&nbsp;</td>
            <td>{{$items['brambory_m']}} Kg</td>
        </tr>
        @endif
        @if($items['brambory_l'] > 0)
        <tr>
            <td>Brambory loupané:</td>
            <td>&nbsp;</td>
            <td>{{$items['brambory_l']}} Kg</td>
        </tr>
        @endif
        @if($items['brambory_v'] > 0)
        <tr>
            <td>Brambory vařené:</td>
            <td>&nbsp;</td>
            <td>{{$items['brambory_v']}} Kg</td>
        </tr>
        @endif
        @if($items['brambory_c'] > 0)
        <tr>
            <td>Brambory červené:</td>
            <td>&nbsp;</td>
            <td>{{$items['brambory_c']}} Kg</td>
        </tr>
        @endif
        @if($items['cibule'] > 0)
        <tr>
            <td>Cibule:</td>
            <td>&nbsp;</td>
            <td>{{$items['cibule']}} Kg</td>
        </tr>
        @endif
        @if($items['cesnek'] > 0)
        <tr>
            <td>Česnek</td>
            <td>&nbsp;</td>
            <td>{{$items['cesnek']}} Kg</td>
        </tr>
        @endif
        @if($items['boruvky'] > 0)
        <tr>
            <td>Borůvky:</td>
            <td>&nbsp;</td>
            <td>{{$items['boruvky']}} Kg</td>
        </tr>
        @endif
    </table>
    @endif
</body>
</html>