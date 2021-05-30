<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wishlist extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    cek_login();
  }

  public function index()
  {
    $id_buku = $this->input->post('id', true);
  }
}
