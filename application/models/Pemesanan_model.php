<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    # Create Order
    public function order_code()
    {
        date_default_timezone_set('Asia/Jakarta');
        $q = $this->db->query("SELECT MAX(RIGHT(order_number,4)) AS kd_max FROM order_head WHERE DATE(created_at)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return "BBJ" . date('ymd') . $kd;
    }

    public function create_order()
    {
        $code = $this->order_code();

        $data  = array(
            'order_number'  => $code,
            'customer_name' => $this->input->post('namaPemesan'),
            'guest_name'    => $this->input->post('namaTamu'),
            'phone'         => $this->input->post('nomorHp'),
            'pickup'        => $this->input->post('alamatPenjemputan'),
            'destination'   => $this->input->post('alamatTujuan'),
            'pickup_date'   => $this->input->post('tanggalPengambilan'),
            'return_date'   => $this->input->post('tanggalPengembalian'),
            'status'        => 1,
        );

        $this->db->insert('order_head', $data);

        $car = array(
            'order_number'  => $code,
            'car_type'      => $this->input->post('mobil'),
            'status'        => 1,
        );

        $this->db->insert('order_detail', $car);
    }
}
