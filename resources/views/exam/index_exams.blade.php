@extends('layouts.parent2')
@section('title', 'List Of Exams')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
@endsection
@section('content')
@include('messages.message')
<div class="row">
    <center>
        <div class="col-md-9">
            @isset($success1)
            {{ $success1 }}
            @endisset
            <div class="table-wrap">
                <div class="white_box_tittle list_header" bis_skin_checked="1">
                    <h4>@yield('title')</h4>
                </div>

                <div id="printBar"></div>

                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer" bis_skin_checked="1">
                    <table class="table  dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid"
                        aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Branch</th>
                                <th class="col">money</th>
                                <th scope="col">date</th>
                                <th class="col">created at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exams as $exam)
                            <tr class="alert" role="alert">
                                <th>{{ $exam->id }}</th>
                                <td>{{ $exam->name }}</td>
                                <td>{{ $exam->money }}</td>
                                <td>{{ $exam->date }}</td>
                                <td>{{ $exam->created_at }}</td>
                                <td>
                                    <div class="action_btns d-flex" bis_skin_checked="1">
                                        <form action="{{ route('editexm',$exam->id) }}" method="get">
                                            <button class="action_btn"><i class="far fa-edit"></i></button>
                                        </form>
                                        <form action="{{ route('deleteexm',$exam->id) }}" method="get">
                                            <button class="action_btn"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th scope="col">id</th>
                            <th scope="col">Branch</th>
                            <th class="col">money</th>
                            <th scope="col">date</th>
                            <th class="col">created at</th>
                            <th scope="col">Action</th>
                        </tfoot>
                    </table>
    </center>
</div>
@section('js')
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.colVis.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/bootstrap.daterangepicker/1/daterangepicker.js"></script>

<script
    src="https://cdn.datatables.net/s/bs-3.3.5/jszip-2.5.0,pdfmake-0.1.18,dt-1.10.10,b-1.1.0,b-colvis-1.1.0,b-flash-1.1.0,b-html5-1.1.0,b-print-1.1.0,r-2.0.0/datatables.min.js">
</script>

<script src="{{ asset('bundles/fosjsrouting/js/router.js') }}"></script>

<script>
    $('#DataTables_Table_0 thead tr').clone(true).appendTo('#DataTables_Table_0 thead');
        // $('#example1 thead tr').clone(true).appendTo('#example1 thead').css('display','none');
        $('#DataTables_Table_0 thead tr:eq(1) th').each(function(i) {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control form-control-sm" placeholder="' +
                title + '" />');
            $('input', this).on('keyup click change', function(e) {
                e.stopPropagation();
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        })
    var table = $("#DataTables_Table_0").DataTable({
        responsive: false,
        lengthChange: true,
        autoWidth: false,
        orderCellsTop: true,
        paging:false,
        buttons: ["excel"]
    });
    table.buttons().container().appendTo('#printBar');
</script>
@endsection
@endsection
