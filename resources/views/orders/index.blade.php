@extends('layouts.app')

@section('main')

   
    <div class="title">
        <h1 class="title-h1">Seznam objednávek</h1>
        <a href="/orders/add" class="btn btn-success">
            <i class="fa-solid fa-circle-plus"></i>
            &nbsp;
            Vytvořit objednávku
        </a>
    </div>
    <table class="table table-hover yajra-datatable clients-table orders-table display responsive nowrap" width="100%;">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Klient</th>
            <th scope="col">Cena (Kč / EUR)</th>
            <th scope="col">Den závozu</th>
            <th scope="col">Datum objednávky</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    
    {{--
        <div class="container">
            <div class="row client-list-row">
                <div class="col-12">
                    <div class="title">
                        <h1><a href="/"><i class="fa fa-arrow-left"></a></i>&nbsp;&nbsp;Seznam objednávek</h1>
                        <a href="/orders/add" class="btn btn-success">
                            <i class="fa-solid fa-circle-plus"></i>
                            &nbsp;
                            Vytvořit objednávku
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <br>
                    <p>
                        <strong>Export objednávek:</strong>&nbsp;
                        <br class="br-mobile">
                        <a href="/orders/export/{{$day = 'Pondělí'}}" class="btn btn-export">Pondělí ({{$orders_count['monday']}})</a>
                        <a href="/orders/export/{{$day = 'Úterý'}}" class="btn btn-export">Úterý ({{$orders_count['tuesday']}})</a>
                        <a href="/orders/export/{{$day = 'Středa'}}" class="btn btn-export">Středa ({{$orders_count['wednesday']}})</a>
                        <a href="/orders/export/{{$day = 'Čtvrtek'}}" class="btn btn-export">Čtvrtek ({{$orders_count['thursday']}})</a>
                        <a href="/orders/export/{{$day = 'Pátek'}}" class="btn btn-export">Pátek ({{$orders_count['friday']}})</a>
                        <a href="/orders/export/{{$day = 'Vše'}}" class="btn btn-export">Vše ({{$orders_count['all']}})</a>
                    </p>
                    <p>
                        <strong>Detailní export:</strong>&nbsp;
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
                    </p>
                    <br>
                    <p>
                        <strong>Denní export pro řidiče:</strong>&nbsp;
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
                    </p>
                    <br>
                    <p><strong>Export dodacích listů:</strong>&nbsp;
                        <br class="br-mobile">
                        <a href="/orders/export/bill/{{$day = 'Pondělí'}}" class="btn btn-export">Pondělí ({{$orders_count['monday']}})</a>
                        <a href="/orders/export/bill/{{$day = 'Úterý'}}" class="btn btn-export">Úterý ({{$orders_count['tuesday']}})</a>
                        <a href="/orders/export/bill/{{$day = 'Středa'}}" class="btn btn-export">Středa ({{$orders_count['wednesday']}})</a>
                        <a href="/orders/export/bill/{{$day = 'Čtvrtek'}}" class="btn btn-export">Čtvrtek ({{$orders_count['thursday']}})</a>
                        <a href="/orders/export/bill/{{$day = 'Pátek'}}" class="btn btn-export">Pátek ({{$orders_count['friday']}})</a>
                        <a href="/orders/export/bill/{{$day = 'Vše'}}" class="btn btn-export">Vše ({{$orders_count['all']}})</a>
                    </p>
                    <br>
                    <p>
                        <strong>Dodací listy - detailní export:</strong>&nbsp;
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
                    </p>
                    <br>
                    <table class="table table-hover yajra-datatable clients-table display responsive nowrap" width="100%">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Klient</th>
                            <th scope="col">Cena (Kč / EUR)</th>
                            <th scope="col">Den závozu</th>
                            <th scope="col">Datum objednávky</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if(isset($_REQUEST['add_success']))
            <div class="alert alert-success alert-dismissible fade show client-add-alert" role="alert">
                Objednávka byla úspěšně vytvořena!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <script>
                $(window).on('load', function() {
                    setTimeout(() => {
                        $('.client-add-alert').hide();
                    }, 5000);
                });
            </script>

        @endif



        <script>
            $('#export-with-selection').click(function(e) {
                e.preventDefault();
                $('#exportCustomBill').attr('action', '/orders/export/bill/with-selection');
                $('#exportCustomBill').submit();
            });
        </script>
    @endif--}}

    <script type="text/javascript">
        $(function () {
            var table = $('.yajra-datatable').DataTable({
                //processing: true,
                //serverSide: true,
                responsive: true,
                ajax: "{{ route('orders.list') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'full_price', name: 'full_price'},
                    {data: 'day', name: 'day'},
                    {data: 'date', name: 'date'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
                order: [[ 0, 'desc' ]],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.4/i18n/cs.json',
                }
            });

        });

    </script>

@endsection
