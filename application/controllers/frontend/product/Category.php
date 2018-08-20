<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

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
        	$url_slug = $method;
        	$get_id = 0;

        	if (is_numeric($url_slug)) 
        	{
        		$get_id = $url_slug;
        	}
        	else
        	{
        		$get_id = 11;
        	}

        	if (empty($get_id) || $get_id == 0) 
        	{
        		redirect('error_404', 'refresh');
        	}

        	$this->index($get_id);
        }
	}

	public function index($id)
	{
		$data['base_url'] = base_url();
		$data['id'] = $id;

		$this->load->view('frontend/product/category_message', $data);
	}

	public function get_product()
    {
        echo 'application/controllers/frontend/product/Category.php';
    }
}
