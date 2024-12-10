@extends('index')

@section('container')
<div class="container mt-2">
  
  <div class="d-flex justify-content-center items-center flex-col">    
    <form action="{{route('tags.store')}}" method="post" class="w-50 border p-3">
        @method('POST')
        @csrf
        <div>
            <h3>Thêm mới #tag</h3>
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
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{route('tags.index')}}" class="btn btn-danger">Trở lại</a>
    </form>
  </div>
</div>
@endsection