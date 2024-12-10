@extends('index')

@section('container')
<div class="container mt-2">
  <div>
    <h1>Sản phẩm</h1>
    <a href="{{route('products.create')}}" class="btn btn-danger">Thêm mới</a>
  </div>
  <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Tên</th>
            <th scope="col">Danh mục</th>
            <th scope="col">Ảnh</th>
            <th scope="col">Giá gốc</th>
            <th scope="col">Giá sale</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Tags</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($products as $item)
            <tr>
              <th scope="row">{{$item->id}}</th>
              <td>{{$item->name}}</td>
              <td>{{$item->category->name}}</td>
              <td>
                @if($item->img_thumbnail && Storage::exists($item->img_thumbnail))
                  <img src="{{asset('storage/' . $item->img_thumbnail)}}" alt="" width="100">
                @endif
              </td>
              <td>
                {{ number_format($item->price_regular, 0, '', '.') }} đ
              </td>
              <td>
                {{ number_format($item->price_sale, 0, '', '.') }} đ
              </td>
              <td>
                <span class="badge text-bg-secondary"> {{ $item->quantity }}</span>    
              </td>
              <td>
                @foreach($item->tags as $tag)
                  <span class="badge bg-secondary">{{ $tag->name }}</span>
                @endforeach 
                    @if($item->tags->count() == 0)
                    <span class="badge bg-secondary">None</span>
                    @endif 
    
              </td>
              <td>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" disabled  @if($item->is_active) checked  @endif>
                </div>
              </td>
              <td>
                <div class="d-flex gap-1">
                <a href="{{route('products.edit', $item->id)}}" class="btn btn-secondary">Sửa</a>
                @if($item->is_active)
                <form action="{{route('products.destroy', $item->id)}}" method="POST"  onclick="return confirm('Bạn có chắc muốn xoá không?')"> @method('DELETE')  @csrf <button type="submit" class="btn btn-danger">Xoá</button> </form>
                @endif
              </div>
              </td>
            </tr>    
            
          @endforeach
                   
          </tbody>
  </table>
  {{ $products->links() }}
</div>
@endsection