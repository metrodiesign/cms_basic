<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends Backend {
	public function __construct() {
        parent::__construct();
    }

	public function index() {
		$this->render();
	}
}