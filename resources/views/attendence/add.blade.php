@extends('layouts.parent2')
@section('title', 'Add New Attendence Record')
@section('content')
@include('messages.message')
@isset($success1)
{{ $success1 }}
@endisset
<center>
    @foreach ($secs as $sec)
    <div class="col-lg-6">
        <div class="create_report_btn mt_30">
            <a href="{{ route('add_attend',$sec->id) }}"
                class="btn_1 radius_btn d-block text-center">{{ $sec->name }}</a>
        </div>
    </div>
    @endforeach
</center>
@endsection
