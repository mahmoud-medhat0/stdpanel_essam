@extends('layouts.parent2')
@section('title', 'Add New exercise record From Excel')
@section('content')
@include('messages.message')
<div class="col-12" bis_skin_checked="1">
    <div class="white_card card_height_100 mb_30" bis_skin_checked="1">
        <div class="white_card_header" bis_skin_checked="1">
            <div class="box_header m-0" bis_skin_checked="1">
                <div class="main-title" bis_skin_checked="1">
                    <h3 class="m-0">@yield('title')</h3>
                </div>
                <div>
                    <a class="btn_1 radius_btn d-block text-center" href="{{ route('exercise_stamp') }}">Download
                        stamp</a>
                </div>
            </div>
        </div>
        <div class="white_card_body" bis_skin_checked="1">
            @isset($success)
            {{ $success }}
            @endisset
            @if (session()->has('failures'))
            <table class="table table-danger">
                <tr>
                    <th>Row</th>
                    <th>attribute</th>
                    <th>Errors</th>
                    <th>Value</th>
                    @foreach (session()->get('failures') as $error)
                <tr>
                    <td>{{ $error->row() }}</td>
                    <td>{{ $error->attribute() }}</td>
                    <td>
                        <ul>
                            @foreach ($error->errors() as $e)
                            <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $error->values()[$error->attribute()] }}</td>
                </tr>
                @endforeach
                </tr>
            </table>
            @endif
            @if(isset($errors) && $errors->any())
            @foreach ($errors as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
            @endforeach
            @endif
            <form action="{{ route('attend_store_excel') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row" bis_skin_checked="1">
                    <center>
                        <div class="col-lg-6" bis_skin_checked="1">
                            <label for="start">Select date:</label>
                            <input type="date" id="start" class="form-control" name="date" value="{{ date('Y-m-d') }}">
                            @error('date')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </center>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="" tabindex="0" bis_skin_checked="1">
                            <label for="sec">secondary grade</label>
                            <select name="sec" id="status" class="form-control">
                                <option value="">NONE</option>
                                @foreach ($secs as $sec)
                                <option @selected($sec->id==old('sec')) value="{{ $sec->id }}"> {{ $sec->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('sec')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="" tabindex="1" bis_skin_checked="1">
                            <label for="Branch">Branch</label>
                            <select name="branch" id="status" class="form-control">
                                <option value="">NONE</option>
                                @foreach ($branches as $branche)
                                <option @selected($branche->id==old('branche')) value="{{ $branche->id }}">
                                    {{ $branche->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('branch')
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
                    <div class="col-lg-6">
                        <div class=" mb-0">
                            <label for="sheet">sheet</label>
                            <input type="file" class="form-control" name="sheet" id="exampleFormControlFile1">
                            @error('sheet')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12" bis_skin_checked="1">
                        <center>
                            <div class="create_report_btn mt_30" bis_skin_checked="1">
                                <button class="btn_1 radius_btn d-block text-center">Add Exercise Record</button>
                            </div>
                        </center>

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
