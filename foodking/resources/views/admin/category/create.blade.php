@extends('index')

@section('container')
<div class="container mt-2">
  
  <div class="d-flex justify-content-center items-center flex-col">    
    <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data" class="w-50 border p-3">
        @method('POST')
        @csrf
        <div>
            <h3>Thêm mới danh mục</h3>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-3">
            <label for="danhmuc" class="form-label">Tên</label>
            <input type="text" class="form-control" id="danhmuc" name="name">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Ảnh</label>
            <input class="form-control" type="file" name="img">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{route('categories.index')}}" class="btn btn-danger">Trở lại</a>
    </form>
  </div>
</div>
@endsection