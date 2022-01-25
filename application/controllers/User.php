<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') === null) {
            redirect('auth/admin');
        }
        $this->load->model('User_model');
    }

    public function index()
    {
        view_admin('admin/user');
    }

    public function getdata()
    {
        $column_order = array('id', 'user_name', 'email', null);
        $column_search = array('id', 'user_name', 'email');
        $order = array('id' => 'desc');
        $status = 1;

        $list = $this->User_model->get_datatables($column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $row = array();
            $row[] = '<div class="text-center">' . $no . '</div>';
            $row[] = $result->user_name;
            $row[] = $result->email;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->User_model->count_all(),
            "recordsFiltered" => $this->User_model->count_filtered($column_order, $column_search, $order),
            "data" => $data,
        );
        echo json_encode($output);
    }
}
