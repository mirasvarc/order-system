@extends('layouts.app')

@section('main')

    <div class="container plr-50 pt-5">
      
        {{--<div class="row">
            <div class="col-3">
                <div class="dashboard-block">
                    <h1 class="title-h1">Celkové tržby:</h1>
                    <p class="p-5">{{$total}}</p>
                </div>
            </div>
            <div class="col-3">
                <div class="dashboard-block">
                    
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-12">
                <div class="dashboard-block">
                    <canvas id="myChart" width="400" height="130"></canvas>
                </div>
            </div>
        </div>
    </div>



    
<script>

    $(window).on('load', function() {
        $.ajax('/stats/getOrdersPriceByDays',{
            success: function (data, status, xhr) {

                var totals = Array();
                var dates = Array();
                data.forEach(element => {
                    totals.push(element.total);
                    dates.push(element.date);
                });

                plotTotalsByDay(totals, dates);       
            }
        });

        $.ajax('/stats/getOrdersItemsByDays',{
            success: function (data, status, xhr) {

                console.log(data);
                //plotSoldItemsByDay();
                       
            }
        });
    });


    function plotTotalsByDay(totals, dates) {
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
                        text: 'Tržby',
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
