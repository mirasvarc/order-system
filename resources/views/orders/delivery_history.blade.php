@extends('layouts.app')

@section('main')

   
    <div class="title">
        <h1 class="title-h1">Historie rozvozů</h1>
    </div>
    <table class="table table-hover yajra-datatable clients-table orders-table display responsive nowrap" width="100%;">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Číslo objednávky</th>
            <th scope="col">Klient</th>
            <th scope="col">Auto</th>
            <th scope="col">Datum</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    
   

    <script type="text/javascript">
        $(function () {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('delivery_history.list') }}",
                columns: [
                    {data: 'delivery_id', name: 'delivery_id'},
                    {data: 'order_id', name: 'order_id'},
                    {data: 'name', name: 'name'},
                    {data: 'car', name: 'car'},
                    {data: 'date', name: 'date'},
                ],
                order: [[ 0, 'desc' ]],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.4/i18n/cs.json',
                }
            });

        });

    </script>

@endsection
