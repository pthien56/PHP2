<?php
namespace App\Controllers;
use App\Models\Category;

class CategoryController extends BaseController{
    public $category;
    public function __construct(){
        $this->category = new Category();
    }
    
    // Danh sách danh mục
    public function index(){
        $search = $_GET['search'] ?? '';
        if(!empty($search)){
            $categories = $this->category->searchCategory($search);
        } else {
            $categories = $this->category->getCategory();
        }
        
        // Thêm số lượng sản phẩm cho mỗi danh mục
        foreach($categories as $cat) {
            $cat->product_count = $this->category->countProducts($cat->id);
        }
        
        $this->render('category.list', compact('categories'));
    }
    
    // Trang thêm danh mục
    public function addCategory(){
        $this->render('category.add');
    }
    
    // Lưu danh mục mới
    public function store(){
        $data = [
            'name' => $_POST['name'] ?? '',
            'description' => $_POST['description'] ?? ''
        ];
        
        if($this->category->addCategory($data)){
            header('location: ' . BASE_URL . 'list-category');
        }
    }
    
    // Trang chỉnh sửa danh mục
    public function editCategory($id){
        $category = $this->category->getCategoryById($id);
        $this->render('category.edit', compact('category'));
    }
    
    // Cập nhật danh mục
    public function updateCategory($id){
        $data = [
            'name' => $_POST['name'] ?? '',
            'description' => $_POST['description'] ?? ''
        ];
        
        if($this->category->updateCategory($id, $data)){
            header('location: ' . BASE_URL . 'list-category');
        }
    }
    
    // Xóa danh mục
    public function destroy($id){
        // Kiểm tra danh mục có sản phẩm không
        if($this->category->hasProducts($id)){
            $productCount = $this->category->countProducts($id);
            $message = "Không thể xóa danh mục này vì vẫn còn {$productCount} sản phẩm thuộc danh mục này. Vui lòng xóa hoặc chuyển các sản phẩm sang danh mục khác trước.";
            
            // Redirect với thông báo lỗi
            $_SESSION['error_message'] = $message;
            header('location: ' . BASE_URL . 'list-category?error=1');
            exit;
        }
        
        // Xóa danh mục nếu không có sản phẩm
        if($this->category->deleteCategory($id)){
            $_SESSION['success_message'] = "Xóa danh mục thành công!";
            header('location: ' . BASE_URL . 'list-category?success=1');
        } else {
            $_SESSION['error_message'] = "Có lỗi xảy ra khi xóa danh mục!";
            header('location: ' . BASE_URL . 'list-category?error=1');
        }
    }
}
?>
