@extends('layouts.app')

@section('main')


<div class="container client-detail-container">
    <br>
    <a href="/clients" class="client-detail-back">Zpět</a>
    <br>
    <div class="row client-detail-row">
        <div class="col-12 col-md-6 col-xs-12 client-detail-col">
            <h2>Osobní údaje</h2>
            <table>
                <tr>
                    <td>Jméno a příjmení:</td>
                    <td>{{$client->name}}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{$client->email}}</td>
                </tr>
                <tr>
                    <td>Telefon:</td>
                    <td>{{$client->phone}}</td>
                </tr>
                <tr>
                    <td>Den návozu:</td>
                    <td>{{$client->day}}</td>
                </tr>
            </table>
            <br>
            <h2>Adresa</h2>
            <table>
                <tr>
                    <td>Ulice:</td>
                    <td>{{$client->street}}</td>
                </tr>
                <tr>
                    <td>Číslo:</td>
                    <td>{{$client->street_number}}</td>
                </tr>
                <tr>
                    <td>Město:</td>
                    <td>{{$client->city}}</td>
                </tr>
                <tr>
                    <td>PSČ:</td>
                    <td>{{$client->zip}}</td>
                </tr>
                <tr>
                    <td>Stát:</td>
                    <td>{{$client->country}}</td>
                </tr>
            </table>
            <br>
        </div>
        <div class="col-12 col-md-6 col-xs-12 client-detail-col">
            <h2>Poznámka</h2>
            <table>
                <tr>
                    <td>{{$client->note}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row client-detail-row">
        <div class="col-12 client-detail-col">
            <h2>Objednávky klienta</h2>
            <br>
            {{--<p>
                Export:
                <a href="/clients/export/orders/{{$day = 'Pondělí'}}/client/{{$client->id}}" class="btn btn-export">Pondělí</a>
                <a href="/clients/export/orders/{{$day = 'Úterý'}}/client/{{$client->id}}" class="btn btn-export">Úterý</a>
                <a href="/clients/export/orders/{{$day = 'Středa'}}/client/{{$client->id}}" class="btn btn-export">Středa</a>
                <a href="/clients/export/orders/{{$day = 'Čtrvtek'}}/client/{{$client->id}}" class="btn btn-export">Čtrvtek</a>
                <a href="/clients/export/orders/{{$day = 'Pátek'}}/client/{{$client->id}}" class="btn btn-export">Pátek</a>
                <a href="/clients/export/orders/{{$day = 'Vše'}}/client/{{$client->id}}" class="btn btn-export">Vše</a>
            </p>
            <br>--}}
            <table class="table table-hover yajra-datatable clients-table display responsive nowrap" width="100%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cena (Kč)</th>
                    <th scope="col">Den závozu</th>
                    <th scope="col">Datum vytvoření</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function () {

      var table = $('.yajra-datatable').DataTable({
          processing: true,
          serverSide: true,
          responsive: true,
          ajax: {
              url: "{{ route('client_orders.list') }}",
              data: {
                client: "{{$client->id}}"
              },
            },
          columns: [
              {data: 'id', name: 'id'},
              {data: 'full_price', name: 'full_price'},
              {data: 'day', name: 'day'},
              {data: 'created_at', name: 'created_at'},
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
