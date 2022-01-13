<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pesanan_model');
    }

    public function index()
    {
        view_admin('admin/pesanan');
    }

    public function getdata()
    {
        $column_order = array('id', 'purchase_code', 'vendor_name', 'purchase_date', 'total_payment', 'status', null);
        $column_search = array('id', 'purchase_code', 'vendor_name', 'purchase_date', 'total_payment', 'status');
        $order = array('id' => 'desc');

        $list = $this->Pesanan_model->get_datatables($column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $result) {
            $no++;
            $row = array();
            $row[] = '<div class="text-center">' . $no . '</div>';
            $row[] = $result->order_number;
            $row[] = $result->customer_name;
            $row[] = $result->phone;
            $row[] = $result->pickup_date;
            $row[] = $result->created_at;
            $row[] = '<div class="text-center">' .
                '<button type="button" class="btn btn-sm btn-input" data-id="' . $result->order_number . '"><i class="fas fa-list text-primary"></i></button>' .
                '<button type="button" class="btn btn-sm btn-cancel" data-id="' . $result->order_number . '"><i class="fas fa-trash text-primary"></i></button>' .
                '</div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Pesanan_model->count_all(),
            "recordsFiltered" => $this->Pesanan_model->count_filtered($column_order, $column_search, $order),
            "data" => $data,
        );
        echo json_encode($output);
    }
}
