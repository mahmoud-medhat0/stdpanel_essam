@extends('layouts.parent2')
@section('title', 'Add New Exam Record')
@section('content')
@include('messages.message')
<div class="col-12" bis_skin_checked="1">
    @isset($success1)
    {{ $success1 }}
    @endisset
    <div class="white_card_body" bis_skin_checked="1">
        <div class="white_card_header" bis_skin_checked="1">
            <div class="box_header m-0" bis_skin_checked="1">
                <div class="main-title" bis_skin_checked="1">
                    <h3 class="m-0">@yield('title')</h3>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('storeexm') }}" method="post">
        @csrf
        <br>
        <center> <label for="start">Select date:</label>
            <input type="date" id="start" class="form-control" name="date" value="{{ date('Y-m-d') }}">
            @error('date')
            <div class="text-danger font-weight-bold">*{{ $message }}</div>
            @enderror
            <br>
            <div class="col-lg-6 flex" bis_skin_checked="1">
                <label for="branche">Select branche:</label>
                <div class="" tabindex="0" bis_skin_checked="1">
                    <select name="branche" id="status" class="form-control">
                        <option value="">NONE</option>
                        @foreach ($branches as $branche)
                        <option @selected($branche->id==(old('branche'))) value="{{ $branche->id }}">
                            {{ $branche->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('branche')
                    <div class="text-danger font-weight-bold">*{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <label for="maximum">maximum degree</label>
                    <input type="text" name="maximum" class="form-control" placeholder="maximum degree">
                </div>
            </div>

        </center>
        <table class="table lms_table_active dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid"
            aria-describedby="DataTables_Table_0_info" style="width: 500px;">
            <thead>
                <tr role="row">
                    <th scope="col" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                        colspan="1" style="width: 74px;" aria-sort="ascending"
                        aria-label="id: activate to sort column descending">id</th>
                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                        colspan="1" style="width: 74px;" aria-label="User: activate to sort column ascending">name</th>
                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                        colspan="1" style="width: 74px;" aria-label="User: activate to sort column ascending">payed</th>
                    <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                        colspan="1" style="width: 74px;" aria-label="User: activate to sort column ascending">degree
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr role="row" class="odd">
                    <th scope="row" tabindex="0" class="sorting_1"> <a
                            href="{{ route('edit', $student->id) }}">{{ $student->id }}
                            <input type="hidden" name="id_{{ $student->id }}" value="{{ $student->id }}">
                            @error($student->id)
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                    </th>
                    <td>{{ $student->name }}</td>
                    <td>
                        <div class="common_input mb_10" bis_skin_checked="1">
                            <input class="form-control" type="text" value="{{ old('payed_'.$student->id) }}" name="payed_{{ $student->id }}"
                                placeholder="payed" id="">
                            @error('payed_' . $student->id)
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </td>
                    <td>
                        <div class="common_input mb_10" bis_skin_checked="1">
                            <input class="form-control" type="text" value="{{ old('degree_'.$student->id) }}"
                                name="degree_{{ $student->id }}" placeholder="degree" id="">
                            @error('degree_' . $student->id)
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <center>
            <div class="create_report_btn mt_30" bis_skin_checked="1">
                <button class="btn btn-primary my-4"> save </button>
            </div>
        </center>
    </form>
    <br>
    <br>
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
                            th = table.getElementsByTagName("th");
                            for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("th")[0];
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
