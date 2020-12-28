
@extends('layouts.app')

@section('title', 'Danh sách hồ sơ')

@section('content')
    <div class="card">
        <h3 class="card-header bg-primary text-light"> {{ $form->name}} </h3>
        <div class="card-body">
            {!! $html !!}

        </div>
    </div>
@endsection
