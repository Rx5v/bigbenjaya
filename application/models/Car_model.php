<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Car_model extends CI_Model
{
    var $column_order = array('a.id', 'b.type', 'c.series', 'a.plate_number', 'd.status'); //Sesuaikan dengan field
    var $column_search = array('a.id', 'b.type', 'c.series', 'a.plate_number', 'd.status'); //field yang diizin untuk pencarian 
    var $order = array('a.id' => 'ASC'); // default order 

    private function _get_datatables_query()
    {

        $this->db->select('a.*, b.type, c.series, d.status');
        $this->db->from('car a');
        $this->db->join('car_type b', 'a.car_type_id = b.id', 'left');
        $this->db->join('car_series c', 'a.car_series_id = c.id', 'left');
        $this->db->join('statuss d', 'a.status_id = d.id', 'left');



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
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('car');
        return $this->db->count_all_results();
    }
    function getDataType()
    {
        return $this->db->get('car_type')->result();
    }

    function getDataSeries()
    {
        $this->db->select('a.*, b.type');
        $this->db->from('car_series a');
        $this->db->join('car_type b', 'a.type_id = b.id');
        return $this->db->get('car_series')->result();
    }

    function save($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    function delete($id, $table)
    {
        $this->db->where('id', $id);
        return $this->db->delete($table);
    }
}
