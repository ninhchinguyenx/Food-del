@extends('index') @section('container')
<div class="container mt-2">
    <div class="d-flex justify-content-center items-center flex-col">
        <form action="{{route('products.update', $product)}}" method="post" enctype="multipart/form-data"
            class="border p-3">
            @method('PATCH') @csrf
            <div>
                <h3>
                    <span class="badge text-bg-secondary">Sửa sản phẩm</span>
                </h3>
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
            <div class="row">
                <div class="col-9">
                    <div class="row">
                        <div class="col-12 mb-1">
                            <label for="ten" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="ten" name="name" value="{{$product->name}}" />
                        </div>
                        <div class="col-6 mb-1">
                            <label for="price_regular" class="form-label">Giá gốc</label>
                            <input type="text" class="form-control" id="price_regular" name="price_regular"
                                value="{{$product->price_regular}}" />
                        </div>
                        <div class="col-6">
                            <label for="price_sale" class="form-label">Giá sale</label>
                            <input type="text" class="form-control" id="price_sale" name="price_sale"
                                value="{{$product->price_sale}}" />
                        </div>
                        <div class="col-6 mb-1">
                            <label for="quantity" class="form-label">Số lượng</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                value="{{$product->quantity}}" />
                        </div>
                        <div class="col-6">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="sku" name="sku" value="{{$product->sku}}" />
                        </div>
                        <div class="col-6">
                            <label for="">Danh mục</label>
                            <select class="form-select" aria-label="Category" name="category">
                                @foreach ($categories as $id => $name)
                                <option value="{{$id}}" @selected($product->
                                    category->id)>{{$name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="">Tags</label>
                            <select class="form-select" multiple aria-label="Multiple select example" name="tags[]">
                                @foreach ($tags as $id => $name)
                                <option value="{{$id}}" @selected(in_array($id , $productTags))>
                                    {{$name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">Tiêu đề</label>
                            <textarea class="form-control" name="detail" rows="7" name="detail">
                  {{$product->detail}}
                  </textarea>
                        </div>
                        <div class="col-6 mb-1">
                            <label for="" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="editor1" name="description">
        {{$product->description}}</textarea>
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label"> Mô tả chi tiết</label>
                            <textarea class="form-control" id="editor2" name="more_details">
        {{$product->more_details}}</textarea>
                        </div>
        
                        <div class="col-12 mb-1">
                           
                        </div>
                        
                    </div>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary mt-2 mb-4">Lưu</button>
                    <a href="{{route('products.index')}}" class="btn btn-danger mt-2 mb-4">Trở lại</a>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Ảnh chính</label>
                        <input class="form-control" type="file" name="img_thumbnail" />
                        @if($product->img_thumbnail)
                        <img src="{{asset('storage/' . $product->img_thumbnail)}}" alt="" width="100" />
                        @endif
                    </div>
                    @foreach ($product->product_gallery as $key => $item)
                        <div class="mb-3" id="image-container">
                            <label for="exampleFormControlTextarea1" class="form-label">Ảnh phụ</label>
                            <div class="input-group">
                                <input class="form-control" type="file" name="img_gallery[{{$item->id}}]" />
                                <button class="btn btn-primary" onclick="addImageInput()" type="button">
                                    +
                                </button>
                            </div>
                        </div>
                        @if($item->img && Storage::exists($item->img))
                        <img src="{{asset('storage/' . $item->img)}}" alt="" style="width: 100px" />
                        @endif @endforeach
                </div>
            </div>
            
     
        </form>
    </div>
</div>
@endsection @section('scripts-libs') @section('css-libs')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
<script>
    function addImageInput() {
        // Lấy phần tử gốc
        const container = document.getElementById("image-container");

        // Sao chép phần tử gốc
        const newContainer = container.cloneNode(true);

        // Tìm nút "Thêm" trong phần tử mới và thêm nút "Xóa"
        const addButton = newContainer.querySelector("button");
        addButton.textContent = "Xóa";
        addButton.className = "btn btn-danger";
        addButton.setAttribute("onclick", "removeImageInput(this)");

        // Thêm phần tử mới vào DOM
        container.parentNode.appendChild(newContainer);
    }

    function removeImageInput(button) {
        // Xóa phần tử chứa nút "Xóa"
        button.parentElement.parentElement.remove();
    }
    $(document).ready(function () {
        CKEDITOR.replace("editor1", {
            height: 100,
            toolbar: [
                {
                    name: "clipboard",
                    items: ["Cut", "Copy", "Paste", "Undo", "Redo"],
                },
                {
                    name: "editing",
                    items: ["Find", "Replace", "SelectAll"],
                },
                {
                    name: "basicstyles",
                    items: [
                        "Bold",
                        "Italic",
                        "Underline",
                        "Strike",
                        "RemoveFormat",
                    ],
                },
                {
                    name: "paragraph",
                    items: [
                        "NumberedList",
                        "BulletedList",
                        "-",
                        "Outdent",
                        "Indent",
                        "-",
                        "Blockquote",
                    ],
                },
                {
                    name: "insert",
                    items: ["Image", "Table", "HorizontalRule", "SpecialChar"],
                },
                {
                    name: "tools",
                    items: ["Maximize", "ShowBlocks"],
                },
            ],
        });
        CKEDITOR.replace("editor2", {
            height: 250,
            toolbar: [
                {
                    name: "clipboard",
                    items: ["Cut", "Copy", "Paste", "Undo", "Redo"],
                },
                {
                    name: "editing",
                    items: ["Find", "Replace", "SelectAll"],
                },
                {
                    name: "basicstyles",
                    items: [
                        "Bold",
                        "Italic",
                        "Underline",
                        "Strike",
                        "RemoveFormat",
                    ],
                },
                {
                    name: "paragraph",
                    items: [
                        "NumberedList",
                        "BulletedList",
                        "-",
                        "Outdent",
                        "Indent",
                        "-",
                        "Blockquote",
                    ],
                },
                {
                    name: "insert",
                    items: ["Image", "Table", "HorizontalRule", "SpecialChar"],
                },
                {
                    name: "tools",
                    items: ["Maximize", "ShowBlocks"],
                },
            ],
        });
    });
</script>
@endsection