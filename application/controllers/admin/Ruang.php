<?php

defined('BASEPATH') or exit('No Direct script access Allowed');

class Ruang extends CI_Controller
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
        $data['title']      = 'Data Ruang';
        $data['subtitle']   = 'Semua data Ruang akan muncul disini';

        $data['ruang']   = $this->m_model->get_desc('tb_ruang');
        $data['gedung']   = $this->m_model->get_desc('tb_gedung');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/ruang');
        $this->load->view('admin/templates/footer');
    }

    public function delete($id)
    {
        $where  = array('id' => $id);
        $this->m_model->delete($where, 'tb_ruang');
        $this->session->set_flashdata('pesan', 'Data ruang Berhasil dihapus!');
        redirect('admin/ruang');
    }

    public function insert()
    {
        $id_gedung            = $_POST['id_gedung'];
        $nama_ruang                  = $_POST['nama_ruang'];
        $data = array(
            'id_gedung'           => $id_gedung,
            'nama_ruang'             => $nama_ruang,
        );

        $this->m_model->insert($data, 'tb_ruang');
        $this->session->set_flashdata('pesan', 'Data ruang Berhasil Ditambahkan!');
        redirect('admin/ruang');
    }

    public function update($id)
    {

        $id_gedung            = $_POST['id_gedung'];
        $nama_ruang            = $_POST['nama_ruang'];

        $data = array(
            'id_gedung'           => $id_gedung,
            'nama_ruang'             => $nama_ruang,

        );
        $where = array('id' => $id);
        $this->m_model->update($where, $data, 'tb_ruang');
        $this->session->set_flashdata('pesan', 'Data Router Berhasil Diubah!');
        redirect('admin/ruang');
    }
}
