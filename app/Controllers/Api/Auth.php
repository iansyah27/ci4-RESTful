<?php 
namespace App\Controllers\Api;

class Auth extends \CodeIgniter\RESTful\ResourceController {

    protected $format = 'json';

    protected $modelName = 'App\Models\AuthModel';

    function __construct() {
        header('Access-Control-Allow-Origin: *');
    }

    public function index()
    {
        return $this->login();
    }

    // login
    public function login()
    {
        $response = $this->model->login($this->request->getPost());
        return $this->respond($response);
    }

}

/* End of file Auth.php */
