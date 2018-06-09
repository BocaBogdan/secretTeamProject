<?php

class Product {

    private $id;
    private $name;
    private $image;
    private $price;

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getImage() {
        return $this->image;
    }

    function getPrice() {
        return $this->price;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setImage($image) {
        $this->image = $image;
    }

    function setPrice($price) {
        $this->price = $price;
    }

}
