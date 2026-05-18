<?php

class AdminUser
{
    public function getDashboardTitle()
    {
        return 'Admin Dashboard';
    }

    public function getAllowedPages()
    {
        return ['dashboard', 'teams', 'players', 'coaches', 'matches', 'training', 'lineup'];
    }
}

class CoachUser
{
    public function getDashboardTitle()
    {
        return 'Coach Dashboard';
    }

    public function getAllowedPages()
    {
        return ['dashboard', 'players', 'matches', 'training', 'lineup'];
    }
}

class PlayerUser
{
    public function getDashboardTitle()
    {
        return 'Player Dashboard';
    }

    public function getAllowedPages()
    {
        return ['dashboard', 'matches', 'training'];
    }
}

class UserFactory
{
    public static function createUser($role)
    {
        if ($role === 'admin') {
            return new AdminUser();
        }

        if ($role === 'coach') {
            return new CoachUser();
        }

        if ($role === 'player') {
            return new PlayerUser();
        }

        return null;
    }
}