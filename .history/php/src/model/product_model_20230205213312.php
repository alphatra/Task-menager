<?php 
class productModel{
    private $conn;
    public $product_name;
    public $product_description;
    public $product_image;
    public $category_id;

    public function __construct($product_name, $product_description, $product_image, $category_id) {
        $this->product_name = $product_name;
        $this->product_description = $product_description;
        $this->product_image = $product_image;
        $this->category_id = $category_id;
    }

    public function getName() {
        return $this->product_name;
    }

    public function getDescription() {
        return $this->product_description;
    }

    public function getImage() {
        return $this->product_image;
    }

    public function getCategory() {
        return $this->category_id;
    }
    public function createProduct($product_name, $product_description, $product_image, $category_id) {
        $product_name = $this->getName();
        $product_description = $this->getDescription();
        $product_image = $this->getImage();
        $category_id = $this->getCategory();
        
        $stmt = $this->conn->prepare('INSERT INTO products (product_name, product_description, product_image, category_id) VALUES (:product_name, :product_description, :product_image, :category_id)');
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':product_description', $product_description);
        $stmt->bindParam(':product_image', $product_image);
        $stmt->bindParam(':category_id', $category_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function test() {
        return getName();
    }

    public function returnObject() {
        return json_encode(get_object_vars($this));
    }
    /*
    {
        id_product: ,
        product_name: 'Product 1',
        product_description: 'Description of product 1',
        product_image: 'product1.jpg'
    }
    */

}
?>