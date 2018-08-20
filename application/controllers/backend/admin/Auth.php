<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Authenticate
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		redirect($this->data['backend_url'] . 'admin/auth/login', 'refresh');
	}

	public function login()
	{
		$this->data['subtitle'] = $this->lang->line('login_heading');

		$this->data['login_identity_label'] = $this->lang->line('login_identity_label');
		$this->data['login_password_label'] = $this->lang->line('login_password_label');
		$this->data['login_remember_label'] = $this->lang->line('login_remember_label');
		$this->data['login_submit_btn'] = $this->lang->line('login_submit_btn');
		$this->data['login_forgot_password'] = $this->lang->line('login_forgot_password');

		if (!$this->admin_ion_auth->logged_in()) 
		{
			$this->data['identity'] = $this->input->post('identity', TRUE);
			$this->data['password'] = $this->input->post('password', TRUE);
			$this->data['remember'] = $this->input->post('remember', TRUE);

			if ($this->input->post()) 
			{
				$this->form_validation->set_rules('identity', $this->lang->line('login_identity_label'), 'required');
				$this->form_validation->set_rules('password', $this->lang->line('login_password_label'), 'required');
				$this->form_validation->set_rules('remember', $this->lang->line('login_remember_label'), 'integer');

				if ($this->form_validation->run() == TRUE)
				{
					$remember = (bool)$this->data['remember'];

					if ($this->admin_ion_auth->login($this->data['identity'], $this->data['password'], $this->data['remember']))
					{
						redirect($this->data['backend_url'] . 'admin/admin/index', 'refresh');
					}
					else
					{
						$this->data['message'] = ($this->admin_ion_auth->errors()) ? json_encode($this->admin_ion_auth->errors('<p class="text-danger no-margin-top no-margin-left no-margin-right mb-5">', '</p>')) : '';

						$this->data['page_content'] = 'auth/admin/login';
						$this->render();
					}
				}
				else
				{
					$this->data['message'] = (validation_errors()) ? json_encode(validation_errors('<p class="text-danger no-margin-top no-margin-left no-margin-right mb-5">', '</p>')) : '';

					$this->data['page_content'] = 'auth/admin/login';
					$this->render();
				}
			}
			else
			{
				$this->data['page_content'] = 'auth/admin/login';
				$this->render();
			}
		}
		else
		{
			redirect($this->data['backend_url'] . 'admin/admin/index', 'refresh');
		}
	}

	public function logout()
	{
		$logout = $this->admin_ion_auth->logout();

		redirect($this->data['backend_url'] . 'admin/auth/login', 'refresh');
	}
}