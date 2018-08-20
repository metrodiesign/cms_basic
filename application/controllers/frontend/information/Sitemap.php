<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {

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
		$data['base_url'] = base_url();

		$this->load->view('frontend/information/sitemap_message', $data);
	}

	public function get_product()
    {
        echo 'application/controllers/frontend/information/Sitemap.php';
    }
}
