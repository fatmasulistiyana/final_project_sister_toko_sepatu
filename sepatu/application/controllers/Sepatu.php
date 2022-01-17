<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Sepatu extends REST_Controller {
    
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $sepatu = $this->db->get('sepatu')->result();
        } else {
            $this->db->where('id', $id);
            $sepatu = $this->db->get('sepatu')->result();
        }
        $this->response($sepatu, 200);
    }

    function index_post() {
        $data = array(
                    'merk' => $this->post('merk'),
                    'model' => $this->post('model'),
                    'warna' => $this->post('warna'),
                    'ukuran' => $this->post('ukuran'),
                    'harga' => $this->post('harga')
                );
        $insert = $this->db->insert('sepatu', $data);
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
                    'model' => $this->put('model'),
                    'warna' => $this->put('warna'),
                    'ukuran' => $this->put('ukuran'),
                    'harga' => $this->put('harga'),
                );
        $this->db->where('id', $id);
        $update = $this->db->update('sepatu', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('sepatu');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
