<?php 
class productModel{
    private $tablename;
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

    public function returnObject() {
        return json_encode(get_object_vars($this));
    }
}
?>