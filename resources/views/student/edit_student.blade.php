@extends('layouts.parent2')
@section('title', 'Edit Student')
@section('content')
@include('messages.message')
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
            <form action="{{ route('update') }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $student->id }}">
                <div class="row" bis_skin_checked="1">
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="common_input mb_15" bis_skin_checked="1">
                            <input name="name" value="{{ $student->name }}" onkeyup="myFunction()" id="myInput" type="text" placeholder="Name">
                            @error('name')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="common_input mb_15" bis_skin_checked="1">
                            <input name="username" value="{{ $student->username }}" type="text" placeholder="username" id="input1" >
                            @error('username')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="common_input mb_15" bis_skin_checked="1">
                            <input value="{{ $student->phone }}" type="text" name="phone" placeholder="phone">
                            @error('phone')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="common_input mb_15" bis_skin_checked="1">
                            <input value="{{ $student->p_phone }}" type="text" name="p_phone"
                                placeholder="parent phone">
                            @error('p_phone')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="common_input mb_15" bis_skin_checked="1">
                            <input id="password" class="@error('password') is-invalid @enderror" name="password"
                                type="text" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="common_input mb_15" bis_skin_checked="1">
                            <input id="password-confirm" name="password_confirmation" type="text"
                                placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="common_input mb_15" bis_skin_checked="1">
                            <input value="{{ $student->sumprep }}" type="text" name="sumprep" placeholder="sumprep">
                            @error('sumprep')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="" tabindex="0" bis_skin_checked="1">
                            <select name="verified" id="verified" class="form-control">
                                <option @selected($student->verified == 1) value="1"> Active
                                </option>
                                <option @selected($student->verified == 0) value="0"> Not Active
                                </option>
                            </select>
                            @error('verified')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6" bis_skin_checked="1">
                        <div class="" tabindex="0" bis_skin_checked="1">
                            <select name="sec" id="status" class="form-control">
                                <option value="">NONE</option>
                                @foreach ($secs as $sec)
                                <option @selected($sec->id==$student->sec_type_id) value="{{ $sec->id }}"> {{ $sec->name }}
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
                            <select name="gender" id="status" class="form-control">
                                <option @selected($student->gender=='m') value="m"> Male
                                </option>
                                <option @selected($student->gender=='f') value="f"> Female
                                </option>
                            </select>
                            @error('gender')
                            <div class="text-danger font-weight-bold">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12" bis_skin_checked="1">
                        <center>
                            <div class="create_report_btn mt_30" bis_skin_checked="1">
                                <button class="btn btn-primary my-4"> Update </button>
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
    var input, filter, input1, tr, td, rnd, txtValue,str,str1,len;
      input = document.getElementById("myInput");
      input1 =document.getElementById("input1");
      filter = input.value.toUpperCase();
      str = input.value;
      rnd = Math.floor(Math.random() * 100);
      len = str.split(" ").length;
    //   for (let x in len){
        str1 = str.replaceAll(' ','_');

        //   }
      input1.setAttribute('value',str1+rnd);
}
</script>
@endsection
