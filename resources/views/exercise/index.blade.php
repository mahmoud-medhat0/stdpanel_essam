@extends('layouts.parent2')
@section('title', 'list of exercises')
@section('content')
@include('messages.message')
<center>
    @foreach ($secs as $sec)
    <div class="col-lg-6">
        <div class="create_report_btn mt_30">
            <a href="{{ route('lst_exc',$sec->id) }}" class="btn_1 radius_btn d-block text-center">{{ $sec->name }}</a>
        </div>
    </div>
    @endforeach
</center>
@endsection
