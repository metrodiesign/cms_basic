<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$data['base_url'] = base_url();

		$this->load->view('backend/product/product_message', $data);
	}

	public function get_product()
    {
        return 'application/controllers/backend/product/Product.php';
    }
}
