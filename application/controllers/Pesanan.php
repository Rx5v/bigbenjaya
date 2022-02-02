<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') === null) {
            redirect('auth/admin');
        }
        $this->load->model('Pesanan_model');
    }

    public function index()
    {
        view_admin('admin/pesanan');
    }

    public function list()
    {
        view_admin('admin/pesanan_list');
    }

    public function getdata()
    {
        $column_order = array('id', 'order_number', 'customer_name', 'phone', 'pickup_date', 'created_at', null);
        $column_search = array('id', 'order_number', 'customer_name', 'phone', 'pickup_date', 'created_at');
        $order = array('id' => 'desc');
        $status = 1;

        $list = $this->Pesanan_model->get_datatables($column_order, $column_search, $order, $status);
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
            "recordsTotal" => $this->Pesanan_model->count_all($status),
            "recordsFiltered" => $this->Pesanan_model->count_filtered($column_order, $column_search, $order, $status),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function getdatalist()
    {
        $column_order = array('id', 'order_number', 'customer_name', 'phone', 'pickup_date', 'created_at', null);
        $column_search = array('id', 'order_number', 'customer_name', 'phone', 'pickup_date', 'created_at');
        $order = array('id' => 'desc');
        $status = 2;

        $list = $this->Pesanan_model->get_datatables($column_order, $column_search, $order, $status);
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
                '<button type="button" class="btn btn-sm btn-edit" data-id="' . $result->order_number . '"><i class="fas fa-edit text-primary"></i></button>' .
                '<button type="button" class="btn btn-sm btn-print" data-id="' . $result->order_number . '"><i class="fas fa-print text-dark"></i></button>' .
                '<button type="button" class="btn btn-sm btn-cancel" data-id="' . $result->order_number . '"><i class="fas fa-trash text-danger"></i></button>' .
                '</div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Pesanan_model->count_all($status),
            "recordsFiltered" => $this->Pesanan_model->count_filtered($column_order, $column_search, $order, $status),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function prosesOrder()
    {
        $id = $this->input->post('id');

        $data = $this->db->select('a.*, b.car_type,b.car_id,b.driver_id')
            ->from('order_head as a')
            ->join('order_detail as b', 'a.order_number = b.order_number', 'left')
            ->where('a.order_number', $id)
            ->get()
            ->result();

        echo json_encode($data);
    }

    public function dropdownNoPlat()
    {
        $id = $this->input->post('id');
        $list = "";
        $data = $this->db->where('car_type_id', $id)
            ->where('status_id', 1)
            ->get('car')
            ->result();
        foreach ($data as $dt) {
            $list .= '<option value="' . $dt->id . '">' . $dt->plate_number . '</option>';
        }
        $result = array('list' => $list);
        echo json_encode($result);
    }

    public function confirmOrder()
    {
        $data = $this->Pesanan_model->confirm();
        echo json_encode($data);
    }

    public function editOrder()
    {
        $data = $this->Pesanan_model->update();
        echo json_encode($data);
    }

    public function cancelOrder()
    {

        $id = $this->input->post('id');
        $data = array(
            'status' => 3,
        );

        $result = $this->db->where('order_number', $id)
            ->update('order_head', $data);

        echo json_encode($result);
    }

    public function updatecar()
    {
        $id = $this->input->post('id');
        $order = $this->db->where('order_number', $id)
            ->get('order_detail')
            ->result();
        foreach ($order as $od) {
            $car = $od->car_id;
            $driver = $od->driver_id;
        }

        $data = [
            'status_id' => 2,
        ];

        $this->db->where('id', $car);
        $this->db->update('car', $data);

        $this->db->where('id', $driver);
        $this->db->update('driver', $data);
    }

    public function printSuratJalan($id)
    {
        $this->load->library("Pdfgenerator");
        $this->data['data'] = $this->Pesanan_model->surat_jalan($id);
        $this->data['title_pdf'] = 'Surat Jalan';

        $file_pdf = 'Surat Jalan';
        $paper = 'A4';
        $orientation = "portrait";

        $html = $this->load->view('admin/surat_jalan', $this->data, true);

        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
