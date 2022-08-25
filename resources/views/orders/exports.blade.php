@extends('layouts.app')

@section('main')


<div class="container client-detail-container" style="padding: 50px;">
    <div class="row">
        <div class="col-12">
            <div class="exports-wrapper">
                {{--<div>
                    <h2>Export objednávek:</h2>&nbsp;
                    <br class="br-mobile">
                    <a href="/orders/export/{{$day = 'Pondělí'}}" class="btn btn-export">Pondělí ({{$orders_count['monday']}})</a>
                    <a href="/orders/export/{{$day = 'Úterý'}}" class="btn btn-export">Úterý ({{$orders_count['tuesday']}})</a>
                    <a href="/orders/export/{{$day = 'Středa'}}" class="btn btn-export">Středa ({{$orders_count['wednesday']}})</a>
                    <a href="/orders/export/{{$day = 'Čtvrtek'}}" class="btn btn-export">Čtvrtek ({{$orders_count['thursday']}})</a>
                    <a href="/orders/export/{{$day = 'Pátek'}}" class="btn btn-export">Pátek ({{$orders_count['friday']}})</a>
                    <a href="/orders/export/{{$day = 'Vše'}}" class="btn btn-export">Vše ({{$orders_count['all']}})</a>
                </div>--}}
                <div>
                    <h2>Detailní export:</h2>&nbsp;
                    <br>
                    <form action="{{route('exportCustom')}}" method="POST">
                        @csrf
                        <label for="export_day_select">Den:</label>
                        <select name="export_day_select">
                            <option value=""></option>
                            <option value="Pondělí">Pondělí</option>
                            <option value="Úterý">Úterý</option>
                            <option value="Středa">Středa</option>
                            <option value="Čtvrtek">Čtvrtek</option>
                            <option value="Pátek">Pátek</option>
                            <option value="Vše">Vše</option>
                        </select>
                        &nbsp;
                        <label for="date_from">od:</label>
                        <input type="date" name="date_from">
                        &nbsp;
                        <label for="date_to">do:</label>
                        <input type="date" name="date_to">
                        &nbsp;
                        <input type="submit" class="btn btn-success" value="Exportovat">
                    </form>
                </div>
            
                <div class="mt-5">
                    <h2>Denní export pro řidiče:</h2>&nbsp;
                    <br>
                    <form id="exportCustomBill" action="{{route('exportForDriver')}}" method="POST">
                        @csrf
                        <label for="export_day_select">Den:</label>
                        <select name="export_day_select">
                            <option value=""></option>
                            <option value="Pondělí">Pondělí</option>
                            <option value="Úterý">Úterý</option>
                            <option value="Středa">Středa</option>
                            <option value="Čtvrtek">Čtvrtek</option>
                            <option value="Pátek">Pátek</option>
                            <option value="Vše">Vše</option>
                        </select>
                        &nbsp;
                        <label for="export_date_select">od:</label>
                        <input type="date" name="export_date_select">
                        &nbsp;
                    
                        <input type="submit" class="btn btn-success" value="Exportovat">
                        <input type="button" id="export-with-selection" class="btn btn-success" value="Exportovat s rozdělením">
                    </form>
                </div>
            
                {{--<div><strong>Export dodacích listů:</strong>&nbsp;
                    <br class="br-mobile">
                    <a href="/orders/export/bill/{{$day = 'Pondělí'}}" class="btn btn-export">Pondělí ({{$orders_count['monday']}})</a>
                    <a href="/orders/export/bill/{{$day = 'Úterý'}}" class="btn btn-export">Úterý ({{$orders_count['tuesday']}})</a>
                    <a href="/orders/export/bill/{{$day = 'Středa'}}" class="btn btn-export">Středa ({{$orders_count['wednesday']}})</a>
                    <a href="/orders/export/bill/{{$day = 'Čtvrtek'}}" class="btn btn-export">Čtvrtek ({{$orders_count['thursday']}})</a>
                    <a href="/orders/export/bill/{{$day = 'Pátek'}}" class="btn btn-export">Pátek ({{$orders_count['friday']}})</a>
                    <a href="/orders/export/bill/{{$day = 'Vše'}}" class="btn btn-export">Vše ({{$orders_count['all']}})</a>
                </div>--}}
            
                <div class="mt-5">
                    <h2>Dodací listy - detailní export:</h2>&nbsp;
                    <br>
                    <form action="{{route('exportCustomBill')}}" method="POST">
                        @csrf
                        <label for="export_day_select">Den:</label>
                        <select name="export_day_select">
                            <option value=""></option>
                            <option value="Pondělí">Pondělí</option>
                            <option value="Úterý">Úterý</option>
                            <option value="Středa">Středa</option>
                            <option value="Čtvrtek">Čtvrtek</option>
                            <option value="Pátek">Pátek</option>
                            <option value="Vše">Vše</option>
                        </select>
                        &nbsp;
                        <label for="export_date_select">datum:</label>
                        <input type="date" name="export_date_select">
                        &nbsp;
                        
                        <input type="submit" class="btn btn-success" value="Exportovat">
                        

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#export-with-selection').click(function(e) {
        e.preventDefault();
        $('#exportCustomBill').attr('action', '/orders/export/bill/with-selection');
        $('#exportCustomBill').submit();
    });
</script>

@endsection