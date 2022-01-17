<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Transaksi extends REST_Controller {
    
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $transaksi = $this->db->get('transaksi')->result();
        } else {
            $this->db->where('id', $id);
            $transaksi = $this->db->get('transaksi')->result();
        }
        $this->response($transaksi, 200);
    }

    function index_post() {
        $data = array(
                    'merk' => $this->post('merk'),
                    'jumlah_barang' => $this->post('jumlah_barang'),
                    'total_harga' => $this->post('total_harga'),
                );
        $insert = $this->db->insert('transaksi', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'merk' => $this->put('merk'),
                    'jumlah_barang' => $this->put('jumlah_barang'),
                    'total_harga' => $this->put('total_harga'),
                );
        $this->db->where('id', $id);
        $update = $this->db->update('transaksi', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('transaksi');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
