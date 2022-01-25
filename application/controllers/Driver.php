<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('driver_model');
    }
    public function indeX()
    {
        view_admin('admin/driver/driver_list');
    }
    function getDriver()
    {
        if ($this->input->is_ajax_request() == true) {
            $list = $this->driver_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $field->name;
                $row[] = $field->phone;
                $row[] = $field->status;
                $row[] = '<button class="btn btn-sm" onclick="remove(' . $field->id . ')" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt text-danger"></i></button>' . '<button class="btn" type="button" onClick="edit(' . $field->id . ')" data-toggle="tooltip" data-placement="top" title="Edit"><i class="far fa-edit text-info"></i></button>';
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->driver_model->count_all(),
                "recordsFiltered" => $this->driver_model->count_filtered(),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Sorry Data cannot display');
        }
    }

    function save()
    {
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $pict = $this->driver_model->uploadPict();

        $data = [
            'name' => $name,
            'phone' => $phone,
            'pict' => $pict,
            'status_id' => 1,
            'is_active' => 1
        ];
        echo $this->db->insert('driver', $data);
    }

    function delete()
    {
        $id = $this->input->post('id');
        echo $this->driver_model->delete($id, 'driver');
    }
    function edit()
    {
        $id = $this->input->post('id');
        $query = $this->driver_model->detail($id);
        $name = '';
        $phone = '';
        $pict = '';
        $uId = '';
        foreach ($query as $q) {
            $name .= $q->name;
            $pict .= $q->pict;
            $phone .= $q->phone;
            $uId .= $q->id;
        }
        $result = [
            'name' => $name,
            'phone' => $phone,
            'pict' => $pict,
            'id' => $uId
        ];
        echo json_encode($result);
    }
    function update()
    {
        $cek = $this->driver_model->updatePict();
        $name = $this->input->post('uName');
        $phone = $this->input->post('uPhone');
        $id = $this->input->post('uId');
        if (!$cek) {
            $pict = $this->input->post('oldPict');
        } else {
            $pict = $cek; 
        }

        $data = [
            'name' => $name,
            'phone' => $phone,
            'pict'  => $pict
        ];
        echo $this->driver_model->update($data, $id);
    }
}
