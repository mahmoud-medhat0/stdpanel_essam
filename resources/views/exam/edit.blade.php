@extends('layouts.parent2')
@section('title', 'Edit Exam Record')
@section('content')
@include('messages.message')
<div class="col-12" bis_skin_checked="1">
    @isset($success1)
    {{ $success1 }}
    @endisset
    <div class="white_card card_height_100 mb_30" bis_skin_checked="1">
        <div class="white_card_body" bis_skin_checked="1">
            <div class="white_box_tittle list_header" bis_skin_checked="1">
                <h4>@yield('title')</h4>
            </div>
            <form action="{{route('examupdate')}}" method="POST">
                @csrf
                <center> <label for="start">date:</label>
                    <input class="form-control" type="date" id="start" disabled name="" value="{{ $students[0]->date }}">
                    @error('date')
                    <div class="text-danger font-weight-bold">*{{ $message }}</div>
                    @enderror
                </center>
                <table class="table lms_table_active dataTable no-footer dtr-inline" id="DataTables_Table_0" role="grid"
                    aria-describedby="DataTables_Table_0_info" style="width: 500px;">
                    <thead>
                        <tr role="row">
                            <th scope="col" class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0"
                                rowspan="1" colspan="1" style="width: 74px;" aria-sort="ascending"
                                aria-label="id: activate to sort column descending">id</th>
                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 74px;" aria-label="User: activate to sort column ascending">
                                name</th>
                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 74px;" aria-label="User: activate to sort column ascending">
                                payed</th>
                            <th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                colspan="1" style="width: 74px;" aria-label="User: activate to sort column ascending">
                                degree</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr role="row" class="odd">
                            <th scope="row" tabindex="0" class="sorting_1"> <a
                                    href="{{ route('edit', $student->std_id) }}"> {{ $student->std_id }}
                                    <input type="hidden" name="id_{{ $student->std_id }}"
                                        value="{{ $student->std_id }}">
                                    @error($student->std_id)
                                    <div class="text-danger font-weight-bold">*{{ $message }}</div>
                                    @enderror
                            </th>
                            <td>{{ $student->name }}</td>
                            <td>
                                <div class="common_input mb_10" bis_skin_checked="1">
                                    <input class="form-control" type="text" value="{{ $student->payed }}" name="payed_{{ $student->std_id }}"
                                        placeholder="payed">
                                    @error('degree_' . $student->std_id)
                                    <div class="text-danger font-weight-bold">*{{ $message }}</div>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="common_input mb_10" bis_skin_checked="1">
                                    <input class="form-control" type="text" value="{{ $student->degree }}"
                                        name="degree_{{ $student->std_id }}" placeholder="degree">
                                    @error('degree_' . $student->std_id)
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
            @endsection
