<?php
namespace App\Models;

class Product extends BaseModel{
    protected $table = 'products';
    
    public function getProduct(){
        $sql = "SELECT p.*, c.name as category_name FROM {$this->table} p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.id DESC";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
    
    public function getProductById($id){
        $sql = "SELECT p.*, c.name as category_name FROM {$this->table} p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.id = ?";
        $this->setQuery($sql);
        return $this->loadAllRows([$id]);
    }
    
    public function addProduct($data){
        $sql = "INSERT INTO {$this->table} (name, price, category_id, image) VALUES (?, ?, ?, ?)";
        $this->setQuery($sql);
        return $this->execute([$data['name'], $data['price'], $data['category_id'] ?? null, $data['image'] ?? null]);
    }
    
    public function updateProduct($id, $data){
        if(isset($data['image'])) {
            $sql = "UPDATE {$this->table} SET name = ?, price = ?, category_id = ?, image = ? WHERE id = ?";
            $this->setQuery($sql);
            return $this->execute([$data['name'], $data['price'], $data['category_id'] ?? null, $data['image'], $id]);
        } else {
            $sql = "UPDATE {$this->table} SET name = ?, price = ?, category_id = ? WHERE id = ?";
            $this->setQuery($sql);
            return $this->execute([$data['name'], $data['price'], $data['category_id'] ?? null, $id]);
        }
    }
    
    public function deleteProduct($id){
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $this->setQuery($sql);
        return $this->execute([$id]);
    }
    
    public function searchProduct($search){
        $sql = "SELECT p.*, c.name as category_name FROM {$this->table} p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.name LIKE ? OR c.name LIKE ?";
        $this->setQuery($sql);
        $searchTerm = "%{$search}%";
        return $this->loadAllRows([$searchTerm, $searchTerm]);
    }
}
?>