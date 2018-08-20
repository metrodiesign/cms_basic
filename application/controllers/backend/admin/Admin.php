<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Backend {
	private $error = array();
	private $limit_page = 5;

	public function __construct() {
        parent::__construct();
    }

	public function index() {
		$this->render();
	}
}