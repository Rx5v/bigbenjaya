<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    # Datatable
    private function _get_datatables_query($column_order, $column_search, $order)
    {
        $this->db->select('*');
        $this->db->from('order_head');

        $i = 0;

        foreach ($column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($order)) {
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($column_order, $column_search, $order)
    {
        $this->_get_datatables_query($column_order, $column_search, $order);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($column_order, $column_search, $order)
    {
        $this->_get_datatables_query($column_order, $column_search, $order);

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('order_head');
        return $this->db->count_all_results();
    }
}
