<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelPinjam extends CI_Model
{
  //manip table pinjam
  public function simpanPinjam($data)
  {
    $this->db->insert('pinjam', $data);
  }
  public function selectData($table, $where)
  {
    return $this->db->get($table, $where);
  }
  public function updateData($data, $where)
  {
    $this->db->update('pinjam', $data, $where);
  }
  public function deleteData($tabel, $where)
  {
    $this->db->delete($tabel, $where);
  }
  public function joinData()
  {
    $this->db->select('pinjam.*, detail_pinjam.*, buku.judul_buku');
    $this->db->from('pinjam');
    $this->db->join('detail_pinjam', 'detail_pinjam.no_pinjam = pinjam.no_pinjam', 'Right');
    $this->db->join('buku', 'buku.id = detail_pinjam.id_buku');

    return $this->db->get()->result_array();
  }

  //manip tabel detai pinjam
  public function simpanDetail($idbooking, $nopinjam)
  {
    $sql = "INSERT INTO detail_pinjam (no_pinjam,id_buku) SELECT pinjam.no_pinjam,booking_detail.id_buku FROM pinjam, booking_detail WHERE booking_detail.id_booking=$idbooking AND pinjam.no_pinjam='$nopinjam'";
    $this->db->query($sql);
  }
}
