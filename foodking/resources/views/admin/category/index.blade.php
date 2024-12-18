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
                <div class="d-flex gap-1">
                <a href="{{route('categories.edit', $item->id)}}" class="btn btn-secondary">Sửa</a>
                @if($item->is_active)
                <form action="{{route('categories.destroy', $item->id)}}" method="POST"  onclick="return confirm('Bạn có chắc muốn xoá không?')"> @method('DELETE')  @csrf <button type="submit" class="btn btn-danger">Xoá</button> </form>
                @endif
              </div>
              </td>
            </tr>    
            
          @endforeach
                   
          </tbody>
  </table>
  {{ $categories->links() }}
</div>
@endsection