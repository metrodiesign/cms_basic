<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    public function _remap($method, $params = array())
	{
        $method = str_replace('_', '-', $method);

        if (empty($method)) {
        	$method = 'index';
        }

        if (method_exists($this, $method)) 
        {
        	return call_user_func_array(array($this, $method), $params);
        } 
        else 
        {
        	redirect('error_404', 'refresh');
        }
	}

	public function index()
	{
		$this->load->library('frontend/product/product');

		$data['base_url'] = base_url();
		$data['product'] = $this->product->get_product();

		$this->load->view('frontend/admin/admin_message', $data);
	}

	public function login()
	{
		$data['base_url'] = base_url();

		$this->load->view('frontend/admin/login_message', $data);
	}

	public function logout()
	{
		$this->load->controller('frontend/product/product');

		$data['base_url'] = base_url();
		$data['product'] = $this->product->get_product();

		$this->load->view('frontend/admin/logout_message', $data);
	}
}
