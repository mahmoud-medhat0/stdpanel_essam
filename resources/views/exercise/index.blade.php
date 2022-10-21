@extends('layouts.parent2')
@section('title', 'list of exercises')
@section('content')
@include('messages.message')
<div class="row">
    <center>
        <div class="col-md-9">
            @isset($success1)
            {{ $success1 }}
            @endisset
            <center>
              <div class="col-lg-6">
                  <div class="create_report_btn mt_30">
                      <a href="{{ route('lst_exc_m') }}" class="btn_1 radius_btn d-block text-center">Boys</a>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="create_report_btn mt_30">
                      <a href="{{ route('lst_exc_f') }}" class="btn_1 radius_btn d-block text-center">Girls</a>
                  </div>
              </div>
          </center>      
@endsection