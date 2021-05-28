<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . "third_party/dompdf/autoload.php";

use Dompdf\Dompdf;

class Pdf
{
  public function generate($html, $filename = '', $paper = '', $orientation = '', $stream = TRUE)
  {
    $pdf = new Dompdf();

    $pdf->setPaper($paper, $orientation);
    $pdf->loadHtml($html);
    $pdf->render();

    if ($stream) {
      $pdf->stream($filename . ".pdf", [
        "Attachment" => 0
      ]);
    } else {
      return $pdf->output();
    }
  }
}
