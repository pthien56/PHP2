<?php
namespace App\Models;

class Category extends BaseModel{
    protected $table = 'categories';
    
    public function getCategory(){
        $sql = "SELECT * FROM {$this->table}";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    
    public function getCategoryById($id){
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows(array($id));
    }
    
    public function addCategory($data){
        $sql = "INSERT INTO {$this->table} (name, description) VALUES (?, ?)";
        $this->setQuery($sql);
        return $this->execute(array($data['name'], $data['description']));
    }
    
    public function updateCategory($id, $data){
        $sql = "UPDATE {$this->table} SET name = ?, description = ? WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute(array($data['name'], $data['description'], $id));
    }
    
    public function deleteCategory($id){
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
    
    public function hasProducts($id){
        $sql = "SELECT COUNT(*) FROM products WHERE category_id = ?";
        $this->setQuery($sql);
        $result = $this->execute([$id]);
        return $result->fetchColumn() > 0;
    }
    
    public function countProducts($id){
        $sql = "SELECT COUNT(*) FROM products WHERE category_id = ?";
        $this->setQuery($sql);
        $result = $this->execute([$id]);
        return $result->fetchColumn();
    }
    
    public function moveProductsToUncategorized($id){
        $sql = "UPDATE products SET category_id = NULL WHERE category_id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
    
    public function searchCategory($search){
        $sql = "SELECT * FROM {$this->table} WHERE name LIKE ? OR description LIKE ?";
        $this->setQuery($sql);
        $searchTerm = "%{$search}%";
        return $this->loadAllRows([$searchTerm, $searchTerm]);
    }
}
?>
