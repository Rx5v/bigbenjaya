<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver_model extends CI_Model
{
    var $column_order = array('a.id', 'a.name', 'a.phone', 'b.status'); //Sesuaikan dengan field
    var $column_search = array('a.id', 'a.name', 'a.phone', 'b.status'); //field yang diizin untuk pencarian 
    var $order = array('a.id' => 'ASC'); // default order 

    private function _get_datatables_query()
    {

        $this->db->select('a.*, b.status');
        $this->db->from('driver a');
        $this->db->join('status b', 'a.status_id = b.id', 'left');
        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('driver');
        $this->db->where('is_active', 1);
        return $this->db->count_all_results();
    }

    public function uploadPict()
    {
        $config['upload_path']          = './uploads/driver/';
        $config['allowed_types']        = 'jpg|png';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('pict')) {
            return $this->upload->data("file_name");
        } else {
            $msg = $this->upload->display_errors();
            return false;
        }
    }
    public function updatePict()
    {
        $config['upload_path']          = './uploads/driver/';
        $config['allowed_types']        = 'jpg|png';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('uPict')) {
            return $this->upload->data("file_name");
        } else {
            $msg = $this->upload->display_errors();
            return false;
        }
    }
    function delete($id, $table)
    {
        $data = ['is_active' => 0];
        $this->db->where('id', $id);
        return $this->db->update($table, $data);
    }
    function detail($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('driver')->result();
    }
    function update($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('driver', $data);
    }
}
