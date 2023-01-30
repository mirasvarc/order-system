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

    <h1>Přehled pro {{$day}} {{$date}}</h1>
    
    <h3>Adresy:</h3>

    @foreach($final_orders as $key => $client)
        @if(isset($client['orders']))   
            <table>
                <tr style="border-bottom:1px solid grey">
                    <td style="width:350px;">{{$key+1}}) <strong>{{$client['client']}}</strong></td>
                    <td style="width:350px;">{{$client['address']}}</td>
                    {{--<td style="min-width:250px;">{{$client['phone']}}</td>--}}
                </tr>
                @foreach($client['orders'] as $order)
                    {{$order_note = $order['note']}}
                @endforeach 
                @if(isset($order_note))
                <tr style="border-bottom:1px solid grey">
                    <td style="width:350px;">Poznámka:
                           <span style="color:red;">{{$order_note}}, {{$client['note']}}</span>
                    </td>
                    <td></td>
                </tr>
                @else
                <tr style="border-bottom:1px solid grey">
                    <td style="width:350px;">Poznámka:
                           <span style="color:red;">{{$client['note']}}</span>
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
            'cibule' => 0,
            'boruvky' => 0,
            'cesnek' => 0,
            'brambory_m' => 0,
            'brambory_l' => 0,
            'brambory_v' => 0,
            'brambory_c' => 0,
            'cibule_25' => 0,
            'cibule_10' => 0,
            'loupane_krajene_10' => 0,
            'loupane_krajene_5' => 0,
            'loupane_cele_10' => 0,
            'kostky_syrove_10' => 0,
            'kostky_syrove_5' => 0,
            'platky_syrove' => 0,
            'hranolky_syrove' => 0,
            'varene_krajene' => 0,
            'varene_kostky' => 0,
            'varene_platky' => 0,
        ];
    @endphp

    @foreach($final_orders as $key => $client)
        @if(isset($client['orders']))
            @foreach($client['orders'] as $order)
                @if(isset($order))
                    @foreach($order['items'] as $item)
                        
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
                            @case(9)
                                @php $items['cibule_25'] += $item['quantity'] @endphp
                                @break
                            @case(10)
                                @php $items['cibule_10'] += $item['quantity'] @endphp
                                @break
                            @case(11)
                                @php $items['loupane_krajene_10'] += $item['quantity'] @endphp
                                @break
                            @case(12)
                                @php $items['loupane_krajene_5'] += $item['quantity'] @endphp
                                @break
                            @case(13)
                                @php $items['loupane_cele_10'] += $item['quantity'] @endphp
                                @break
                            @case(14)   
                                @php $items['kostky_syrove_10'] += $item['quantity'] @endphp
                                @break
                            @case(15)
                                @php $items['kostky_syrove_5'] += $item['quantity'] @endphp
                                @break
                            @case(16)   
                                @php $items['platky_syrove'] += $item['quantity'] @endphp
                                @break
                            @case(17)
                                @php $items['hranolky_syrove'] += $item['quantity'] @endphp
                                @break
                            @case(18)   
                                @php $items['varene_krajene'] += $item['quantity'] @endphp
                                @break
                            @case(19)
                                @php $items['varene_kostky'] += $item['quantity'] @endphp
                                @break
                            @case(20)
                                @php $items['varene_platky'] += $item['quantity'] @endphp
                                @break
                            @default
                                
                        @endswitch
                    @endforeach
                @endif
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
            <td>Česnek:</td>
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
        @if($items['cibule_25'] > 0)
        <tr>
            <td>Cibule 25kg:</td>
            <td>&nbsp;</td>
            <td>
                {{ $items['cibule_25'] }} Kg
            </td>
        </tr>
        @endif
        @if($items['cibule_10'] > 0)
        <tr>
            <td>Cibule 10kg:</td>
            <td>&nbsp;</td>
            <td>
                {{ $items['cibule_10'] }} Kg
            </td>
        </tr>
        @endif
        @if($items['loupane_krajene_10'] > 0)
        <tr>
            <td>Loupané krajné 10kg:</td>
            <td>&nbsp;</td>
            <td>
                {{ $items['loupane_krajene_10'] }} Kg
            </td>
        </tr>
        @endif
        @if($items['loupane_krajene_5'] > 0)
        <tr>
            <td>Loupané krajné 5kg:</td>
            <td>&nbsp;</td>
            <td>
                {{ $items['loupane_krajene_5'] }} Kg
            </td>
        </tr>
        @endif
        @if($items['loupane_cele_10'] > 0)
        <tr>
            <td>Loupané celé 10kg:</td>
            <td>&nbsp;</td>
            <td>
                {{ $items['loupane_cele_10'] }} Kg
            </td>
        </tr>
        @endif
        @if($items['kostky_syrove_10'] > 0)
        <tr>
            <td>Kostky syrové 10kg:</td>
            <td>&nbsp;</td>
            <td>
                {{ $items['kostky_syrove_10'] }} Kg
            </td>
        </tr>
        @endif
        @if($items['kostky_syrove_5'] > 0)
        <tr>
            <td>Kostky syrové 5kg:</td>
            <td>&nbsp;</td>
            <td>
                {{ $items['kostky_syrove_5'] }} Kg    
            </td>
        </tr>
        @endif
        @if($items['platky_syrove'] > 0)
        <tr>
            <td>Plátky syrové:</td>
            <td>&nbsp;</td>
            <td>{{$items['platky_syrove']}} Kg</td>
        </tr>
        @endif
        @if($items['hranolky_syrove'] > 0)
        <tr>
            <td>Hranolky syrové:</td>
            <td>&nbsp;</td>
            <td>{{$items['hranolky_syrove']}} Kg</td>
        </tr>
        @endif
        @if($items['varene_krajene'] > 0)
        <tr>
            <td>Vařené krájené:</td>
            <td>&nbsp;</td>
            <td>{{$items['varene_krajene']}} Kg</td>
        </tr>
        @endif
        @if($items['varene_kostky'] > 0)
        <tr>
            <td>Vařené kostky:</td>
            <td>&nbsp;</td>
            <td>{{$items['varene_kostky']}} Kg</td>
        </tr>
        @endif
        @if($items['varene_platky'] > 0)
        <tr>
            <td>Vařené plátky:</td>
            <td>&nbsp;</td>
            <td>{{$items['varene_platky']}} Kg</td>
        </tr>
        @endif

    </table>
  
</body>
</html>
