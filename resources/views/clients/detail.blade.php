@extends('layouts.app')

@section('main')


<div class="container client-detail-container">
    <br>
    <a href="/clients" class="client-detail-back">Zpět</a>
    <br>
    <div class="row client-detail-row">
        <div class="col-12 client-detail-col">
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

        </div>
    </div>
    <div class="row client-detail-row">
        <div class="col-12 client-detail-col">
            <h2>Objednávky klienta</h2>
            <br>
            <table class="table table-hover yajra-datatable clients-table display responsive nowrap" width="100%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cena (Kč)</th>
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
