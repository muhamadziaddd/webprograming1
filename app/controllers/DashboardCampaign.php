<?php 

class DashboardCampaign extends Controller {

    public function index()
    {
        $data['judul'] = 'Daftar Campaign';
        $data['campaign'] = $this->model('Dashboard_campaign_model')->getAllCampaign();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/campaign/index', $data);
        $this->view('template-admin/footer');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Campaign';
        $data['campaign'] = $this->model('Dashboard_campaign_model')->getCampaignById($id);
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/campaign/index', $data);
        $this->view('template-admin/footer');
    }

    public function create() {
        $data['judul'] = 'Daftar Campaign';
        $data['campaign'] = $this->model('Dashboard_campaign_model')->getAllCampaign();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/campaign/create', $data);
        $this->view('template-admin/footer');
    }
    public function edit($id) {
        $data['judul'] = 'Edit Campaign';
        $data['campaign'] = $this->model('Dashboard_campaign_model')->editCampaign($id);
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/campaign/edit', $data);
        $this->view('template-admin/footer');
    }

    public function tambah()
    {
        if( $this->model('Dashboard_campaign_model')->tambahDataCampaign($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/DashboardCampaign');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/DashboardCampaign');
            exit;
        }
    }

    public function hapus($id)
    {
        if( $this->model('Dashboard_campaign_model')->hapusDataCampaign($id) > 0 ) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/DashboardCampaign');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/DashboardCampaign');
            exit;
        }
    }

    public function getubah()
    {
        echo json_encode($this->model('Dashboard_campaign_model')->getCampaignById($_POST['id']));
    }

    public function ubah()
    {
        if( $this->model('Dashboard_campaign_model')->ubahDataCampaign($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/DashboardCampaign');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/DashboardCampaign');
            exit;
        } 
    }

    public function cari()
    {
        $data['judul'] = 'Daftar Campaign';
        $data['campaign'] = $this->model('Dashboard_campaign_model')->cariDataCampaign();
        $this->view('template-admin/header', $data);
        $this->view('template-admin/sidebar', $data);
        $this->view('dashboard/campaign/index', $data);
        $this->view('template-admin/footer');
    }
}