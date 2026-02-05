@extends('layout.main');
@section('content')
<div class="row">
    <div class="col-12">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-box"></i> Quản lý sản phẩm</h2>
            <a href="{{ route('list-category') }}" class="btn btn-outline-info">
                <i class="bi bi-tags"></i> Quản lý danh mục
            </a>
        </div>

        <!-- Search Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Tìm kiếm sản phẩm..." 
                               value="{{ $_GET['search'] ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-search"></i> Tìm kiếm
                        </button>
                        @if(isset($_GET['search']) && $_GET['search'] != '')
                            <a href="{{ route('list-product') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Xóa bộ lọc
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Button -->
        <div class="mb-3">
            <a href="{{ route('add-product') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Thêm sản phẩm
            </a>
        </div>

        <!-- Products Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Loại</th>
                                <th>Giá</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($products) > 0)
                                @foreach ($products as $pr)
                                <tr>
                                    <td>{{ $pr->id }}</td>
                                    <td>
                                        @if(isset($pr->image) && $pr->image)
                                            <img src="public/uploads/{{ $pr->image }}" alt="{{ $pr->name }}" 
                                                 class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light border rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 60px; height: 60px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $pr->name }}</td>
                                    <td>
                                        @if(isset($pr->category_name) && $pr->category_name)
                                            <span class="badge bg-primary">{{ $pr->category_name }}</span>
                                        @else
                                            <span class="badge bg-secondary">Chưa phân loại</span>
                                        @endif
                                    </td>
                                    <td><strong class="text-success">{{ number_format($pr->price, 0, ',', '.') }} đ</strong></td>
                                    <td class="text-center">
                                        <a href="{{ route("edit-product/{$pr->id}") }}" class="btn btn-warning btn-sm me-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route("delete-product/{$pr->id}") }}" 
                                           onclick="return confirm('Bạn có chắc muốn xóa?');" 
                                           class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-1"></i>
                                    <p class="mt-2">Không có sản phẩm nào</p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection