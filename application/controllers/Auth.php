<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->helper('Cookie');
    }

    public function index()
    {
        $this->load->view('auth/user');
    }

    public function admin()
    {
        $this->load->view('auth/admin');
    }

    public function register()
    {
        $this->load->view('auth/register');
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Username', 'required|trim', [
            'required' => 'Email cannot be empty!!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required' => 'Password cannot be empty!!'
        ]);

        if ($this->form_validation->run() == false) {
            if ($this->input->post('adminpage') != null || $this->input->post('adminpage') != "") {
                $this->admin();
            } else {
                $this->index();
            }
        } else {
            $data = array("result" => $this->auth_model->doLogin());
            echo json_encode($data);
        }
    }

    public function signin()
    {
        $this->form_validation->set_rules('email', 'Email', 'is_unique[user.email]');
        if ($this->form_validation->run() == false) {
            $data["result"] = "exist";
            echo json_encode($data);
        } else {
            $data = $this->auth_model->signin();
            echo json_encode($data);
        }
    }

    public function logout()
    {
        $this->auth_model->doLogout();
        redirect('auth');
    }
}
