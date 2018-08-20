<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Backend {

	public function __construct()
    {
        parent::__construct();

        $this->load->model('admin_model');
    }

	public function index()
	{
		$this->load->library('backend/product/product');

		$data['base_url'] = base_url();
		$data['product'] = $this->product->get_product();

		$this->load->view('backend/admin/admin_message', $data);
	}

	public function lists()
	{
		$data['base_url'] = base_url();

		$this->data['subtitle'] = $this->lang->line('dashboard');

		$per_page = 5;

		if ($this->input->get('page', true) != '') 
		{
			if ($this->input->get('page', true) >= 1) 
			{
				$page = $this->input->get('page', true);
			}
			else
			{
				$page = 1;
			}
		}
		else
		{
			$page = 1;
		}

		$admin_counts = $this->admin_model->get_admin_counts();
		// Calculate the total number of pages
		$total_pages = (int)ceil($admin_counts / $per_page);

		if ($page > $total_pages) 
		{
			$page = $total_pages;
		}
		
		$start_length = ($page == 1 ? 0 : (int)($page - 1) * $per_page);

		$filters = array(
			'length' => $per_page,
			'start' => $start_length
		);

		$admin_temps = $this->admin_model->get_admins($filters);
		$filter_admin_counts = $this->admin_model->get_filter_admin_counts($filters);
		
		$begin_point_result = ($page == 1 ? 1 : (int)(($page - 1) * $per_page) + 1);
		$end_point_result = ($filter_admin_counts == 1 ? (int)($filter_admin_counts) : (int)($begin_point_result + $filter_admin_counts) - 1);

        $this->data['admin_results'] = array();
        $this->data['page'] = $page;
        $this->data['filter_admin_counts'] = $filter_admin_counts;
        $this->data['admin_counts'] = $admin_counts;
        $this->data['total_pages'] = $total_pages;
        $this->data['begin_point_result'] = $begin_point_result;
        $this->data['end_point_result'] = $end_point_result;

        if (!empty($admin_temps)) {
        	$obj_date = new DateTime;

        	foreach ($admin_temps as $row) {

        		$name = null;
        		$status = null;
        		$created_date = null;

        		if (!empty($row['first_name']) && !empty($row['last_name']))
				{
					$name = $row['first_name'] . ' ' . $row['last_name'];
				}
				elseif (!empty($row['first_name']) && empty($row['last_name']))
				{
					$name = $row['first_name'];
				}
				elseif (empty($row['first_name']) && ! empty($row['last_name']))
				{
					$name = $row['last_name'];
				}
				else
				{
					$name = null;
				}

        		if ($row['active'] == 1) {
        			$status = '<span class="label label-success">Activated</span>';
        		} else {
        			$status = '<span class="label label-default">Unactivated</span>';
        		}

        		$obj_date->setTimestamp($row['created_on']); 
				$created_date = $obj_date->format('d/m/Y H:i:s');

        		$this->data['admin_results'][] = array(
        			'id' => $row['id'],
        			'email' => $row['email'],
        			'name' => $name,
        			'status' => $status,
        			'date' => $created_date,
        			'edit' => $this->data['backend_url'] . 'admin/admin/edit?id=' . $row['id'],
        		);
            }
        }

        $this->data['btn_add'] = $this->data['backend_url'] . 'admin/admin/add';
        $this->data['btn_cancel'] = $this->data['backend_url'] . 'admin/admin/lists';

		$this->data['page_content'] = 'backend/admin/admin_list';
		$this->render();
	}

	public function add()
	{
		$data['base_url'] = base_url();

		$this->data['subtitle'] = $this->lang->line('dashboard');

		$this->data['btn_cancel'] = $this->data['backend_url'] . 'admin/admin/lists';

		$this->data['groups'] = $this->admin_ion_auth->groups()->result();

		$this->data['group_id'] = $this->input->post('group_id', TRUE);
		$this->data['first_name'] = $this->input->post('first_name', TRUE);
		$this->data['last_name'] = $this->input->post('last_name', TRUE);
		$this->data['email'] = strtolower($this->input->post('email', TRUE));
		$this->data['phone'] = $this->input->post('phone', TRUE);
		$this->data['password'] = $this->input->post('password', TRUE);
		$this->data['confirm_password'] = $this->input->post('confirm_password', TRUE);

		if ($this->input->post()) 
		{
			$table_ion_auth  = $this->config->item('admin_tables', 'admin_ion_auth');

			$this->form_validation->set_rules('group_id', 'Group', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[' . $table_ion_auth['users'] . '.email]');
			$this->form_validation->set_rules('first_name', 'First_name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last_name', 'trim|required');
			$this->form_validation->set_rules('phone', 'Phone', 'trim');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'admin_ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'admin_ion_auth') . ']|matches[confirm_password]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');

			if ($this->form_validation->run() === TRUE)
			{
				$email = $this->data['email'];
				$identity = $this->data['email'];
				$password = $this->data['password'];
				$group_id = $this->data['group_id'];

				$additional_data = array(
					'first_name' => $this->data['first_name'],
					'last_name' => $this->data['last_name'],
					'phone' => $this->data['phone']
				);

				$group_data = array(
					'group_id' => $this->data['group_id']
				);

				$this->admin_ion_auth->register($identity, $password, $email, $additional_data, $group_data);

				redirect($this->data['backend_url'] . 'admin/admin/lists', 'refresh');
			}
			else
			{
				$this->data['message_title'] = 'Unsuccessfully';
				$this->data['message_type'] = 'error';
				$this->data['message'] = (validation_errors()) ? json_encode(validation_errors('<p class="text-danger no-margin-top no-margin-left no-margin-right mb-5">', '</p>')) : '';

				$this->data['page_content'] = 'backend/admin/admin_form_add';
				$this->render();
			}
		}
		else
		{
			$this->data['page_content'] = 'backend/admin/admin_form_add';
			$this->render();
		}
	}

	public function edit()
	{
		$id = $this->input->get('id', TRUE);

		if (empty($id) || !is_numeric($id)) 
		{
			redirect($this->data['backend_url'] . 'admin/admin/lists', 'refresh');
		}

		$this->data['id'] = $id;

		$this->data['subtitle'] = $this->lang->line('dashboard');

		$this->data['btn_cancel'] = $this->data['backend_url'] . 'admin/admin/lists';

		$this->data['groups'] = $this->admin_ion_auth->groups()->result();

		if ($this->input->post()) 
		{
			$table_ion_auth  = $this->config->item('admin_tables', 'admin_ion_auth');

			$this->data['group_id'] = $this->input->post('group_id', TRUE);
			$this->data['email'] = $this->input->post('email', TRUE);
			$this->data['first_name'] = $this->input->post('first_name', TRUE);
			$this->data['last_name'] = $this->input->post('last_name', TRUE);
			$this->data['phone'] = $this->input->post('phone', TRUE);
			$this->data['password'] = $this->input->post('password', TRUE);
			$this->data['confirm_password'] = $this->input->post('confirm_password', TRUE);

			$this->form_validation->set_rules('group_id', 'Group', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique_update[' . $table_ion_auth['users'] . '.email.'. $id .']', array('is_unique_update' => 'The %s field must contain a unique value.'));
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('phone', 'Phone', 'trim');

			if (!empty($this->data['password'])) 
			{
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'admin_ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'admin_ion_auth') . ']|matches[confirm_password]');
				$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$update_data = array(
					'first_name' => $this->data['first_name'],
					'last_name' => $this->data['last_name'],
					'phone' => $this->data['phone']
				);

				$this->admin_ion_auth->update($id, $update_data);

				$this->data['message_title'] = 'Successfully';
				$this->data['message_type'] = 'success';
				$this->data['message'] = ($this->admin_ion_auth->messages()) ? json_encode($this->admin_ion_auth->messages()) : '';

				$this->data['page_content'] = 'backend/admin/admin_form_edit';
				$this->render();
			}
			else
			{
				$this->data['message_title'] = 'Unsuccessfully';
				$this->data['message_type'] = 'error';
				$this->data['message'] = (validation_errors()) ? json_encode(validation_errors('<p class="no-margin-top no-margin-left no-margin-right mb-5">', '</p>')) : '';

				$this->data['page_content'] = 'backend/admin/admin_form_edit';
				$this->render();
			}
		}
		else
		{
			$user = $this->admin_ion_auth->user($id)->row();

			$this->data['email'] = $user->email;
			$this->data['first_name'] = $user->first_name;
			$this->data['last_name'] = $user->last_name;
			$this->data['phone'] = $user->phone;

			$this->data['page_content'] = 'backend/admin/admin_form_edit';
			$this->render();
		}
	}

	public function get_admin_datatable_json() {
        $admin_temp = $this->admin_model->get_admins($this->input->post(NULL, TRUE));
        $filter_admin_counts = $this->admin_model->get_filter_admin_counts($this->input->post(NULL, TRUE));
        $admin_counts = $this->admin_model->get_admin_counts();
        $admin_results = array();

        if (!empty($admin_temp)) {
        	foreach ($admin_temp as $row) {
        		$admin_results[] = array(
        			'checkbox' => '<input type="checkbox" class="styled">',
        			'email' => htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'),
        			'name' => htmlspecialchars($row['first_name'], ENT_QUOTES, 'UTF-8'),
        			'status' => htmlspecialchars($row['active'], ENT_QUOTES, 'UTF-8'),
        			'date' => htmlspecialchars($row['created_on'], ENT_QUOTES, 'UTF-8'),
        			'id' => htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'),
        			'action' => '',
        		);
            }
        }

        $datatable_json = array(
            "draw"            => $this->input->post('draw', TRUE),
            "recordsTotal"    => $admin_counts,
            "recordsFiltered" => $filter_admin_counts,
            "data"            => $admin_results
        );
        unset($admin_temp);

        return $this->output
            ->set_content_type('json')
            ->set_output(json_encode($datatable_json));
    }
}
