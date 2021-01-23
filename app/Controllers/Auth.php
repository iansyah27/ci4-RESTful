<?php 
namespace App\Controllers;

class Auth extends \App\Controllers\BaseController {

    public function index()
    {
        return $this->login();
    }

    public function login()
    {
        return view('auth/login');
    }

    public function cek($id = null)
    {
        if (empty($id)) {
            return redirect()->to(base_url('login'));
        }

        $this->session->set('id', $id);
        return redirect()->to(base_url('user'));
    }

}

/* End of file Auth.php */
