@extends('layouts.app')

@section('main')

    <div class="container plr-50 pt-5">
      
        <div class="row">
            {{--<div class="col-3">
                <div class="dashboard-block">
                    <h1 class="title-h1">Celkové tržby:</h1>
                    <p class="main-p p-3 text-center">{{number_format($total, 2, '.', ',')}} Kč</p>
                </div>
            </div>--}}
            <div class="col-3">
                <div class="dashboard-block" style="min-height: unset;">
                    <h1 class="title-h1">Počet objednávek:</h1>
                    <p class="main-p p-3 text-center">{{$orders_count}}</p>
                </div>
            </div>
            <div class="col-3">
                <div class="dashboard-block" style="min-height: unset;">
                    <h1 class="title-h1">Počet zákazníků:</h1>
                    <p class="main-p p-3 text-center">{{$clients_count}}</p>
                </div>
            </div>
            <div class="col-3">
                <div class="dashboard-block" style="min-height: unset;">
                    <h1 class="title-h1">Počet produktů:</h1>
                    <p class="main-p p-3 text-center">{{$products_count}}</p>
                </div>
            </div>
        </div>
        @if(session('admin'))
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
        @endif
    </div>



    
<script>

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
