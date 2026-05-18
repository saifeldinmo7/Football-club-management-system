<?php

require_once __DIR__ . '/../core/Model.php';

class User extends Model
{
    public function findByUsernameAndRole($username, $role)
    {
        $sql = "SELECT * FROM users WHERE username = ? AND role = ? LIMIT 1";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error: ' . $this->db->error);
        }

        $stmt->bind_param('ss', $username, $role);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
}