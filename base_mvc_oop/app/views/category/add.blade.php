@extends('layout.main');
@section('content')
<h2>Thêm danh mục mới</h2>

<form action="{{ route('store-category') }}" method="POST" style="max-width: 500px; margin: 20px 0;">
    <div style="margin-bottom: 15px;">
        <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">Tên danh mục:</label>
        <input type="text" id="name" name="name" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
    </div>
    
    <div style="margin-bottom: 15px;">
        <label for="description" style="display: block; margin-bottom: 5px; font-weight: bold;">Mô tả:</label>
        <textarea id="description" name="description" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;"></textarea>
    </div>
    
    <div style="margin-bottom: 15px;">
        <button type="submit" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 3px; cursor: pointer; margin-right: 10px;">Lưu</button>
        <a href="{{ route('list-category') }}" style="padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 3px; display: inline-block;">Hủy</a>
    </div>
</form>
@endsection
