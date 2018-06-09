<?php

class Index extends Controller {

    public static function getFilterProducts($filterValue) {

        $db = DB::getInstance();
        $sql = "SELECT * FROM products where p_name like '%{$filterValue}%'";

        $result = $db->query($sql);

        $listProducts = array();


        foreach ($db->results() as $row) {
            $product = new Product();
            $product->setId($row->{'id'});
            $product->setName($row->{'p_name'});
            $product->setImage($row->{'image'});
            $product->setPrice($row->{'price'});

            array_push($listProducts, $product);
        }

        return $listProducts;
    }

    public static function getProducts() {
        $db = DB::getInstance();
        $sql = 'SELECT * FROM products';
        $result = $db->query($sql);

        $listProducts = array();


        foreach ($db->results() as $row) {
            $product = new Product();
            $product->setId($row->{'id'});
            $product->setName($row->{'p_name'});
            $product->setImage($row->{'image'});
            $product->setPrice($row->{'price'});

            array_push($listProducts, $product);
        }

        return $listProducts;
    }

}

?>