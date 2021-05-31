<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wishlist extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $id_buku = $this->input->post('id', true);
    $idUser = $this->session->userdata('id_user');
    if ($idUser) {
      $this->db->where('id_user', $idUser);
      $cekBuku = $this->db->get_where('wishlist', ['id_buku' => $id_buku])->num_rows();
      if ($cekBuku > 0) {
        $this->db->where('id_user', $idUser);
        $this->db->delete('wishlist', ['id_buku' => $id_buku]);
      } else {
        $data = [
          'id_buku' => $id_buku,
          'id_user' => $idUser,
          'date_created' => time()
        ];
        $result = $this->db->insert('wishlist', $data);
      }
      $res = [
        'status' => 1
      ];
      echo json_encode($res);
    } else {
      $res = [
        'status' => 0
      ];
      echo json_encode($res);
    }
  }

  public function cek()
  {
    $id = $this->input->post('id', true);
    $idUser = $this->session->userdata('id_user');

    $this->db->where('id_user', $idUser);
    $res = $this->db->get_where('wishlist', ['id_buku' => $id])->num_rows();

    if ($res < 1) {
      $res = [
        'status' => 0
      ];
    } else {
      $res = [
        'status' => 1
      ];
    }
    echo json_encode($res);
  }
}
