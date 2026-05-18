<?php

require_once __DIR__ . '/../core/Model.php';

class Team extends Model
{
    public function getAllTeams()
    {
        $sql = "SELECT * FROM teams ORDER BY teamId DESC";

        $result = $this->db->query($sql);

        if (!$result) {
            die('SQL error in getAllTeams: ' . $this->db->error);
        }

        return $result;
    }

    public function getTeamById($teamId)
    {
        $sql = "SELECT * FROM teams WHERE teamId = ? LIMIT 1";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in getTeamById: ' . $this->db->error);
        }

        $stmt->bind_param('i', $teamId);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function addTeam($teamName, $category)
    {
        $sql = "INSERT INTO teams (teamName, category) VALUES (?, ?)";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in addTeam: ' . $this->db->error);
        }

        $stmt->bind_param('ss', $teamName, $category);

        return $stmt->execute();
    }

    public function updateTeam($teamId, $teamName, $category)
    {
        $sql = "UPDATE teams SET teamName = ?, category = ? WHERE teamId = ?";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in updateTeam: ' . $this->db->error);
        }

        $stmt->bind_param('ssi', $teamName, $category, $teamId);

        return $stmt->execute();
    }

    public function deleteTeam($teamId)
    {
        $sql = "DELETE FROM teams WHERE teamId = ?";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in deleteTeam: ' . $this->db->error);
        }

        $stmt->bind_param('i', $teamId);

        return $stmt->execute();
    }
}