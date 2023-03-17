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

    @for($i = 1; $i <= 6; $i++)
        @if(!empty($final_orders[$i]))

            <p><strong>Přehled pro {{$final_orders[$i][0]['order']['date']}}</strong></p>

            @foreach($final_orders[$i] as $key => $order)
                @if(isset($order['order']))   
                    <table>
                        <tr style="border-bottom:1px solid grey">
                            <td style="width:350px;">{{$key+1}}) <strong>{{$order['client']}}</strong></td>
                            <td style="width:350px;">{{$order['address']}}</td>
                            {{--<td style="min-width:250px;">{{$order['phone']}}</td>--}}
                        </tr>
                        @if((isset($order['note']) && $order['note'] != null) || (isset($order['note2']) && $order['note2'] != null))
                        <tr style="border-bottom:1px solid grey">
                            <td style="width:350px;">Poznámka:
                                <span style="color:red;">
                                    @if((isset($order['note']) && $order['note'] != null) && (isset($order['note2']) && $order['note2'] != null))
                                        {{$order['note']}}, {{$order['note2']}}
                                    @elseif(isset($order['note2']) && $order['note2'] != null)
                                        {{$order['note2']}}
                                    @elseif(isset($order['note']) && $order['note'] != null)
                                    {{$order['note']}}
                                    @endif
                                </span>
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
    
            @foreach($final_orders[$i] as $order)
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
       
            <table>
                <tr style="text-align: left;">
                    <td><strong>Zboží:</strong></td>
                    <td></td>
                    <td style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"><strong>&nbsp;&nbsp;Naloženo</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"><strong>&nbsp;&nbsp;Vráceno</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>&nbsp;&nbsp;Podpis</strong></td>
                </tr>
                @if($items['brambory_k'] > 0)
                <tr>
                    <td>Brambory konzumní:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">{{$items['brambory_k']}} Kg</td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['brambory_m'] > 0)
                <tr>
                    <td>Brambory malé:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">{{$items['brambory_m']}} Kg</td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['brambory_l'] > 0)
                <tr>
                    <td>Brambory loupané:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">{{$items['brambory_l']}} Kg</td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['brambory_v'] > 0)
                <tr>
                    <td>Brambory vařené:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">{{$items['brambory_v']}} Kg</td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['brambory_c'] > 0)
                <tr>
                    <td>Brambory červené:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">{{$items['brambory_c']}} Kg</td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['cibule'] > 0)
                <tr>
                    <td>Cibule:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">{{$items['cibule']}} Kg</td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['cesnek'] > 0)
                <tr>
                    <td>Česnek:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">{{$items['cesnek']}} Kg</td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['boruvky'] > 0)
                <tr>
                    <td>Borůvky:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">{{$items['boruvky']}} Kg</td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['cibule_25'] > 0)
                <tr>
                    <td>Cibule 25kg:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">
                        {{ $items['cibule_25'] }} Kg
                    </td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['cibule_10'] > 0)
                <tr>
                    <td>Cibule 10kg:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">
                        {{ $items['cibule_10'] }} Kg
                    </td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['loupane_krajene_10'] > 0)
                <tr>
                    <td>Loupané krájené 10kg:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">
                        {{ $items['loupane_krajene_10'] }} Kg
                    </td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['loupane_krajene_5'] > 0)
                <tr>
                    <td>Loupané krájené 5kg:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">
                        {{ $items['loupane_krajene_5'] }} Kg
                    </td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['loupane_cele_10'] > 0)
                <tr>
                    <td>Loupané celé 10kg:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">
                        {{ $items['loupane_cele_10'] }} Kg
                    </td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['kostky_syrove_10'] > 0)
                <tr>
                    <td>Kostky syrové 10kg:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">
                        {{ $items['kostky_syrove_10'] }} Kg
                    </td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['kostky_syrove_5'] > 0)
                <tr>
                    <td>Kostky syrové 5kg:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">
                        {{ $items['kostky_syrove_5'] }} Kg    
                    </td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['platky_syrove'] > 0)
                <tr>
                    <td>Plátky syrové:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">{{$items['platky_syrove']}} Kg</td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['hranolky_syrove'] > 0)
                <tr>
                    <td>Hranolky syrové:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">{{$items['hranolky_syrove']}} Kg</td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['varene_krajene'] > 0)
                <tr>
                    <td>Vařené krájené:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">{{$items['varene_krajene']}} Kg</td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['varene_kostky'] > 0)
                <tr>
                    <td>Vařené kostky:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">{{$items['varene_kostky']}} Kg</td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif
                @if($items['varene_platky'] > 0)
                <tr>
                    <td>Vařené plátky:</td>
                    <td>&nbsp;</td>
                    <td style="border-right:1px solid black;width:120px;">{{$items['varene_platky']}} Kg</td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td  style="border-right:1px solid black;width:120px;"></td>
                </tr>
                @endif

            </table>
               
            @if(!empty($final_orders[$i+1]))
                <div class="page_break"></div>
            @endif
        @endif
    @endfor



</body>
</html>
