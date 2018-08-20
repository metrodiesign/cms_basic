<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	private $tables = array();
	private $column_order = array(null, 'email', 'name', null, null, null, null);
    private $column_search = array('email', 'name');
    private $order = array('id' => 'desc');

	public function __construct()
	{
		parent::__construct();

		$this->tables['admin_users'] = 'admin_users';
	}

	private function _query_users($data = array()) {
        $this->db->from($this->tables['admin_users']);

        $i = 0;
        foreach ($this->column_search as $item) {
            if (isset($data['search']['value'])) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $data['search']['value']);
                } else {
                    $this->db->or_like($item, $data['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }

            $i++;
        }

        if (isset($data['order'])) {
            $this->db->order_by($this->column_order[$data['order']['0']['column']], $data['order']['0']['dir']);
        } elseif ($this->order != '') {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_admins($data = array()) 
    {
        $this->_query_users($data);

        if (isset($data['start']) || isset($data['limit'])) 
        {
            if ($data['start'] < 0) 
            {
                $data['start'] = 0;
            }

            if ($data['length'] < 1) 
            {
                $data['length'] = 20;
            }

            $this->db->limit($data['length'], $data['start']);
        }
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return 0;
        }
    }

    public function get_filter_total_admins($data = array()) 
    {
        $this->_query_users($data);

        if (isset($data['start']) || isset($data['limit'])) 
        {
            if ($data['start'] < 0) 
            {
                $data['start'] = 0;
            }

            if ($data['length'] < 1) 
            {
                $data['length'] = 20;
            }

            $this->db->limit($data['length'], $data['start']);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_total_admins() {
        $this->db->from($this->tables['admin_users']);
        return $this->db->count_all_results();
    }

	public function get_info($id = NULL)
	{
		if (!empty($id))
		{
			$user = $this->admin_ion_auth->user($id)->row();

			if ($user)
			{
				$data['id']         = $user->id;
				$data['ipaddress']  = $user->ip_address;
				$data['username']   = !empty($user->username) ? htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8') : NULL;
				$data['email']      = $user->email;
				$data['created_on'] = $user->created_on;
				$data['lastlogin']  = !empty($user->last_login) ? $user->last_login : NULL;
				$data['active']     = $user->active;
				$data['firstname']  = !empty($user->first_name) ? htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8') : NULL;
				$data['lastname']   = !empty($user->last_name) ? htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8') : NULL;
				$data['company']    = !empty($user->company) ? htmlspecialchars($user->company, ENT_QUOTES, 'UTF-8') : NULL;
				$data['phone']      = !empty($user->phone) ? $user->phone : NULL;

				if (!empty($data['firstname']) && !empty($data['lastname']))
				{
					$data['fullname'] = $data['firstname'] . ' ' . $data['lastname'];
				}
				elseif (!empty($data['firstname']) && empty($data['lastname']))
				{
					$data['fullname'] = $data['firstname'];
				}
				elseif (empty($data['firstname']) && ! empty($data['lastname']))
				{
					$data['fullname'] = $data['lastname'];
				}
				else
				{
					$data['fullname'] = NULL;
				}

				return $data;
			}
		}
	}
}
