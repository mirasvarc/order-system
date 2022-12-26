@extends('layouts.app')

@section('main')
    @if(session('admin'))
    <div class="title">
        <h1><a href="/"><i class="fa fa-arrow-left"></a></i>&nbsp;Přehledy </h1>
        &nbsp;&nbsp;<span class="text-danger">(Testovací verze, může obsahovat chyby)</span>
    </div>
    
    <div class="container plr-50 pt-5">
        
        <div class="row">
            <div class="col-4">
                <div class="dashboard-block">
                    <h1 class="title-h1">Celkové prodeje:</h1>
                    <br>
                    <div>
                        @foreach($items_sold as $i)
                            @php
                                $quantity = 0;
                                foreach($i as $item) {
                                    $quantity += $item->quantity;
                                    $unit = $item->unit;
                                    $name = $item->name;
                                }
                            @endphp
                            <p class="d-flex justify-content-between">
                                <span>{{$name}}:</span> 
                                <span>{{$quantity}} {{$unit}}</span>
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
           {{-- <div class="col-4">
                <div class="dashboard-block">
                    <h1 class="title-h1">Tento měsíc:</h1>
                    <br>
                    <div>
                        @foreach($items_sold_this_month as $i)
                            <p class="d-flex justify-content-between">
                                <span>{{$i->name}}:</span> 
                                <span>{{$i->quantity}} {{$i->unit}}</span>
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="dashboard-block">
                    <h1 class="title-h1">Minulý měsíc:</h1>
                    <br>
                    <div>
                        @foreach($items_sold_last_month as $i)
                            <p class="d-flex justify-content-between">
                                <span>{{$i->name}}:</span> 
                                <span>{{$i->quantity}} {{$i->unit}}</span>
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>--}}
            <div class="col-4">
                <div class="dashboard-block">
                    <h1 class="title-h1">
                        Prodeje podle data:
                    </h1>
                    <div class="mt-2">
                        od: <input type="date" name="date_from" id="date_from">
                        do: <input type="date" name="date_to" id="date_to">
                    </div>
                    <br>
                    <div id="itemsByDate">
                        
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="dashboard-block">
                    <h1 class="title-h1">
                        Tržby podle data:
                    </h1>
                    <div class="mt-2">
                        od: <input type="date" name="date2_from" id="date2_from">
                        do: <input type="date" name="date2_to" id="date2_to">
                    </div>
                    <br>
                    <div id="salesByDate">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="dashboard-block">
                    <canvas id="myChart" width="400" height="130"></canvas>
                </div>
            </div>
            <div class="col-12">
                <div class="dashboard-block">
                    <canvas id="myChart2" width="400" height="130"></canvas>
                </div>
            </div>
        </div>
    </div>
    @else
        <h1 class="text-center">Nemáte přístup k této stránce</h1>
    @endif

            

            



<script>

    $('#date_from').on('change', function() {
        var date_from = $(this).val()
        var date_to = $('#date_to').val()
        if(date_from != "" && date_to != "") {
            $.ajax('/stats/getSoldItemsByDate', {
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    date_from: date_from,
                    date_to: date_to
                },
                success: function(res) {
                    console.log(res)
                    showItems(res)
                }
            });
        }
        
    })

    $('#date_to').on('change', function() {
        var date_to = $(this).val()
        var date_from = $('#date_from').val()
        if(date_from != "" && date_to != "") {
            $.ajax('/stats/getSoldItemsByDate', {
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    date_from: date_from,
                    date_to: date_to
                },
                success: function(res) {
                    console.log(res)
                    showItems(res)
                }
            });
        }
    })


    $('#date2_from').on('change', function() {
        var date_from = $(this).val()
        var date_to = $('#date2_to').val()
        if(date_from != "" && date_to != "") {
            $.ajax('/stats/getSalesByDate', {
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    date_from: date_from,
                    date_to: date_to
                },
                success: function(res) {
                    console.log(res)
                    showSales(res);
                }
            });
        }
        
    })

    $('#date2_to').on('change', function() {
        var date_to = $(this).val()
        var date_from = $('#date2_from').val()
        if(date_from != "" && date_to != "") {
            $.ajax('/stats/getSalesByDate', {
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    date_from: date_from,
                    date_to: date_to
                },
                success: function(res) {
                    console.log(res);
                    showSales(res);
                }
            });
        }
    })
    

    function showItems(data) {
        $('#itemsByDate').html('');
        for(var i = 0; i < data.length; i++) {
            $('#itemsByDate').append(
                '<p class="d-flex justify-content-between">'+
                    '<span>'+ data[i].name +':</span> '+
                    '<span>'+ data[i].quantity + data[i].unit +'</span>'+
                '</p>'
            );
        }
        
    }

    function showSales(data) {
        $('#salesByDate').html('');
        
            $('#salesByDate').append(
                '<p class="d-flex justify-content-between">'+
                    '<span>Tržby CZK:</span> '+
                    '<span>'+ data[0][0].total +' Kč</span>'+
                '</p>' +
                '<p class="d-flex justify-content-between">'+
                    '<span>Tržby EUR:</span> '+
                    '<span>'+ data[1][0].total +' Eur</span>'+
                '</p>'
            );
        
        
    }

$(window).on('load', function() {
        $.ajax('/stats/getOrdersPriceByDays',{
            success: function (data, status, xhr) {

                var totals_czk = Array();
                var totals_eur = Array();
                var dates_czk = Array();
                var dates_eur = Array();
                console.log(data)
                data[0].forEach(element => {
                    totals_czk.push(element.total);
                    dates_czk.push(element.date);
                });
                data[1].forEach(element => {
                    totals_eur.push(element.total);
                    dates_eur.push(element.date);
                });

                plotTotalsByDayCZK(totals_czk, dates_czk); 
                plotTotalsByDayEUR(totals_eur, dates_eur);       
            }
        });

       /* $.ajax('/stats/getOrdersItemsByDays',{
            success: function (data, status, xhr) {

                console.log(data);
                //plotSoldItemsByDay();
                       
            }
        });*/
    });


    function plotTotalsByDayCZK(totals_czk, dates) {
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Denní hodnota CZK',
                    data: totals_czk,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Tržby CZK',
                        align: 'start',
                        font: {
                            size: 20
                        }
                    }
                }
            }
        }); 
    }

    function plotTotalsByDayEUR(totals_eur, dates) {
        const ctx = document.getElementById('myChart2').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Denní hodnota EUR',
                    data: totals_eur,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Tržby EUR',
                        align: 'start',
                        font: {
                            size: 20
                        }
                    }
                }
            }
        }); 
    }

    function plotSoldItemsByDay() {
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Hodnota objednávek v CZK',
                    data: totals,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Přehled tržeb z objednávek pro jednotlivé dny',
                        align: 'start',
                        font: {
                            size: 20
                        }
                    }
                }
            }
        }); 
    }
    </script>

@endsection