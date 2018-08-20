<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$data['base_url'] = base_url();

		$this->load->view('backend/common/login_message', $data);
	}
}
