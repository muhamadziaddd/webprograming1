<?php 

class Dashboard_user_model {
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllUsers()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataUser($data)
    {
        $query = "INSERT INTO user (name, email, phone_number, address, password, role)
                VALUES (:name, :email, :phone_number, :address, :password,  :role)";
        
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('phone_number', $data['phone_number']);
        $this->db->bind('address', $data['address']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('role', $data['role']);

        $this->db->execute();
        return $this->db->rowCount();
    }
    public function editUser($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }


    public function hapusDataUser($id)
    {
        $query = "DELETE FROM user WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function ubahDataUser($data)
    {
        $query = "UPDATE user SET
                    name = :name,
                    email = :email,
                    password = :password,
                    role = :role,
                    :phone_number,
                    :address
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('phone_number', $data['phone_number']);
        $this->db->bind('address', $data['address']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('role', $data['role']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }


    public function cariDataUser()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM 'user' WHERE name LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

}