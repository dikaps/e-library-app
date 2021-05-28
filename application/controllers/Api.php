<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Api_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $data = $this->Api_model->fetch_all();

    echo json_encode($data->result_array());
  }
}
