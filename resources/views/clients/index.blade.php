@extends('layouts.app')

@section('main')
    

    <div class="title">
        <h1 class="title-h1">
            Seznam klientů
        </h1>
        <a href="/clients/add" class="btn btn-success">
            <i class="fa-solid fa-circle-plus"></i>
            &nbsp;Nový klient
        </a>
    </div>



    <table class="table table-hover yajra-datatable clients-table display responsive nowrap" width="100%">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Jméno a Příjmení / Společnost</th>
            <th scope="col">Email</th>
            <th scope="col">Telefon</th>
            <th scope="col">Den závozu</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            {{--<tr>
                @foreach ($clients as $client)
                <th scope="row">{{$client->id}}</th>
                <td>{{$client->name}}</td>
                <td>{{$client->email}}</td>
                <td>{{$client->phone}}</td>
                @endforeach
            </tr>--}}
        </tbody>
    </table>
       


    @if(isset($_REQUEST['add_success']))
        <div class="alert alert-success alert-dismissible fade show client-add-alert" role="alert">
            Klient byl úspěšně přidán!
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


    <script type="text/javascript">
        $(function () {

          var table = $('.yajra-datatable').DataTable({
              processing: true,
              serverSide: true,
              responsive: true,
              ajax: "{{ route('clients.list') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name', id: 'id'},
                  {data: 'email', name: 'email'},
                  {data: 'phone', name: 'phone'},
                  {data: 'day', name: 'day'},
                  {
                      data: 'action',
                      name: 'action',
                      orderable: true,
                      searchable: true
                  },
              ],
              language: {
                  url: 'https://cdn.datatables.net/plug-ins/1.11.4/i18n/cs.json',
              }
          });

        });

    </script>

@endsection
