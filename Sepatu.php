<?php
Class Sepatu extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://192.168.43.24/rest-server/sepatu/index.php/";
    }
    
    // menampilkan data kontak
    function index(){
        $data['data'] = json_decode($this->curl->simple_get($this->API.'Sepatu'));
        $this->load->view('components/Header');
        $this->load->view('sepatu/list',$data);
    }
    
    function tambah(){
        if(isset($_POST['submit'])){
            $data = array(
                'merk'       =>  $this->input->post('merk'),
                'model'       =>  $this->input->post('model'),
                'ukuran'       =>  $this->input->post('ukuran'),
                'warna'       =>  $this->input->post('warna'),
                'harga'       =>  $this->input->post('harga'),
            );
            $insert =  $this->curl->simple_post($this->API.'Sepatu', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($insert)
            {
                $this->session->set_flashdata('hasil','Insert Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Insert Data Gagal');
            }
            redirect('Sepatu');
        }else{
            $this->load->view('components/Header');
            $this->load->view('sepatu/tambah');
        }
    }
    
    // edit data kontak
    function ubah(){
        if(isset($_POST['submit'])){
            $data = array(
                'id'       =>  $this->input->post('id'),
                'merk'       =>  $this->input->post('merk'),
                'model'       =>  $this->input->post('model'),
                'ukuran'       =>  $this->input->post('ukuran'),
                'warna'       =>  $this->input->post('warna'),
                'harga'       =>  $this->input->post('harga'),
            );
            $update =  $this->curl->simple_put($this->API.'Sepatu', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('hasil','Update Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Update Data Gagal');
            }
            redirect('Sepatu');
        }else{
            $params = array('id'=>  $this->uri->segment(3));
            $data['data'] = json_decode($this->curl->simple_get($this->API.'Sepatu',$params));
            $this->load->view('components/Header');
            $this->load->view('sepatu/ubah',$data);
        }
    }
    
    // delete data kontak
    function hapus($id){
        if(empty($id)){
            redirect('Sepatu');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'Sepatu', array('id'=>$id), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('Sepatu');
        }
    }
}