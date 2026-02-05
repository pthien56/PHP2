<?php
namespace App\Controllers;
use App\Models\Product;

class ProductController extends BaseController{
    public $product;
    public $category;
    
    public function __construct(){
        $this->product = new Product();
        $this->category = new \App\Models\Category();
    }
    
    // Danh sách sản phẩm
    public function index(){
        $search = $_GET['search'] ?? '';
        if(!empty($search)){
            $products = $this->product->searchProduct($search);
        } else {
            $products = $this->product->getProduct();
        }
        $this->render('product.list', compact('products'));
    }
    
    // Trang thêm sản phẩm
    public function addProduct(){
        $categories = $this->category->getCategory();
        $this->render('product.add', compact('categories'));
    }
    
    // Lưu sản phẩm mới
    public function store(){
        $data = [
            'name' => $_POST['name'] ?? '',
            'price' => $_POST['price'] ?? 0,
            'category_id' => $_POST['category_id'] ?? null
        ];
        
        // Xử lý upload ảnh
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $uploadDir = 'public/uploads/';
            $fileName = time() . '_' . $_FILES['image']['name'];
            $uploadPath = $uploadDir . $fileName;
            
            // Kiểm tra định dạng file
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if(in_array($_FILES['image']['type'], $allowedTypes)) {
                if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    $data['image'] = $fileName;
                }
            }
        }
        
        if($this->product->addProduct($data)){
            header('location: ' . BASE_URL . 'list-product');
        }
    }
    
    // Chi tiết sản phẩm
    public function detail($id){
        $product = $this->product->getProductById($id);
        $this->render('product.detail', compact('product'));
    }
    
    // Trang chỉnh sửa sản phẩm
    public function editProduct($id){
        $product = $this->product->getProductById($id);
        $categories = $this->category->getCategory();
        $this->render('product.edit', compact('product', 'categories'));
    }
    
    // Cập nhật sản phẩm
    public function updateProduct($id){
        $data = [
            'name' => $_POST['name'] ?? '',
            'price' => $_POST['price'] ?? 0,
            'category_id' => $_POST['category_id'] ?? null
        ];
        
        // Xử lý upload ảnh mới (nếu có)
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $uploadDir = 'public/uploads/';
            $fileName = time() . '_' . $_FILES['image']['name'];
            $uploadPath = $uploadDir . $fileName;
            
            // Kiểm tra định dạng file
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if(in_array($_FILES['image']['type'], $allowedTypes)) {
                if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
                    $data['image'] = $fileName;
                    
                    // Xóa ảnh cũ nếu có
                    $oldProduct = $this->product->getProductById($id);
                    if(!empty($oldProduct) && !empty($oldProduct[0]->image)) {
                        $oldImagePath = 'public/uploads/' . $oldProduct[0]->image;
                        if(file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }
            }
        }
        
        if($this->product->updateProduct($id, $data)){
            header('location: ' . BASE_URL . 'list-product');
        }
    }
    
    // Xóa sản phẩm
    public function destroy($id){
        // Lấy thông tin sản phẩm trước khi xóa để xóa ảnh
        $product = $this->product->getProductById($id);
        
        if($this->product->deleteProduct($id)){
            // Xóa ảnh nếu có
            if(!empty($product) && !empty($product[0]->image)) {
                $imagePath = 'public/uploads/' . $product[0]->image;
                if(file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            header('location: ' . BASE_URL . 'list-product');
        }
    }
}
?>