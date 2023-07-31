<?php 

class Dashboard_model {
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCountUsers()
    {
        $query = $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        $query = $this->db->single();
        $result = $query;

        if (isset($result['total'])) {
            return $result['total'];
        }
    
        return 0;
    }
    public function getCountCampaign()
    {
        $query = $this->db->query('SELECT COUNT(*) as total_campaign FROM campaign');
        $query = $this->db->single();
        $result = $query;

        if (isset($result['total_campaign'])) {
            return $result['total_campaign'];
        }
    
        return 0;
    }
    public function getCountDonation()
    {
        $query = $this->db->query('SELECT COUNT(*) as total_donation FROM donation');
        $query = $this->db->single();
        $result = $query;

        if (isset($result['total_donation'])) {
            return $result['total_donation'];
        }
    
        return 0;
    }
    // public function getCountParticipant()
    // {
    //     $query = $this->db->query('SELECT COUNT(*) as total_participant FROM participant');
    //     $query = $this->db->single();
    //     $result = $query;

    //     if (isset($result['total_participant'])) {
    //         return $result['total_participant'];
    //     }
    
    //     return 0;
    // }
}