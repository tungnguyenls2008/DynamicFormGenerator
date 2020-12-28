
@extends('layouts.app')

@section('title', 'Danh sách hồ sơ')

@section('content')
    <style>
        input[type="checkbox"][readonly] {
            pointer-events: none;
        }
    </style>
    <div class="card">
        <div class="card-header bg-primary text-light">
            <div class="row">
                <h3 class="col-9">{{ $form->name }}</h3>
                <a href="{{ route('showform.index', ['id' => $form->id]) }}" class="col-3 btn btn-primary">Quay lại</a>
            </div>
        </div>

        <div class="card-body">
            {!! $html !!}
        </div>
    </div>
@endsection
