@extends('layouts.parent2')
@section('title', 'List Of Boys Exercises')
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
                    <div class="box_right d-flex lms_block" bis_skin_checked="1">
                        <div class="serach_field_2" bis_skin_checked="1">
                            <div class="search_inner" bis_skin_checked="1">
                                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Date"
                                    title="Type id">
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-responsive-xl" id="DataTables_Table_0">
                    <thead>
                        <tr>
                            <th scope="col">date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dates as $date)
                        <tr class="alert" role="alert">
                            {{-- <th><a href="{{ route('edit', $student->id) }}">{{ $student->id }}</th> --}}
                            <td>{{ $date->date }}</td>
                            <td>
                                <div class="action_btns d-flex" bis_skin_checked="1">
                                    <form action="{{ route('editexercise') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="date" value="{{ $date->date }}">
                                        @error('date')
                                        <div class="text-danger font-weight-bold">*{{ $message }}</div>
                                        @enderror
                                        <input type="hidden" name="gender" value="m">
                                        <button class="action_btn"><i class="far fa-edit"></i></button>
                                    </form>
                                    <form action="{{ route('deleteexercise'}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="date" value="{{ $date->date }}">
                                        <input type="hidden" name="gender" value="m">
                                        <button class="action_btn"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
    </center>
</div>
<script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("DataTables_Table_0");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("tr")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
        th = table.getElementsByTagName("td");
        for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }       
      }
    }
</script>

@endsection