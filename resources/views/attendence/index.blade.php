@extends('layouts.parent2')
@section('title', 'list of attendence')
@section('content')
@include('messages.message')
<center>
  <div class="col-lg-6">
      <div class="create_report_btn mt_30">
          <a href="{{ route('lst_attend_m') }}" class="btn_1 radius_btn d-block text-center">Boys</a>
      </div>
  </div>
  <div class="col-lg-6">
      <div class="create_report_btn mt_30">
          <a href="{{ route('lst_attend_f') }}" class="btn_1 radius_btn d-block text-center">Girls</a>
      </div>
  </div>
</center>

@endsection