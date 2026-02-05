@extends('layout.main');
@section('content')
<div class="row">
    <div class="col-12">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-tags"></i> Quản lý danh mục</h2>
            <a href="{{ route('list-product') }}" class="btn btn-outline-info">
                <i class="bi bi-box"></i> Quản lý sản phẩm
            </a>
        </div>

        <!-- Thông báo -->
        @if(isset($_SESSION['success_message']))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> <strong>Thành công!</strong> {{ $_SESSION['success_message'] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        @endif

        @if(isset($_SESSION['error_message']))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle"></i> <strong>Lỗi!</strong> {{ $_SESSION['error_message'] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        @endif

        <!-- Search Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control" 
                               placeholder="Tìm kiếm danh mục..." 
                               value="{{ $_GET['search'] ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-search"></i> Tìm kiếm
                        </button>
                        @if(isset($_GET['search']) && $_GET['search'] != '')
                            <a href="{{ route('list-category') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Xóa bộ lọc
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Button -->
        <div class="mb-3">
            <a href="{{ route('add-category') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Thêm danh mục
            </a>
        </div>

        <!-- Categories Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Mô tả</th>
                                <th class="text-center">Số sản phẩm</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($categories) > 0)
                                @foreach ($categories as $cat)
                                <tr>
                                    <td>{{ $cat->id }}</td>
                                    <td>{{ $cat->name }}</td>
                                    <td>{{ substr($cat->description, 0, 50) }}@if(strlen($cat->description) > 50)...@endif</td>
                                    <td class="text-center">
                                        <span class="badge bg-success">{{ $cat->product_count }} sản phẩm</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route("edit-category/{$cat->id}") }}" class="btn btn-warning btn-sm me-1">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="{{ route("delete-category/{$cat->id}") }}" 
                                           onclick="return confirm('Bạn có chắc muốn xóa danh mục này?');" 
                                           class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-1"></i>
                                    <p class="mt-2">Không có danh mục nào</p>
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
