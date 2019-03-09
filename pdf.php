<?php
/**
 * Created by PhpStorm.
 * User: Bra Emma
 * Date: 9/7/2018
 * Time: 1:37 AM
 */

require_once "vendor/autoload.php";
use Dompdf\Dompdf;

class Pdf extends Dompdf{
    public function __construct($options = null)
    {
        parent::__construct($options);
    }
}