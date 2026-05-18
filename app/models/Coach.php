<?php

require_once __DIR__ . '/../core/Model.php';

class Coach extends Model
{
    public function getAllCoaches()
    {
        $sql = "SELECT coaches.*, teams.teamName
                FROM coaches
                LEFT JOIN teams ON coaches.teamId = teams.teamId
                ORDER BY coaches.coachId DESC";

        $result = $this->db->query($sql);

        if (!$result) {
            die('SQL error in getAllCoaches: ' . $this->db->error);
        }

        return $result;
    }

    public function getCoachById($coachId)
    {
        $sql = "SELECT * FROM coaches WHERE coachId = ? LIMIT 1";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in getCoachById: ' . $this->db->error);
        }

        $stmt->bind_param('i', $coachId);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function addCoach($name, $age, $phone, $specialization, $teamId)
    {
        $sql = "INSERT INTO coaches 
                (userId, teamId, name, age, phone, specialization)
                VALUES (NULL, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in addCoach: ' . $this->db->error);
        }

        $stmt->bind_param(
            'isiss',
            $teamId,
            $name,
            $age,
            $phone,
            $specialization
        );

        return $stmt->execute();
    }

    public function updateCoach($coachId, $name, $age, $phone, $specialization, $teamId)
    {
        $sql = "UPDATE coaches
                SET teamId = ?,
                    name = ?,
                    age = ?,
                    phone = ?,
                    specialization = ?
                WHERE coachId = ?";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in updateCoach: ' . $this->db->error);
        }

        $stmt->bind_param(
            'isissi',
            $teamId,
            $name,
            $age,
            $phone,
            $specialization,
            $coachId
        );

        return $stmt->execute();
    }

    public function deleteCoach($coachId)
    {
        $sql = "DELETE FROM coaches WHERE coachId = ?";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in deleteCoach: ' . $this->db->error);
        }

        $stmt->bind_param('i', $coachId);

        return $stmt->execute();
    }

    public function getTeams()
    {
        $sql = "SELECT teamId, teamName FROM teams ORDER BY teamName ASC";

        $result = $this->db->query($sql);

        if (!$result) {
            die('SQL error in getTeams: ' . $this->db->error);
        }

        return $result;
    }
}