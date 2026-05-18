<?php

require_once __DIR__ . '/../core/Model.php';

class Player extends Model
{
    public function getAllPlayers($search = '', $teamId = '', $position = '')
    {
        $sql = "SELECT players.*, teams.teamName
                FROM players
                LEFT JOIN teams ON players.teamId = teams.teamId
                WHERE 1";

        $types = '';
        $params = [];

        if ($search !== '') {
            $sql .= " AND players.name LIKE ?";
            $types .= 's';
            $params[] = '%' . $search . '%';
        }

        if ($teamId !== '') {
            $sql .= " AND players.teamId = ?";
            $types .= 'i';
            $params[] = (int)$teamId;
        }

        if ($position !== '') {
            $sql .= " AND players.position = ?";
            $types .= 's';
            $params[] = $position;
        }

        $sql .= " ORDER BY players.playerId DESC";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in getAllPlayers: ' . $this->db->error);
        }

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();

        return $stmt->get_result();
    }

    public function getPlayerById($playerId)
    {
        $sql = "SELECT * FROM players WHERE playerId = ? LIMIT 1";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in getPlayerById: ' . $this->db->error);
        }

        $stmt->bind_param('i', $playerId);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function addPlayer($name, $age, $position, $shirtNumber, $fitnessStatus, $performanceScore, $teamId)
    {
        $sql = "INSERT INTO players 
                (userId, teamId, name, age, position, shirtNumber, fitnessStatus, performanceScore)
                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in addPlayer: ' . $this->db->error);
        }

        $stmt->bind_param(
            'isisisi',
            $teamId,
            $name,
            $age,
            $position,
            $shirtNumber,
            $fitnessStatus,
            $performanceScore
        );

        return $stmt->execute();
    }

    public function updatePlayer($playerId, $name, $age, $position, $shirtNumber, $fitnessStatus, $performanceScore, $teamId)
    {
        $sql = "UPDATE players
                SET teamId = ?,
                    name = ?,
                    age = ?,
                    position = ?,
                    shirtNumber = ?,
                    fitnessStatus = ?,
                    performanceScore = ?
                WHERE playerId = ?";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in updatePlayer: ' . $this->db->error);
        }

        $stmt->bind_param(
            'isisisii',
            $teamId,
            $name,
            $age,
            $position,
            $shirtNumber,
            $fitnessStatus,
            $performanceScore,
            $playerId
        );

        return $stmt->execute();
    }

    public function deletePlayer($playerId)
    {
        $sql = "DELETE FROM players WHERE playerId = ?";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in deletePlayer: ' . $this->db->error);
        }

        $stmt->bind_param('i', $playerId);

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