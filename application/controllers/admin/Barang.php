<?php

defined('BASEPATH') or exit('No Direct script access Allowed');

class Barang extends CI_Controller
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
        $data['title']      = 'Data Barang';
        $data['subtitle']   = 'Semua data Barang akan muncul disini';

        $data['barang']   = $this->m_model->get_desc('tb_barang');
        $data['gedung']   = $this->m_model->get_desc('tb_gedung');
        $data['ruang']   = $this->m_model->get_desc('tb_ruang');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/barang');
        $this->load->view('admin/templates/footer');
    }

    public function delete($id)
    {
        $where  = array('id' => $id);
        $this->m_model->delete($where, 'tb_barang');
        $this->session->set_flashdata('pesan', 'Data Barang Berhasil dihapus!');
        redirect('admin/barang');
    }

    public function insert()
    {
        $id_ruang            = $_POST['id_ruang'];
        $nama_barang        = $_POST['nama_barang'];
        $merk            = $_POST['merk'];
        $tanggal            = $_POST['tanggal'];
        $keadaan            = $_POST['keadaan'];
        $jumlah           = $_POST['jumlah'];
        $gambar             = $_FILES['gambar'];

        if ($gambar != '') {
            $config['upload_path'] = './assets/gambar/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = 'gambar-' . time();
            $config['max_size'] = 5120;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $gambar = '';
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }

        $data = array(
            'id_ruang'         => $id_ruang,
            'nama_barang'     => $nama_barang,
            'merk'             => $merk,
            'tanggal'         => $tanggal,
            'keadaan'         => $keadaan,
            'jumlah'         => $jumlah,
            'gambar'         => $gambar,
        );


        $this->m_model->insert($data, 'tb_barang');
        $this->session->set_flashdata('pesan', 'Data Barang Berhasil Ditambahkan!');
        redirect('admin/barang');
    }

    public function update($id)
    {

        $id_ruang            = $_POST['id_ruang'];
        $nama_barang        = $_POST['nama_barang'];
        $merk            = $_POST['merk'];
        $tanggal            = $_POST['tanggal'];
        $keadaan            = $_POST['keadaan'];
        $jumlah            = $_POST['jumlah'];
        $gambar             = $_FILES['gambar'];

        $where = array('id' => $id);

        if ($gambar != '') {
            $config['upload_path'] = './assets/gambar/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = 'gambar-' . time();
            $config['max_size'] = 5120;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $gambar = '';
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }

        $data = array(
            'id_ruang'         => $id_ruang,
            'nama_barang'     => $nama_barang,
            'merk'             => $merk,
            'tanggal'         => $tanggal,
            'keadaan'         => $keadaan,
            'jumlah'         => $jumlah,
            'gambar'         => $gambar,
        );


        $where = array('id' => $id);
        $this->m_model->update($where, $data, 'tb_barang');
        $this->session->set_flashdata('pesan', 'Data Barang Berhasil Diubah!');
        redirect('admin/barang');
    }
}
