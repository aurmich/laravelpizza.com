<?php

/*
 * @see https://github.com/masterix21/laravel-html2pdf/blob/master/src/PDF.php
 */

declare(strict_types=1);

namespace Modules\Xot\Datas;

use Exception;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Xot\Enums\PdfEngineEnum;
use Spatie\LaravelData\Data;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Enums\Orientation;
use Spatie\LaravelPdf\Enums\Unit;
use Spatie\LaravelPdf\Facades\Pdf;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Webmozart\Assert\Assert;
=======
use Illuminate\Support\Str;
use Spatie\LaravelData\Data;
use Spipu\Html2Pdf\Html2Pdf;
use Webmozart\Assert\Assert;
use Spatie\LaravelPdf\Enums\Unit;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\Enums\Format;
use Modules\Xot\Enums\PdfEngineEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelPdf\Enums\Orientation;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

>>>>>>> f1d4085 (.)

/**
 * Undocumented class.
 */
class PdfData extends Data
{
    /**
     * @var non-falsy-string
     */
    public string $filename = 'my_doc.pdf';

    public string $disk = 'cache';

    public string $out = 'download';

    // -- per costruttore
    public string $orientation = 'P';

    public string $format = 'A4';

    public string $lang = 'it';

    public bool $unicode = true;

    public string $encoding = 'UTF-8';

    public array $margins = [5, 5, 5, 8];

    public bool $pdfa = false;

    public string $dest = 'F';
    /*
<<<<<<< HEAD
     * Dest can be :
     * I : send the file inline to the browser (default). The plug-in is used if available. The name given by name is used when one selects the "Save as" option on the link generating the PDF.
     * D : send to the browser and force a file download with the name given by name.
     * F : save to a local server file with the name given by name.
     * S : return the document as a string (name is ignored).
     * FI: equivalent to F + I option
     * FD: equivalent to F + D option
     * E : return the document as base64 mime multi-part email attachment
     */

    // public static function make(Model $model = null, string $html = null): self

=======
        Dest can be :
        I : send the file inline to the browser (default). The plug-in is used if available. The name given by name is used when one selects the "Save as" option on the link generating the PDF.
        D : send to the browser and force a file download with the name given by name.
        F : save to a local server file with the name given by name.
        S : return the document as a string (name is ignored).
        FI: equivalent to F + I option
        FD: equivalent to F + D option
        E : return the document as base64 mime multi-part email attachment
        */

    // public static function make(Model $model = null, string $html = null): self


>>>>>>> f1d4085 (.)
    public PdfEngineEnum $engine = PdfEngineEnum::SPIPU;

    public string $html = '';

    public static function make(): self
    {
        return self::from([]);
    }

    public function getPath(): string
    {
        return Storage::disk($this->disk)->path($this->filename);
    }

    public function download(): BinaryFileResponse
    {
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($this->getPath(), $this->filename, $headers);
    }

    public function fromHtml(string $html): self
    {
        switch ($this->engine) {
            case PdfEngineEnum::SPIPU:
                $html2pdf = new Html2Pdf($this->orientation, $this->format, $this->lang);
                $html2pdf->writeHTML($html);
                $html2pdf->output($this->getPath(), $this->dest);
                break;
<<<<<<< HEAD

            /*
             * case PdfEngineEnum::SPATIE:
             * Pdf::html($this->html)
             * ->orientation(Orientation::Portrait)
             * ->format(Format::A4)
             * ->margins(10, 10, 20, 0, Unit::Pixel)
             * // ->name(str_slug($project->nome).'-REPORT.pdf')
             * ->save($this->getPath());
             * ;
             *
             * break;
             */
        }

=======
                /*
            case PdfEngineEnum::SPATIE:
                Pdf::html($this->html)
                ->orientation(Orientation::Portrait)
                ->format(Format::A4)
                ->margins(10, 10, 20, 0, Unit::Pixel)
                // ->name(str_slug($project->nome).'-REPORT.pdf')
                ->save($this->getPath());
                ;
                
                break;
                */
        }


>>>>>>> f1d4085 (.)
        $this->html = $html;
        // $this->engine->build($this);

        return $this;
    }

    public function fromModel(Model $model): self
    {
        $model_class = $model::class;
        $model_name = class_basename($model_class);
        $module = Str::between($model_class, '\Modules\\', '\Models');
        /**
         * @var non-falsy-string&view-string
         */
<<<<<<< HEAD
        $view_name = mb_strtolower($module) . '::' . Str::kebab($model_name) . '.show.pdf';
=======
        $view_name = mb_strtolower($module).'::'.Str::kebab($model_name).'.show.pdf';
>>>>>>> f1d4085 (.)
        $view_params = [
            'view' => $view_name,
            'row' => $model,
        ];
        $view = view($view_name, $view_params);
        $html = $view->render();

        return $this->fromHtml($html);
    }

    public function getContent(): string
    {
<<<<<<< HEAD
        Assert::notNull(
            $res = Storage::disk($this->disk)->get($this->filename),
            '[' . __LINE__ . '][' . class_basename($this) . ']',
        );
=======
        Assert::notNull($res = Storage::disk($this->disk)->get($this->filename), '['.__LINE__.']['.class_basename($this).']');
>>>>>>> f1d4085 (.)

        return $res;
    }

<<<<<<< HEAD
    public function view(string $view, array $params = []): self
    {
        if (!view()->exists($view)) {
            throw new Exception('View ' . $view . ' not found');
=======
    public function view(string $view, array $params=[]): self
    {
        if(!view()->exists($view)){
            throw new Exception('View '.$view.' not found');
>>>>>>> f1d4085 (.)
        }
        $out = view($view, $params);
        $this->html = $out->render();
        return $this->fromHtml($this->html);
    }

    public function setEngine(PdfEngineEnum $engine): self
    {
        $this->engine = $engine;
        return $this;
    }
}
