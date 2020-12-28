
@extends('layouts.app')

@section('title', 'Danh sách hồ sơ')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-light">
            <div class="row">
                <h3 class="col-9">Danh sách hồ sơ</h3>
                <a href="{{ route('form.create') }}" class="col-3 btn btn-primary">Tạo mới hồ sơ</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên hồ sơ</th>
                        <th>Thông tin</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i= 1 ?>
                    @foreach ($form as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->info }}</td>
                            <td>
                                <a href="{{ route('showform.show', $item->id) }}"><button class="btn btn-primary"> Thêm mới dữ liệu </button></a>
                                <a href="{{ route('showform.index', ['id' => $item->id]) }}"><button class="btn btn-primary"> Dữ liệu đã tạo </button></a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
