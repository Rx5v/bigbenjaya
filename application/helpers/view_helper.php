<?php
defined('BASEPATH') or exit('no direct script allowed');
/* This is helper to templating view 
    this helper was loaded in autoload.php in config folder

Note : 
    $path refers to location of the file (view).
    $data refers to data from controller do you want to send into view.

*/


// method to load template view Admin
function view_admin($path, $data = null)
{
    $CI = &get_instance(); // replace $this in CodeIgniter
    $CI->load->view('admin/include/header', $data);
    $CI->load->view('admin/include/sidebar');
    $CI->load->view('admin/include/navbar');
    $CI->load->view($path); // main content
    $CI->load->view('admin/include/footer');
}

// method to load template view Customer
function view_customer($path, $data = null)
{
    $CI = &get_instance(); // replace $this in CodeIgniter    
    $CI->load->view($path, $data); // main content    
}
