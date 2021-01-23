<?php 
namespace App\Controllers;

class User extends \App\Controllers\BaseController {

    public function index()
    {
        return $this->data();
    }

    public function data()
    {
        return view('user/data');
    }

}

/* End of file User.php */
