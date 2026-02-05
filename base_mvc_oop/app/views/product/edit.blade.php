@extends('layout.main');
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        @if(count($product) > 0)
        <?php $p = $product[0]; ?>
        <div class="card">
            <div class="card-header">
                <h4><i class="bi bi-pencil"></i> Chỉnh sửa sản phẩm</h4>
            </div>
            <div class="card-body">
                <form action="{{ route("update-product/{$p->id}") }}" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" value="{{ $p->name }}" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Loại sản phẩm</label>
                        <select id="category_id" name="category_id" class="form-select">
                            <option value="">-- Chọn loại sản phẩm --</option>
                            @if(count($categories) > 0)
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ ($p->category_id == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" id="price" name="price" step="0.01" value="{{ $p->price }}" class="form-control" required>
                            <span class="input-group-text">đ</span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Hình ảnh sản phẩm</label>
                        <input type="file" id="image" name="image" accept="image/*" class="form-control">
                        <div class="form-text">Để trống nếu không muốn thay đổi ảnh</div>
                        
                        @if(isset($p->image) && $p->image)
                        <div class="mt-3">
                            <p class="text-muted mb-2">Ảnh hiện tại:</p>
                            <img src="public/uploads/{{ $p->image }}" alt="{{ $p->name }}" 
                                 class="img-thumbnail" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                        </div>
                        @endif
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Cập nhật
                        </button>
                        <a href="{{ route('list-product') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
        @else
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle"></i> Sản phẩm không tồn tại!
        </div>
        @endif
    </div>
</div>
@endsection