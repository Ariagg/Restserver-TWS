<?php

// =============================================
// NIM      : 19211210
// Nama     : Aria Satria Wahyudin
// Kelas    : 19.5c.02
// Kampus   : BSI Fatmawati
// =============================================

defined('BASEPATH') OR exit('No Direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;

class Rest_member extends REST_Controller {

    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->database();
    }

    function index_get(){
        //--------------------------------------------
        // Meruppakan implementasi dari metode GET
        //--------------------------------------------
        $id = $this->get('Id');
        if ($id == '') {
            $member = $this->db->get('member')->result();
        } else {
            $this->db->where('Id', $id);
            $member = $this->db->get('member')->result();
        }
        $this->response($member, 404);
    }

    function index_post(){
        //--------------------------------------------
        // Meruppakan implementasi dari metode POST
        //--------------------------------------------
        $data = array(
            'Id' => $this->post('Id'),
            'nama_member' =>$this->post('nama_member'),
            'Email' => $this->post('Email'),
            'no_telp' => $this->post('no_telp')
        );
        $insert = $this->db->insert('member', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put(){
        //--------------------------------------------
        // Meruppakan implementasi dari metode PUT
        //--------------------------------------------
        $id = $this->put('Id');
        $data = array(
            'Id' => $this->put('Id'),
            'nama_member' =>$this->put('nama_member'),
            'Email' => $this->put('Email'),
            'no_telp' => $this->put('no_telp')
        );
        $this->db->where('Id', $id);
        $update = $this->db->update('member', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete(){
        //--------------------------------------------
        // Meruppakan implementasi dari metode DELETE
        //--------------------------------------------
        $id = $this->delete('Id');
        $this->db->where('Id', $id);
        $delete = $this->db->delete('member');
        if ($delete) {
            $this->response(array('status'=>'sukses'), 200);
        } else {
            $this->response(array('status'=>'gagal'), 502);
        }
    }

}
?>