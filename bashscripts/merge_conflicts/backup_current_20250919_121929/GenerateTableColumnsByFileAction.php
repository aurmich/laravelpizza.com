<?php

/**
 * -WIP.
 */

declare(strict_types=1);

namespace Modules\Xot\Actions\Filament;

<<<<<<< HEAD
// use Filament\Forms\Commands\Concerns\CanGenerateForms; // Non disponibile in Filament v4
use Filament\Resources\Resource;
use Filament\Support\Commands\Concerns\CanReadModelSchemas;
// use Filament\Tables\Commands\Concerns\CanGenerateTables; // Non disponibile in Filament v4
=======
use Filament\Forms\Commands\Concerns\CanGenerateForms;
use Filament\Resources\Resource;
use Filament\Support\Commands\Concerns\CanReadModelSchemas;
use Filament\Tables\Commands\Concerns\CanGenerateTables;
>>>>>>> f1d4085 (.)
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File as LaravelFile;
use Illuminate\Support\Str;
use Modules\Xot\Actions\ModelClass\GetMethodBodyAction;
use Modules\Xot\Actions\String\GetStrBetweenStartsWithAction;
use Spatie\QueueableAction\QueueableAction;
use Symfony\Component\Finder\SplFileInfo as File;
use Webmozart\Assert\Assert;

class GenerateTableColumnsByFileAction
{
<<<<<<< HEAD
    // use CanGenerateForms; // Non disponibile in Filament v4

    // use CanGenerateImporterColumns;
    // use CanGenerateTables; // Non disponibile in Filament v4
=======
    use CanGenerateForms;

    // use CanGenerateImporterColumns;
    use CanGenerateTables;
>>>>>>> f1d4085 (.)
    use CanReadModelSchemas;
    use QueueableAction;

    /**
     * Genera colonne per tabelle e form Filament basate su un file di risorsa.
     *
     * @param File $file Il file della risorsa Filament
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> f1d4085 (.)
     * @return void
     */
    public function execute(File $file): void
    {
<<<<<<< HEAD
        if (!$file->isFile()) {
            return;
        }
        if (!\in_array($file->getExtension(), ['php'], false)) {
=======
        if (! $file->isFile()) {
            return;
        }
        if (! \in_array($file->getExtension(), ['php'], false)) {
>>>>>>> f1d4085 (.)
            return;
        }
        $filename = $file->getPathname();
        $class_name = Str::replace(base_path('Modules/'), 'Modules/', $filename);
<<<<<<< HEAD
        Assert::string(
            $class_name = Str::replace('/', '\\', $class_name),
            '[' . __LINE__ . '][' . class_basename($this) . ']',
        );
=======
        Assert::string($class_name = Str::replace('/', '\\', $class_name), '['.__LINE__.']['.class_basename($this).']');
>>>>>>> f1d4085 (.)
        $class_name = Str::substr($class_name, 0, -4);

        // Verifichiamo che la classe esista
        Assert::classExists($class_name);

        /** @var Resource $resourceInstance */
        $resourceInstance = app($class_name);

        // Verifichiamo che il metodo getModel esista
        if (!method_exists($resourceInstance, 'getModel')) {
            return;
        }

        /** @var string $modelClass */
        $modelClass = $resourceInstance->getModel();

        // Verifichiamo che la classe del modello esista
        Assert::classExists($modelClass);

        /** @var Model $modelInstance */
        $modelInstance = app($modelClass);

        // ------------------- TABLE -------------------
        // *
        $body = app(GetMethodBodyAction::class)->execute($class_name, 'table');
        $body1 = app(GetStrBetweenStartsWithAction::class)->execute($body, '->columns(', '(', ')');
<<<<<<< HEAD
        $body_new = '->columns([' . chr(13) . '// TODO: Generate table columns' . chr(13) . '])';
        $body_up = Str::of($body)->replace($body1, $body_new)->toString();
=======
        $body_new = '->columns(['.chr(13).$this->getResourceTableColumns($modelClass).chr(13).'])';
        $body_up = Str::of($body)
            ->replace($body1, $body_new)
            ->toString();
>>>>>>> f1d4085 (.)
        $content_new = Str::of($file->getContents())->replace($body, $body_up)->toString();
        LaravelFile::put($filename, $content_new);
        // -------------------- FORM ------------------------------
        $body = app(GetMethodBodyAction::class)->execute($class_name, 'form');
        $body1 = app(GetStrBetweenStartsWithAction::class)->execute($body, '->schema(', '(', ')');
<<<<<<< HEAD
        $body_new = '->schema([' . chr(13) . '// TODO: Generate form schema' . chr(13) . '])';
        $body_up = Str::of($body)->replace($body1, $body_new)->toString();
=======
        $body_new = '->schema(['.chr(13).$this->getResourceFormSchema($modelClass).chr(13).'])';
        $body_up = Str::of($body)
            ->replace($body1, $body_new)
            ->toString();
>>>>>>> f1d4085 (.)
        $content_new = Str::of($file->getContents())->replace($body, $body_up)->toString();
        LaravelFile::put($filename, $content_new);
        // -----------------------------------------------------

        // Verifichiamo che il metodo getFillable esista
        if (method_exists($modelInstance, 'getFillable')) {
            $fillable = $modelInstance->getFillable();

            // Verifichiamo che $fillable sia un array e contenga 'anno'
<<<<<<< HEAD
            if (is_array($fillable) && in_array('anno', $fillable, strict: true)) {
=======
            if (is_array($fillable) && in_array('anno', $fillable)) {
>>>>>>> f1d4085 (.)
                $body = app(GetMethodBodyAction::class)->execute($class_name, 'table');
                $body1 = app(GetStrBetweenStartsWithAction::class)->execute($body, '->filters(', '(', ')');
                $body_new = "->filters([
                        app(\Modules\Xot\Actions\Filament\Filter\GetYearFilter::class)->execute('anno',intval(date('Y')) - 3,intval(date('Y'))),
                    ],layout: \Filament\Tables\Enums\FiltersLayout::AboveContent)
                    ->persistFiltersInSession()";
<<<<<<< HEAD
                $body_up = Str::of($body)->replace($body1, $body_new)->toString();
=======
                $body_up = Str::of($body)
                    ->replace($body1, $body_new)
                    ->toString();
>>>>>>> f1d4085 (.)
                $content_new = Str::of($file->getContents())->replace($body, $body_up)->toString();
                LaravelFile::put($filename, $content_new);
            }
        }
<<<<<<< HEAD

=======
>>>>>>> f1d4085 (.)
        // */
    }

    /**
     * Mostra informazioni di debug su un file.
     *
     * @param File $file Il file da analizzare
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> f1d4085 (.)
     * @return void
     */
    public function ddFile(File $file): void
    {
        dd([
            'getRelativePath' => $file->getRelativePath(), // =  ""
            'getRelativePathname' => $file->getRelativePathname(), //  AssenzeResource.php
            'getFilenameWithoutExtension' => $file->getFilenameWithoutExtension(), // AssenzeResource
            // 'getContents' => $file->getContents(),
            'getPath' => $file->getPath(), // = /var/www/html/ptvx/laravel/Modules/Progressioni/Filament/Resources
            'getFilename' => $file->getFilename(), // = AssenzeResource.php
            'getExtension' => $file->getExtension(), // php
            'getBasename' => $file->getBasename(), // AssenzeResource.php
            'getPathname' => $file->getPathname(), // "/var/www/html/ptvx/laravel/Modules/Progressioni/Filament/resources/AssenzeResource.php
            'isFile' => $file->isFile(), // true
            'getRealPath' => $file->getRealPath(), // /var/www/html/ptvx/laravel/Modules/Progressioni/Filament/resources/AssenzeResource.php
            // 'getFileInfo' => $file->getFileInfo(),
            // 'getPathInfo' => $file->getPathInfo(),
            'methods' => get_class_methods($file),
        ]);
    }
}
