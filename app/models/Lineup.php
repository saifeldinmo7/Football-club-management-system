<?php

require_once __DIR__ . '/../core/Model.php';

class Lineup extends Model
{
    public function getAllMatches()
    {
        $sql = "SELECT m.matchId, m.opponent, m.matchDate, t.teamName
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

    public function getCoaches()
    {
        $result = $this->db->query("SELECT coachId, name FROM coaches ORDER BY name ASC");
        $coaches = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $coaches[] = $row;
            }
        }

        return $coaches;
    }

    public function getLineupByMatch($matchId)
    {
        $sql = "SELECT l.*, c.name AS coachName, m.opponent, m.matchDate
                FROM lineup l
                LEFT JOIN coaches c ON l.coachId = c.coachId
                LEFT JOIN matches m ON l.matchId = m.matchId
                WHERE l.matchId = ?
                ORDER BY l.isStarting DESC, l.position ASC";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error: ' . $this->db->error);
        }

        $stmt->bind_param('i', $matchId);
        $stmt->execute();
        $result = $stmt->get_result();
        $lineup = [];

        while ($row = $result->fetch_assoc()) {
            $lineup[] = $row;
        }

        return $lineup;
    }

    public function addLineupEntry($matchId, $coachId, $position, $isStarting)
    {
        $sql = "INSERT INTO lineup (matchId, coachId, position, isStarting)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error: ' . $this->db->error);
        }

        $stmt->bind_param('iisi', $matchId, $coachId, $position, $isStarting);
        return $stmt->execute();
    }

    public function removeLineupEntry($lineupId)
    {
        $sql = "DELETE FROM lineup WHERE lineupId = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error: ' . $this->db->error);
        }

        $stmt->bind_param('i', $lineupId);
        return $stmt->execute();
    }
}
