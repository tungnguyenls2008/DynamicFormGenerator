
@extends('layouts.app')

@section('title', 'Danh sách hồ sơ')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-light">
            <div class="row">
                <h3 class="col-9">Danh sách hồ sơ đã tạo</h3>
                <a href="{{ route('form.index') }}" class="col-3 btn btn-primary">Quay lại</a>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i= 1 ?>
                    @foreach ($formData as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ route('formdata.show', $item->id) }}"><button class="btn btn-primary"> Mở </button></a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
