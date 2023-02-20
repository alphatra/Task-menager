<?php
class ListModel {
    private $id;
    private $name;
    private $created_date;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
        $this->created_date = date("Y-m-d");
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCreatedDate() {
        return $this->created_date;
    }
}
?>