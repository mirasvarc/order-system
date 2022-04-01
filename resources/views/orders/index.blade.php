@extends('layouts.app')

@section('main')

    <div class="container">
        <div class="row client-list-row">
            <div class="col-12">
                <div class="title">
                    <h1><a href="/"><i class="fa fa-arrow-left"></a></i>&nbsp;Seznam objednávek</h1>
                    <a href="/orders/add" class="btn btn-success">Vytvořit objednávku</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-hover yajra-datatable clients-table display responsive nowrap" width="100%">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Klient</th>
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


    <script type="text/javascript">
        $(function () {
            console.log("test")
          var table = $('.yajra-datatable').DataTable({
              processing: true,
              serverSide: true,
              responsive: true,
              ajax: "{{ route('orders.list') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
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
