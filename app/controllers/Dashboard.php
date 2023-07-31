<?php 

class Dashboard extends Controller {
    public function index()
    {
        
        $data['judul'] = 'Home';
        $data['users'] = $this->model('Dashboard_model')->getCountUsers();
        $data['campaign'] = $this->model('Dashboard_model')->getCountCampaign();
        $data['donation'] = $this->model('Dashboard_model')->getCountDonation();
        // $data['participant'] = $this->model('Dashboard_model')->getCountParticipant();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/index', $data);
        $this->view('template-admin/footer');
    }
}