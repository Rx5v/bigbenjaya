<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Car extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('user_logged') === null) {
            redirect('auth/admin');
        }
        $this->load->model('car_model');
    }
    public function index()
    {
        view_admin('admin/car');
    }

    function getCarData()
    {
        if ($this->input->is_ajax_request() == true) {
            $list = $this->car_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $field->type;
                $row[] = $field->series;
                $row[] = $field->plate_number;
                $row[] = $field->status;
                $row[] = '<button class="btn btn-sm" onclick="remove(' . $field->id . ')"><i class="fas fa-trash-alt text-danger"></i></button>';
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->car_model->count_all(),
                "recordsFiltered" => $this->car_model->count_filtered(),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Sorry Data cannot display');
        }
    }

    public function car_type()
    {
        view_admin("admin/car_type");
    }

    public function car_series()
    {
        view_admin("admin/car_series");
    }

    function getDataType()
    {
        $query = $this->car_model->getDataType(); // Get Data From Model
        $no = 1;                                // To initialize numbering row table
        $data = "";                             // Variable to save Data

        foreach ($query as $r) {                // Looping data from model

            $data .= '<tr>' .
                '<td>' . $no++ . '</td>' .
                '<td>' . $r->type . '</td>' .
                '<td class="text-center">' . '<button class = "btn btn-sm" onclick="remove(' . $r->id . ')"><i class="fas fa-trash-alt text-danger"></i></button>' . '</td>' .
                '</tr>';
        }
        $result = array("list" => $data); // return data as array named 'list'
        echo json_encode($result); // Return final data 
    }

    function getDataSeries()
    {
        $query = $this->car_model->getDataSeries(); // Get Data From Model
        $no = 1;                                // To initialize numbering row table
        $data = "";                             // Variable to save Data

        foreach ($query as $r) {                // Looping data from model

            $data .= '<tr>' .
                '<td>' . $no++ . '</td>' .
                '<td>' . $r->type . '</td>' .
                '<td>' . $r->series . '</td>' .
                '<td class="text-center">' . '<button class = "btn btn-danger btn-sm" onclick="remove(' . $r->id . ')"><i class="fas fa-trash-alt"></i></button>' . '</td>' .
                '</tr>';
        }
        $result = array("list" => $data); // return data as array named 'list'
        echo json_encode($result); // Return final data 
    }
    function getSeries() // to fill chained dropdown
    {
        $type = $this->input->post('type');
        $this->db->where('type_id', $type);
        $data = $this->db->get('car_series')->result();
        $res = "";

        foreach ($data as $d) {
            $res .= '<option value ="' . $d->id . '">' . $d->series . '</option>';
        }
        $result = array("list" => $res);
        echo json_encode($result);
    }

    function save($condition)
    {
        /* 

        $condition 1 = type car
        $condition 2 = series car
        $condition 3 = car list
        
        */

        if ($condition == 1) {
            $type = $this->input->post('type');
            $table = "car_type";
            $data = [
                'type' => $type
            ];

            echo $this->car_model->save($data, $table);
        } elseif ($condition == 2) {
            $series = $this->input->post('series');
            $type = $this->input->post('type');
            $table = "car_series";
            $data = [
                'series' => $series,
                'type_id' => $type
            ];

            echo $this->car_model->save($data, $table);
        } elseif ($condition == 3) {
            $series = $this->input->post('series');
            $type = $this->input->post('type');
            $plat = $this->input->post('plat');
            $table = "car";
            $data = [
                'car_series_id' => $series,
                'car_type_id' => $type,
                'plate_number' => $plat,
                'status_id' => '1'

            ];

            echo $this->car_model->save($data, $table);
        }
    }
    function saveList()
    {
    }
    function delete($condition)
    {
        /* 

        $condition 1 = type car
        $condition 2 = series car
        $condition 3 = car list
        
        */
        if ($condition == 1) {
            $table = "car_type";
            $id = $this->input->post('id');
            echo $this->car_model->delete($id, $table);
        } elseif ($condition == 2) {
            $table = "car_series";
            $id = $this->input->post('id');
            echo $this->car_model->delete($id, $table);
        } elseif ($condition == 3) {
            $table = "car";
            $id = $this->input->post('id');
            echo $this->car_model->delete($id, $table);
        }
    }
}
