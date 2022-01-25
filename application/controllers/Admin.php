<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') === null) {
            redirect('auth/admin');
        }
        $this->load->model('order_model');
    }

    public function index()
    {
        view_admin('admin/dashboard');
    }
}
