<?php

declare(strict_types=1);

namespace Modules\Xot\Services;

// use Maatwebsite\Excel\Facades\Excel;
// use PHPExcel;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use Mpdf\Mpdf;
use Illuminate\Support\Facades\Storage;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

/*
<<<<<<< HEAD
 * ExceptionFormatter
 * HtmlParsingException
 * ImageException
 * LocaleException
 * LongSentenceException
 * TableException
 */
=======
ExceptionFormatter
HtmlParsingException
ImageException
LocaleException
LongSentenceException
TableException
*/
>>>>>>> f1d4085 (.)

/**
 * Class HtmlService.
 */
class HtmlService
{
<<<<<<< HEAD
    public static function toPdf(
        string $html,
        string $out = 'show',
        string $pdforientation = 'L',
        string $filename = '',
    ): string {
=======
    public static function toPdf(string $html, string $out = 'show', string $pdforientation = 'L', string $filename = ''): string
    {
>>>>>>> f1d4085 (.)
        // dddx($params);

        // include_once __DIR__.'/vendor/autoload.php';
        // $pdforientation = 'L'; // default;
        // $out = 'show';
        if ('' === $filename) {
            $filename = Storage::disk('local')->path('test.pdf');
        }
        /*
<<<<<<< HEAD
         * extract($params);
         * if (! isset($html)) {
         * throw new \Exception('err html is missing');
         * }
         */
=======
        extract($params);
        if (! isset($html)) {
            throw new \Exception('err html is missing');
        }
        */
>>>>>>> f1d4085 (.)
        if (request('debug', false)) {
            return $html;
        }

        try {
            $html2pdf = new Html2Pdf($pdforientation, 'A4', 'it');
            $html2pdf->setTestTdInOnePage(false);
            $html2pdf->WriteHTML($html);
            if ('content_PDF' === $out) {
<<<<<<< HEAD
                return $html2pdf->Output($filename . '.pdf', 'S');
=======
                return $html2pdf->Output($filename.'.pdf', 'S');
>>>>>>> f1d4085 (.)
            }

            if ('file' === $out) {
                $html2pdf->Output($filename, 'F');

                return $filename;
            }

            return $html2pdf->Output();
        } catch (Html2PdfException $html2PdfException) {
            $html2pdf->clean();

            $formatter = new ExceptionFormatter($html2PdfException);
            dddx($formatter->getHtmlMessage());
            echo $formatter->getHtmlMessage();
        }

        // } catch (HTML2PDF_exception $e) {
        // } catch (Html2PdfException $e) {
        //    echo '<pre>';
        //    \print_r($e);
        //    echo '</pre>';
        // }
        return $filename;
    }

    /*
<<<<<<< HEAD
     * public static function toMpdf($html): string {
     * require_once __DIR__.'/vendor/autoload.php';
     *
     * $mpdf = new Mpdf();
     * $mpdf->WriteHTML($html);
     *
     * return $mpdf->Output();
     * }
     */
=======
    public static function toMpdf($html): string {
        require_once __DIR__.'/vendor/autoload.php';

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        return $mpdf->Output();
    }
    */
>>>>>>> f1d4085 (.)
}
