<?php

require_once __DIR__ . '/../core/Model.php';

class MatchModel extends Model
{
    public function getAllMatches()
    {
        $sql = "SELECT m.*, t.teamName
                FROM matches m
                LEFT JOIN teams t ON m.teamId = t.teamId
                ORDER BY m.matchDate DESC";

        $result = $this->db->query($sql);
        $matches = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $matches[] = $row;
            }
        }

        return $matches;
    }

    public function getMatchById($matchId)
    {
        $sql = "SELECT * FROM matches WHERE matchId = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error: ' . $this->db->error);
        }

        $stmt->bind_param('i', $matchId);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function getTeams()
    {
        $result = $this->db->query("SELECT teamId, teamName FROM teams ORDER BY teamName ASC");
        $teams = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $teams[] = $row;
            }
        }

        return $teams;
    }

    public function createMatch($teamId, $opponent, $matchDate, $location, $status)
    {
        $sql = "INSERT INTO matches (teamId, opponent, matchDate, location, status)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error: ' . $this->db->error);
        }

        $stmt->bind_param('issss', $teamId, $opponent, $matchDate, $location, $status);
        return $stmt->execute();
    }

    public function updateMatch($matchId, $teamId, $opponent, $matchDate, $location, $result, $status)
    {
        $sql = "UPDATE matches
                SET teamId = ?, opponent = ?, matchDate = ?, location = ?, result = ?, status = ?
                WHERE matchId = ?";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error: ' . $this->db->error);
        }

        $stmt->bind_param('isssssi', $teamId, $opponent, $matchDate, $location, $result, $status, $matchId);
        return $stmt->execute();
    }

    public function deleteMatch($matchId)
    {
        $sql = "DELETE FROM matches WHERE matchId = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error: ' . $this->db->error);
        }

        $stmt->bind_param('i', $matchId);
        return $stmt->execute();
    }
}
