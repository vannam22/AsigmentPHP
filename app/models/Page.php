<?php
class Page
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getProduct()
    {
        $this->db->query('SELECT * FROM products WHERE status != 0');
        $row = $this->db->resultSet();
        if ($row) {
            return $row;
        } else {
            return false;
        }
    }
}