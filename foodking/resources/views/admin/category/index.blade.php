@extends('index')

@section('container')
<div class="container mt-2">
  <div>
    <h1>Danh mục</h1>
    <a href="{{route('categories.create')}}" class="btn btn-danger">Thêm mới</a>
  </div>
  <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Tên</th>
            <th scope="col">Ảnh</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($categories as $item)
            <tr>
              <th scope="row">{{$item->id}}</th>
              <td>{{$item->name}}</td>
              <td>
                @if($item->img && Storage::exists($item->img))
                  <img src="{{asset('storage/' . $item->img)}}" alt="" width="100">
                @endif
              </td>
              <td>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" disabled  @if($item->is_active) checked  @endif>
                </div>
              </td>
              <td>
                <a href="{{route('categories.edit', $item->id)}}" class="btn btn-secondary">Sửa</a>
                <a href="{{route('categories.destroy', $item->id)}}" class="btn btn-danger">Xoá</a>
              </td>
            </tr>    
            
          @endforeach
                   
          </tbody>
  </table>
</div>
@endsection