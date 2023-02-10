@extends('layouts.parent2')
@section('title', 'Add New Attendence Boys Record')
@section('content')
@include('messages.message')
<div class="col-12" bis_skin_checked="1">
    @isset($success1)
    {{ $success1 }}
    @endisset
    <div class="white_card card_height_100 mb_30" bis_skin_checked="1">

        <div class="white_card_body" bis_skin_checked="1">
            <div class="white_card_header" bis_skin_checked="1">
                <div class="box_header m-0" bis_skin_checked="1">
                    <div class="main-title" bis_skin_checked="1">
                        <h3 class="m-0">@yield('title')</h3>
                    </div>
                    <div class="serach_field_2" bis_skin_checked="1">
                        <div class="search_inner" bis_skin_checked="1">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for id.."
                                title="Type id">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <form action="{{ route('storeattend') }}" method="post">
            @csrf
            <input type="hidden" name="sec" value="{{ session()->get('sec') }}">
            @error('sec')
            <div class="text-danger font-weight-bold">*{{ $message }}</div>
            @enderror
            <center> <label for="start">Select date:</label>
                <input type="date" id="start" name="date" value="{{ date('Y-m-d') }}">
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
                            <option @selected($branche->id==(old('branche'))) value="{{ $branche->id }}"> {{ $branche->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('branche')
                        <div class="text-danger font-weight-bold">*{{ $message }}</div>
                        @enderror
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
                            colspan="1" style="width: 74px;" aria-label="User: activate to sort column ascending">
                            name</th>
                        <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                            colspan="1" style="width: 74px;" aria-label="User: activate to sort column ascending">
                            attendance</th>
                        <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                            colspan="1" style="width: 74px;" aria-label="User: activate to sort column ascending">
                            payed</th>
                        <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                            colspan="1" style="width: 74px;" aria-label="User: activate to sort column ascending">
                            reset</th>
                        <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                            colspan="1" style="width: 74px;" aria-label="User: activate to sort column ascending">
                            Home Work</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studentsid as $student)
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
                            <div class="col-lg-18" bis_skin_checked="1">
                                <div class="" tabindex="0" bis_skin_checked="1">
                                    <select name="attend_{{ $student->id }}" id="attendence" class="form-control">
                                        <option @selected( old('attend_'.$student->id)=='0') value="0" >⏱️ waiting</option>
                                        <option @selected( old('attend_'.$student->id)=='1') value="1" >✅ present</option>
                                        <option @selected( old('attend_'.$student->id)=='2') value="2" >❌ absent</option>
                                    </select>
                                    @error('attend_'.$student->id)
                                    <div class="text-danger font-weight-bold">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </td>
                        <td>
                            <div class="common_input mb_10" bis_skin_checked="1">
                                <select name="payed_{{ $student->id }}" class="form-control">
                                    <option @selected(old('payed_'.$student->id)=='20') value="20">20</option>
                                    <option @selected(old('payed_'.$student->id)=='15') value="15">15</option>
                                    <option @selected(old('payed_'.$student->id)=='10') value="10">10</option>
                                    <option @selected(old('payed_'.$student->id)=='5') value="5">5</option>
                                    <option @selected(old('payed_'.$student->id)=='-') value="-">-</option>
                                    <option @selected(old('payed_'.$student->id)=='*') value="*">*</option>
                                </select>
                                @error('payed_' . $student->id)
                                <div class="text-danger font-weight-bold">*{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="common_input mb_10" bis_skin_checked="1">
                                <input type="text" value="{{ old('reset_'.$student->id) }}"
                                    name="reset_{{ $student->id }}" placeholder="reset" id="">
                                @error('reset_' . $student->id)
                                <div class="text-danger font-weight-bold">*{{ $message }}</div>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="col-lg-18" bis_skin_checked="1">
                                <div class="" tabindex="0" bis_skin_checked="1">
                                    <select name="hw_{{ $student->id }}" id="hw" class="form-control">
                                        <option @selected( old('hw_'.$student->id)=='0') value="0" >❌ Not delivered
                                        </option>
                                        <option @selected( old('hw_'.$student->id)=='1') value="1" >✅ delivered
                                        </option>
                                    </select>
                                    @error('hw_'.$student->id)
                                    <div class="text-danger font-weight-bold">*{{ $message }}</div>
                                    @enderror
                                </div>
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
