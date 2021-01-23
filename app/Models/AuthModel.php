<?php 
namespace App\Models;

class AuthModel extends \CodeIgniter\Model {

    function __construct()
    {
        parent::__construct();
        $this->validation = \Config\Services::validation();
    }

    // login
    public function login($input)
    {
        $this->validation->setRule('username', 'username', 'required|trim');
        $this->validation->setRule('password', 'password', 'required|trim');

        if ($this->validation->run($input)) {
            $user = $this->db->table('user')->where(['username' => $input['username']])->get()->getRowArray();
            if ($user) {
                if (password_verify($input['password'], $user['password'])) {
                    $hasil = [
                        'error' => false,
                        'message' => "berhasil masuk",
                        'data' => $user
                    ];
                } else {
                    $hasil = [
                        'error' => true,
                        'message' => "password salah"
                    ];
                }
            } else {
                $hasil = [
                    'error' => true,
                    'message' => "username tidak ditemukan"
                ];
            }
        } else {
            foreach($this->validation->getErrors() as $key => $item) {
                $hasil = [
                    'error' => true,
                    'message' => $item,
                    'field' => $key
                ];

                return $hasil;
            }
        }

        return $hasil;
    }

}

/* End of file AuthModel.php */
