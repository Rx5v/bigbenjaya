<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    # Datatable
    private function _get_datatables_query($column_order, $column_search, $order, $status)
    {
        $this->db->select('*');
        $this->db->from('order_head');
        $this->db->where('status', $status);

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

    function get_datatables($column_order, $column_search, $order, $status)
    {
        $this->_get_datatables_query($column_order, $column_search, $order, $status);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($column_order, $column_search, $order, $status)
    {
        $this->_get_datatables_query($column_order, $column_search, $order, $status);

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($status)
    {
        $this->db->from('order_head');
        $this->db->where('status', $status);
        return $this->db->count_all_results();
    }

    public function confirm()
    {
        $id = $this->input->post('id');

        if ($id != null || $id != "") {
            $head = array(
                'status'    => 2,
            );
            $this->db->where('order_number', $id);
            $this->db->update('order_head', $head);

            $data = array(
                'car_id'    => $this->input->post('noplat'),
                'driver_id' => $this->input->post('pengemudi'),
                'status'    => 2,
            );
            $this->db->where('order_number', $id);
            $this->db->update('order_detail', $data);
        }
    }

    public function update()
    {
        $id = $this->input->post('id');

        if ($id != null || $id != "") {
            $head = array(
                'customer_name' => $this->input->post('pemesan'),
                'guest_name'    => $this->input->post('tamu'),
                'pickup'        => $this->input->post('alamatjemput'),
                'destination'   => $this->input->post('alamattujuan'),
                'pickup_date'   => $this->input->post('waktujemput'),
                'return_date'   => $this->input->post('pengembalian'),
            );
            $this->db->where('order_number', $id);
            $this->db->update('order_head', $head);

            $data = array(
                'car_id'    => $this->input->post('noplat'),
                'car_type'  => $this->input->post('mobil'),
                'driver_id' => $this->input->post('pengemudi'),
            );
            $this->db->where('order_number', $id);
            $this->db->update('order_detail', $data);
        }
    }

    public function surat_jalan($id)
    {
        $this->db->select('a.*,c.plate_number,d.type,e.name as driver');
        $this->db->from('order_head as a');
        $this->db->join('order_detail as b', 'a.order_number = b.order_number', 'left');
        $this->db->join('car as c', 'b.car_id = c.id', 'left');
        $this->db->join('car_type as d', 'b.car_type = d.id', 'left');
        $this->db->join('driver as e', 'b.driver_id = e.id', 'left');
        $this->db->where('a.order_number', $id);
        return $this->db->get()->result();
    }
}
