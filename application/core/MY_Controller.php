<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	protected $data = array();

	public function __construct()
	{
		parent::__construct();

		// Declare variable Global Assets URL
		$this->data['theme_global_url'] = base_url($this->config->item('default_theme_global_url'));

		// Declare variable Backend URL
		$this->data['backend_url'] = rtrim(base_url() . $this->config->item('default_route_backend'), '/') . '/';

		// Meta charset
		$this->data['charset'] = (!empty($this->config->item('charset'))) ? $this->config->item('charset') : 'UTF-8';

		// Protection
		$this->output->set_header('X-Content-Type-Options: nosniff');
		$this->output->set_header('X-Frame-Options: DENY');
		$this->output->set_header('X-XSS-Protection: 1; mode=block');
	}
}

class Backend extends MY_Controller {
	public function __construct() {
		parent::__construct();

		// Theme
		$this->data['theme'] = (!empty($this->config->item('default_theme_backend'))) ? $this->config->item('default_theme_backend') : 'default';
		$this->data['theme_url'] = base_url($this->config->item('default_theme_backend_url'));
	}

	public function render() {
		// Render template
		$this->load->view('backend/_theme/template', $this->data);
	}
}