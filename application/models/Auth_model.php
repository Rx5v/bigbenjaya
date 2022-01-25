<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function doLogin()
    {
        $email      = $this->input->post('email', true);
        $pass       = $this->input->post('password', true);
        $user       = $this->db->where('email', $email)->get('user')->row();

        if ($user) {
            $isPasswordTrue = password_verify($pass, $user->password);
            if (!$isPasswordTrue) {
                return $data["result"] = "wrong_password";
            } else {
                if ($user->is_active == 1) {
                    $this->_add_to_session($user);
                    if ($user->level == 1) {
                        return $data["result"] = "admin";
                    } elseif ($user->level == 2) {
                        return $data["result"] = "customer";
                    }
                } else {
                    return $data["result"] = "not_active";
                }
            }
        }
        return $data["result"] = "false";
    }

    public function _add_to_session($row)
    {
        $sess = array(
            'user_logged'   => true,
            'id'            => $row->id,
            'name'          => $row->user_name,
            'level'         => $row->level,
        );
        $this->session->set_userdata($sess);
    }

    public function signin()
    {
        $data = array(
            'user_name' => $this->input->post('username'),
            'email'     => $this->input->post('email'),
            'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'level'     => 2,
            'is_active' => 1,
        );

        return $this->db->insert('user', $data);
    }

    public function doLogout()
    {
        return $this->session->sess_destroy();
    }
}
