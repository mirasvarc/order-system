@extends('layouts.app')

@section('main')

<div class="container">
    <div class="row client-list-row">
        <div class="col-12">
            <div class="title">
                <h1><a href="/"><i class="fa fa-arrow-left"></a></i>&nbsp;Přehledy </h1>
                &nbsp;&nbsp;<span class="text-danger">(Testovací verze, může obsahovat chyby)</span>
            </div>
        </div>
    </div>
  
    <div class="row">
        <div class="col-12">
            <canvas id="myChart" width="400" height="150"></canvas>

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