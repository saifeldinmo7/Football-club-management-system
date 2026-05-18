<?php

require_once __DIR__ . '/../core/Model.php';

class TrainingSession extends Model
{
    public function getAllSessions()
    {
        $sql = "SELECT training_sessions.*, coaches.name AS coachName, teams.teamName
                FROM training_sessions
                LEFT JOIN coaches ON training_sessions.coachId = coaches.coachId
                LEFT JOIN teams ON training_sessions.teamId = teams.teamId
                ORDER BY training_sessions.sessionId DESC";

        $result = $this->db->query($sql);

        if (!$result) {
            die('SQL error in getAllSessions: ' . $this->db->error);
        }

        return $result;
    }

    public function getSessionById($sessionId)
    {
        $sql = "SELECT * FROM training_sessions WHERE sessionId = ? LIMIT 1";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in getSessionById: ' . $this->db->error);
        }

        $stmt->bind_param('i', $sessionId);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function addSession($coachId, $teamId, $sessionDate, $duration, $focusArea, $notes)
    {
        $sql = "INSERT INTO training_sessions 
                (coachId, teamId, sessionDate, duration, focusArea, notes)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in addSession: ' . $this->db->error);
        }

        $stmt->bind_param(
            'iissss',
            $coachId,
            $teamId,
            $sessionDate,
            $duration,
            $focusArea,
            $notes
        );

        return $stmt->execute();
    }

    public function updateSession($sessionId, $coachId, $teamId, $sessionDate, $duration, $focusArea, $notes)
    {
        $sql = "UPDATE training_sessions
                SET coachId = ?,
                    teamId = ?,
                    sessionDate = ?,
                    duration = ?,
                    focusArea = ?,
                    notes = ?
                WHERE sessionId = ?";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in updateSession: ' . $this->db->error);
        }

        $stmt->bind_param(
            'iissssi',
            $coachId,
            $teamId,
            $sessionDate,
            $duration,
            $focusArea,
            $notes,
            $sessionId
        );

        return $stmt->execute();
    }

    public function deleteSession($sessionId)
    {
        $sql = "DELETE FROM training_sessions WHERE sessionId = ?";

        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('SQL error in deleteSession: ' . $this->db->error);
        }

        $stmt->bind_param('i', $sessionId);

        return $stmt->execute();
    }

    public function getCoaches()
    {
        $sql = "SELECT coachId, name FROM coaches ORDER BY name ASC";

        $result = $this->db->query($sql);

        if (!$result) {
            die('SQL error in getCoaches: ' . $this->db->error);
        }

        return $result;
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