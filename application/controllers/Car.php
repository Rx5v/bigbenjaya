<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Car extends CI_Controller
{
    public function index()
    {
    }

    public function car_type()
    {
        view_admin("admin/car_type");
    }
}
