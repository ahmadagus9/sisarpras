<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Pdf');
        if (!$this->session->userdata('level')) {
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        }
    }

    public function index()
    {
        $data['title']        = 'Laporan';
        $data['subtitle']    = 'Semua data laporan barang akan muncul disini';

        $data['barang']    = $this->m_model->get_desc('tb_barang');
        $data['ruang']    = $this->m_model->get_desc('tb_ruang');

        $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $ruang = $this->input->get('ruang');  // Filter ruang
        $keadaan = $this->input->get('keadaan'); // Filter keadaan
        if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->m_model->view_all();  // Panggil fungsi view_all yang ada di TransaksiModel
            $url_cetak = 'report/cetak';
            $label = 'Semua Data Laporan barang';
        } else { // Jika terisi
            $transaksi = $this->m_model->view_by_date($tgl_awal, $tgl_akhir, $ruang, $keadaan);  // Panggil fungsi view_by_date yang ada di TransaksiModel
            $url_cetak = 'report/cetak?tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir;
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
        }
        if ($ruang) {
            $label .= 'nama_ruang' . $ruang;
        }

        if ($keadaan) {
            $label .= 'keadaan' . $keadaan;
    
        }
        $data['transaksi'] = $transaksi;
        $data['url_cetak'] = base_url('index.php/admin/' . $url_cetak);
        $data['label'] = $label;

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/report');
        $this->load->view('admin/templates/footer');
    }

    public function cetak()
    {
        $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $ruang = $this->input->get('ruang');
        $keadaan = $this->input->get('keadaan');
        if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->m_model->view_all();  // Panggil fungsi view_all yang ada di TransaksiModel
            $label = 'Semua Data';
        } else { // Jika terisi
            $transaksi = $this->m_model->view_by_date($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
        }
        if ($ruang) {
            $label .= 'nama_ruang' . $ruang;
        }

        if ($keadaan) {
            $label .= 'keadaan' . $keadaan;
    
        }
        $data1 =  $label;
        $data = $transaksi;
        // $data['label'] = $label;
        // $data['transaksi'] = $transaksi;
        // ob_start();
        // $this->load->view('print', $data);
        // $html = ob_get_contents();
        // ob_end_clean();
        // require './assets/libraries/html2pdf/autoload.php'; // Load plugin html2pdfnya
        // $pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');  // Settingan PDFnya
        // $pdf->WriteHTML($html);
        // $pdf->Output('Data Transaksi.pdf', 'D');
        //

        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('P', 'mm', 'Letter'); // Mengubah ukuran PDF menjadi kertas "Letter"
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Rekap Data Barang', 0, 1, 'C');
        $pdf->Cell(0, 10, $label, 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 7, 'No', 1, 0, 'C');
        $pdf->Cell(25, 7, 'Tanggal', 1, 0, 'C');
        $pdf->Cell(25, 7, 'Ruang', 1, 0, 'C');
        $pdf->Cell(35, 7, 'Nama Barang', 1, 0, 'C');
        $pdf->Cell(30, 7, 'Merk', 1, 0, 'C');
        $pdf->Cell(30, 7, 'Keadaan', 1, 0, 'C');
        $pdf->Cell(40, 7, 'Jumlah', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 10);

        $no = 1;
        foreach ($transaksi as $data) {
            $pdf->Cell(10, 7, $no, 1, 0, 'C'); // Mengatur rata kiri untuk nomor urut
            $pdf->Cell(25, 7, date('d-m-Y', strtotime($data->tanggal)), 1, 0, 'L'); // Mengatur rata kiri untuk tanggal
            
            $this->db->where('id', $data->id_ruang);
            foreach ($this->db->get('tb_ruang')->result() as $druang) {
                $pdf->Cell(25, 7, $druang->nama_ruang, 1, 0, 'L'); // Mengatur rata kiri untuk nama ruang
            }
            
            $pdf->Cell(35, 7, $data->nama_barang, 1, 0, 'L'); // Mengatur rata kiri untuk nama barang
            $pdf->Cell(30, 7, $data->merk, 1, 0, 'L'); // Mengatur rata kiri untuk merk
            $pdf->Cell(30, 7, $data->keadaan, 1, 0, 'L'); // Mengatur rata kiri untuk keadaan
            $pdf->Cell(40, 7, $data->jumlah, 1, 1, 'L'); // Mengatur rata kiri untuk jumlah
            
            $no++;
        }

        $pdf->Output();
    }
}
