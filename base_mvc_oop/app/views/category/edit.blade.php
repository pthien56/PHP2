@extends('layout.main');
@section('content')
<h2>Chỉnh sửa danh mục</h2>

@if(count($category) > 0)
<?php $c = $category[0]; ?>
<form action="{{ route('update-category/' . $c->id) }}" method="POST" style="max-width: 500px; margin: 20px 0;">
    <div style="margin-bottom: 15px;">
        <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">Tên danh mục:</label>
        <input type="text" id="name" name="name" value="{{ $c->name }}" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">
    </div>
    
    <div style="margin-bottom: 15px;">
        <label for="description" style="display: block; margin-bottom: 5px; font-weight: bold;">Mô tả:</label>
        <textarea id="description" name="description" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">{{ $c->description }}</textarea>
    </div>
    
    <div style="margin-bottom: 15px;">
        <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer; margin-right: 10px;">Cập nhật</button>
        <a href="{{ route('list-category') }}" style="padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 3px; display: inline-block;">Hủy</a>
    </div>
</form>
@else
<p style="color: #dc3545;">Danh mục không tồn tại!</p>
@endif
@endsection
