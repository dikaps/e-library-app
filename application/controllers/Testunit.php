<?php
defined('BASEPATH')or exit('No Direct Access Script allowed');

class Testunit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
    }

    private function division($a,$b){
        return $a/$b;
    }

    public function index()
    {
        echo "using Unit Test";
        $test = $this->division(6,3);
        $expected_result = 2;
        $test_name = "Division Test Function";
        echo $this->unit->run($test, $expected_result,$test_name);
    }

}
