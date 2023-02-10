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
                    <a class="btn_1 radius_btn d-block text-center" href="{{ route('attend_stamp') }}">Download stamp</a>
                </div>
            </div>
        </div>
        <div class="white_card_body" bis_skin_checked="1">
            @isset($success)
            {{ $success }}
            @endisset
            <form action="{{ route('attend_store_excel') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row" bis_skin_checked="1">
                    <div class="col-lg-6">
                        <label for="start">Select date:</label>
                        <input type="date" id="start" name="date" value="{{ date('Y-m-d') }}">
                        @error('date')
                        <div class="text-danger font-weight-bold">*{{ $message }}</div>
                        @enderror
                    </div>
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
                        <div class="" tabindex="0" bis_skin_checked="1">
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
                        <div class=" mb-0">
                            <label for="sheet">sheet</label>
                            <input type="file" name="sheet" id="exampleFormControlFile1">
                            @error('sheet')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12" bis_skin_checked="1">
                        <center>
                            <div class="create_report_btn mt_30" bis_skin_checked="1">
                                <button class="btn_1 radius_btn d-block text-center">Add Exercise</button>
                            </div>
                        </center>

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    function myFunction(){
        var input, filter, input1, tr, td, rnd, txtValue,str,str1;
          input = document.getElementById("myInput");
          input1 =document.getElementById("input1");
          filter = input.value.toUpperCase();
          str = input.value;
          rnd = Math.floor(Math.random() * 100);
          str1 = str.replaceAll(' ','_')+'_'+rnd;
          input1.setAttribute('value',str1);
    }
</script>
@endsection
