<?php
Class Transaksi extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://192.168.43.24/rest-server/transaksi/index.php/";
    }
    
    function index(){
        $data['data'] = json_decode($this->curl->simple_get($this->API.'Transaksi'));
        $this->load->view('components/Header');
        $this->load->view('transaksi/list',$data);
    }
    
    function tambah(){
        if(isset($_POST['submit'])){
            $data = array(
                'merk'       =>  $this->input->post('merk'),
                'jumlah_barang'       =>  $this->input->post('jumlah_barang'),
                'total_harga'       =>  $this->input->post('total_harga'),
            );
            $insert =  $this->curl->simple_post($this->API.'Transaksi', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($insert)
            {
                $this->session->set_flashdata('hasil','Insert Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Insert Data Gagal');
            }
            redirect('Transaksi');
        }else{
            $this->load->view('components/Header');
            $this->load->view('transaksi/tambah');
        }
    }
    
    function ubah(){
        if(isset($_POST['submit'])){
            $data = array(
                'id'       =>  $this->input->post('id'),
                'merk'       =>  $this->input->post('merk'),
                'jumlah_barang'       =>  $this->input->post('jumlah_barang'),
                'total_harga'       =>  $this->input->post('total_harga'),
            );
            $update =  $this->curl->simple_put($this->API.'Transaksi', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('hasil','Update Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Update Data Gagal');
            }
            redirect('Transaksi');
        }else{
            $params = array('id'=>  $this->uri->segment(3));
            $data['data'] = json_decode($this->curl->simple_get($this->API.'Transaksi',$params));
            $this->load->view('components/Header');
            $this->load->view('transaksi/ubah',$data);
        }
    }
    
    function hapus($id){
        if(empty($id)){
            redirect('Transaksi');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'Transaksi', array('id'=>$id), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('Transaksi');
        }
    }
}