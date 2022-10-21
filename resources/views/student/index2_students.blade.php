@extends('layouts.parent2')

@section('title', 'All Students')
@section('content')
@include('messages.message')
<center>
    <div class="col-lg-6">
        <div class="create_report_btn mt_30">
            <a href="{{ route('read_m') }}" class="btn_1 radius_btn d-block text-center">Boys</a>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="create_report_btn mt_30">
            <a href="{{ route('read_f') }}" class="btn_1 radius_btn d-block text-center">Girls</a>
        </div>
    </div>
</center>
@endsection