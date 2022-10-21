@extends('layouts.parent2')
@section('title', 'Add New Exam Record')
@section('content')
@include('messages.message')
<div class="col-12" bis_skin_checked="1">
    @isset($success1)
    {{ $success1 }}
    @endisset
    <center>
        <div class="col-lg-6">
            <div class="create_report_btn mt_30">
                <a href="{{ route('add_exm_m') }}" class="btn_1 radius_btn d-block text-center">Boys</a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="create_report_btn mt_30">
                <a href="{{ route('add_exm_f') }}" class="btn_1 radius_btn d-block text-center">Girls</a>
            </div>
        </div>
    </center>
    @endsection