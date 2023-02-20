<?php 
class productModel{
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

    public function test() {
        $product_name = $this->getName();
        $product_description = $this->getDescription();
        $product_image = $this->getImage();
        $category_id = $this->getCategory();
        return $product_name . $product_description . $product_image . $category_id;
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

require_once('CRUD.php');
$db = new db();
if(isset($_POST['search'])){
    $search = $_POST['search'];
    echo $db->searchData($tablename="products",$search="");
}
else{
    echo $db->getData($tablename="products");
}/*
$produkt = new productModel("test", "test", "test", "1");
$produkt = $produkt->returnObject();
echo $produkt;

$parameters = $db->fetchData($produkt);
//echo $parameters;
echo $db->createProduct($parameters);*/
?>