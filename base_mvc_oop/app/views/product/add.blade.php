@extends('layout.main');
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="bi bi-plus-circle"></i> Thêm sản phẩm mới</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('store-product') }}" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Loại sản phẩm</label>
                        <select id="category_id" name="category_id" class="form-select">
                            <option value="">-- Chọn loại sản phẩm --</option>
                            @if(count($categories) > 0)
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" id="price" name="price" step="0.01" class="form-control" required>
                            <span class="input-group-text">đ</span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Hình ảnh sản phẩm</label>
                        <input type="file" id="image" name="image" accept="image/*" class="form-control">
                        <div class="form-text">Chấp nhận: JPG, JPEG, PNG, GIF (tối đa 5MB)</div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Lưu
                        </button>
                        <a href="{{ route('list-product') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection