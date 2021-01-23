<?php 
namespace App\Controllers\Api;

class User extends \CodeIgniter\RESTful\ResourceController {

    protected $format = 'json';

    protected $modelName = 'App\Models\UserModel';

    function __construct() {
        header('Access-Control-Allow-Origin: *');
    }

    // tampilkan user
    public function index()
    {
        $response = $this->model->index();
        return $this->respond($response);
    }

    // tambah user
    public function create()
    {
        $response = $this->model->create($this->request->getPost());
        return $this->respond($response);
    }

    // edit user
    public function edit($id = null)
    {
        $response = $this->model->edit($id, $this->request->getPost());
        return $this->respond($response);
    }

    // hapus user
    public function remove($id = null)
    {
        $response = $this->model->remove($id);
        return $this->respond($response);
    }

    // detail user
    public function details($id = null)
    {
        $response = $this->model->details($id);
        return $this->respond($response);
    }

}

/* End of file User.php */
