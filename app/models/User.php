<?php
class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users where email = :email');
        // Bind values
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }
    public function addUser($data)
    {
        $sql = "INSERT INTO users (first_name, last_name, email, password, registration_date, user_level) values (:firstname, :lastname, :email, :password, NOW(), 2);";
        $this->db->query($sql);
        $this->db->bind(':firstname', $data['firstname']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
     public function getUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users where email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        if ($row) {
            return $row;
        } else {
            return false;
        }
    }
}