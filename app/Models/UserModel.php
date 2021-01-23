<?php 
namespace App\Models;

class UserModel extends \CodeIgniter\Model {

    protected $table = 'user';

    protected $primaryKey = 'id';

    protected $allowedFields = ['username', 'password', 'nama', 'jenis_kelamin', 'email'];

    function __construct()
    {
        parent::__construct();
        $this->validation = \Config\Services::validation();
    }

    // tampilkan user
    public function index()
    {
        $user = $this->findAll();

        $hasil = [
            'error' => false,
            'message' => $user ? "data user ditemukan" : "user tidak tersedia",
            'data' => $user
        ];

        return $hasil;
    }

    // tambah user
    public function create($input)
    {
        $this->validation->setRule('username', 'username', 'required|trim');
        $this->validation->setRule('password', 'password', 'required|trim');
        $this->validation->setRule('nama', 'nama', 'required|trim');
        $this->validation->setRule('jenis_kelamin', 'jenis kelamin', 'required|trim');
        $this->validation->setRule('email', 'email', 'required|trim');

        if ($this->validation->run($input)) {
            if ($this->where(['username' => $input['username']])->get()->getResultArray()) {
                $hasil = [
                    'error' => true,
                    'message' => "username sudah digunakan"
                ];

                return $hasil;
            }

            $this->insert([
                'username' => $input['username'],
                'password' => password_hash($input['password'], PASSWORD_DEFAULT),
                'nama' => $input['nama'],
                'jenis_kelamin' => $input['jenis_kelamin'],
                'email' => $input['email']
            ]);

            $hasil = [
                'error' => false,
                'message' => "user berhasil ditambah",
                'data_id' => $this->db->insertID()
            ];
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

    // edit user
    public function edit($id, $input)
    {
        $user = $id ? $this->find($id) : null;

        if (!$user) {
            $hasil = [
                'error' => true,
                'message' => "user tidak ditemukan"
            ];

            return $hasil;
        }

        $this->validation->setRule('username', 'username', 'required|trim');
        // $this->validation->setRule('password', 'password', 'required|trim');
        $this->validation->setRule('nama', 'nama', 'required|trim');
        $this->validation->setRule('jenis_kelamin', 'jenis kelamin', 'required|trim');
        $this->validation->setRule('email', 'email', 'required|trim');

        if ($this->validation->run($input)) {
            if ($this->where(['username' => $input['username'], 'id <>' => $id])->get()->getResultArray()) {
                $hasil = [
                    'error' => true,
                    'message' => "username sudah digunakan"
                ];

                return $hasil;
            }

            $this->update($id, [
                'username' => $input['username'],
                // 'password' => password_hash($input['password'], PASSWORD_DEFAULT),
                'nama' => $input['nama'],
                'jenis_kelamin' => $input['jenis_kelamin'],
                'email' => $input['email']
            ]);

            $hasil = [
                'error' => false,
                'message' => "user berhasil diedit"
            ];
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

    // hapus user
    public function remove($id)
    {
        $user = $id ? $this->find($id) : null;

        if ($user) {
            $this->delete($id);
        }

        $hasil = [
            'error' => $user ? false : true,
            'message' => $user ? "user berhasil dihapus" : "user tidak ditemukan"
        ];

        return $hasil;
    }

    // detail user
    public function details($id)
    {
        $user = $id ? $this->find($id) : null;

        $hasil = [
            'error' => $user ? false : true,
            'message' => $user ? "user ditemukan" : "user tidak ditemukan",
            'data' => $user
        ];

        return $hasil;
    }

}

/* End of file UserModel.php */
