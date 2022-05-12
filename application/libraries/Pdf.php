<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter PDF Library
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Muhanz
 * @license         MIT License
 * @link            https://github.com/hanzzame/ci3-pdf-generator-library
 *
 */

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');
use Dompdf\Dompdf;

class Pdf
{
    public function create($html,$filename)
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream($filename.'.pdf');
  }

  public function save_files($html,$filename)
  {
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $output = $dompdf->output();
        $dir = './documents/'.$filename.'/';
        if (!is_dir($dir)) {
                        mkdir($dir);
                    }
        file_put_contents($dir.'Loan_'.$filename.'.pdf', $output);
    }
}