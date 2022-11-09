@extends('layouts.parent2')
@section('title', 'Add New Student')
@section('content')
@include('messages.message')
{{-- @if (isset($errors))
    {{ dd($errors->all()) }}
@endif --}}
<div class="col-12" bis_skin_checked="1">
    <div class="white_card card_height_100 mb_30" bis_skin_checked="1">
        <div class="white_card_header" bis_skin_checked="1">
            <div class="box_header m-0" bis_skin_checked="1">
                <div class="main-title" bis_skin_checked="1">
                    <h3 class="m-0">@yield('title')</h3>
                </div>
            </div>
        </div>
        <div class="white_card_body" bis_skin_checked="1">
            @isset($success)
            {{ $success }}
            @endisset
            <form action="{{ route('store_std') }}" method="post">
                @csrf
                <div class="row" bis_skin_checked="1">
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="common_input mb_15" bis_skin_checked="1">
                            <input name="name" value="{{ old('name') }}" onkeyup="myFunction()" id="myInput" type="text"
                                placeholder="Name">
                            @error('name')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="common_input mb_15" bis_skin_checked="1">
                            <input name="username" value="{{ old('username') }}" type="text" id="input1"
                                placeholder="username">
                            @error('username')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="common_input mb_15" bis_skin_checked="1">
                            <input value="{{ old('phone') }}" type="text" name="phone" placeholder="phone">
                            @error('phone')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="common_input mb_15" bis_skin_checked="1">
                            <input value="{{ old('p_phone') }}" type="text" name="p_phone" placeholder="parent phone">
                            @error('p_phone')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="common_input mb_15" bis_skin_checked="1">
                            <input class="@error('password') is-invalid @enderror" id="password" name="password"
                                type="password" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="common_input mb_15" bis_skin_checked="1">
                            <input id="password-confirm" type="password" name="password_confirmation"
                                placeholder="Confirm Password">
                        </div>
                        @error('password_confirm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="" tabindex="0" bis_skin_checked="1">
                            <select name="gender" id="status" class="form-control">
                                <option value="m"> Male
                                </option>
                                <option value="f"> Female
                                </option>
                            </select>
                            @error('gender')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="" tabindex="0" bis_skin_checked="1">
                            <select name="verified" id="status" class="form-control">
                                <option value="1"> Active
                                </option>
                                <option value="0"> Not Active
                                </option>
                            </select>
                            @error('verified')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <center>
                        <div class="col-lg-6" bis_skin_checked="1">
                            <div class="common_input mb_15" bis_skin_checked="1">
                                <input value="{{ old('sumprep') }}" type="text" name="sumprep" placeholder="sumprep">
                                @error('sumprep')
                                <div class="text-danger font-weight-bold">*{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </center>
                    <div class="col-12" bis_skin_checked="1">
                        <center>
                            <div class="create_report_btn mt_30" bis_skin_checked="1">
                                <button class="btn_1 radius_btn d-block text-center">Add Student</button>
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