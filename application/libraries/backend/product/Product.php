<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product {

    protected $CI;
        
    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function get_product()
    {
        return 'application/libraries/backend/product/Product.php';
    }
}