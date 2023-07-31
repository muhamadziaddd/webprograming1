<?php 

class Donasi extends Controller {
    public function index()
    {
        $data['judul'] = 'Donasi';
        $data['nama'] = $this->model('User_model')->getUser();
        $data['campaign'] = $this->model('Dashboard_campaign_model')->getAllCampaign();
        $this->view('templates/header', $data);
        $this->view('donasi/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if( $this->model('Donasi_model')->tambahDataDonasi($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/donasi');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/donasi');
            exit;
        }
    }

    
}