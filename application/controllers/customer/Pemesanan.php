<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') === null) {
            redirect('auth');
        }
        $this->load->model('Pemesanan_model');
    }

    public function index()
    {
        view_customer('customer/pemesanan');
    }

    public function order()
    {
        if ($this->input->post('namaPemesan') != null || $this->input->post('namaPemesan') != "") {
            $data = $this->Pemesanan_model->create_order();
            echo json_encode($data);
        }
    }
}
