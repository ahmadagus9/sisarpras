<?php

defined('BASEPATH') or exit('No Direct script access Allowed');

class Gedung extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('level')) {
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        }
    }

    public function index()
    {
        $data['title']      = 'Data Gedung';
        $data['subtitle']   = 'Semua data Gedung akan muncul disini';

        $data['gedung']   = $this->m_model->get_desc('tb_Gedung');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/gedung');
        $this->load->view('admin/templates/footer');
    }

    public function delete($id)
    {
        $where  = array('id' => $id);
        $this->m_model->delete($where, 'tb_gedung');
        $this->session->set_flashdata('pesan', 'Data gedung Berhasil dihapus!');
        redirect('admin/gedung');
    }

    public function insert()
    {
        $nama_gedung            = $_POST['nama_gedung'];
        $jumlah_ruang            = $_POST['jumlah_ruang'];


        $data = array(
            'nama_gedung'         => $nama_gedung,
            'jumlah_ruang'           => $jumlah_ruang,
        );

        $this->m_model->insert($data, 'tb_gedung');
        $this->session->set_flashdata('pesan', 'Data gedung Berhasil Ditambahkan!');
        redirect('admin/gedung');
    }

    public function update($id)
    {

        $nama_gedung            = $_POST['nama_gedung'];
        $jumlah_ruang          = $_POST['jumlah_ruang'];


        $data = array(
            'nama_gedung'         => $nama_gedung,
            'jumlah_ruang'         => $jumlah_ruang,
        );

        $where = array('id' => $id);
        $this->m_model->update($where, $data, 'tb_gedung');
        $this->session->set_flashdata('pesan', 'Data gedung Berhasil Diubah!');
        redirect('admin/gedung');
    }
}
