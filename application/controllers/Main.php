<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
    public function index() {
        $sql = "SELECT REG_DATE FROM iotc_member ORDER BY REG_DATE DESC LIMIT 20";
        $query = $this->db->query($sql);
        $data['list'] = $query->result();
        
        $this->load->view('main', $data);
    }

    public function load_more() {
        $offset = $this->input->get('offset');
        $sql = "SELECT REG_DATE FROM iotc_member ORDER BY REG_DATE DESC LIMIT 20 OFFSET $offset";
        $query = $this->db->query($sql);
        $data['list'] = $query->result();

        echo json_encode($data);
    }
}