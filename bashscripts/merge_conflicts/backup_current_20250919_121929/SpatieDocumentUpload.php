<?php

declare(strict_types=1);

namespace Modules\UI\Filament\Components;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

/**
 * Helper standardizzato per upload documenti usando Spatie Media Library.
<<<<<<< HEAD
 *
=======
 * 
>>>>>>> 727968c (.)
 * Filosofia: Centralizzazione della configurazione per garantire coerenza sistemica.
 * Politica: Type safety, GDPR compliance, multi-tenant isolation.
 * Zen: Semplicità attraverso la standardizzazione, non la duplicazione.
 */
class SpatieDocumentUpload
{
    /**
     * Configurazione base per upload documenti con collection specifica.
     *
     * @param string $name Nome del campo
     * @param string $collection Nome della media collection
     * @return SpatieMediaLibraryFileUpload
     */
    public static function make(string $name, string $collection): SpatieMediaLibraryFileUpload
    {
        return SpatieMediaLibraryFileUpload::make($name)
            ->collection($collection)
            ->disk('private') // Documenti sempre privati per GDPR compliance
            ->preserveFilenames()
            ->openable()
            ->downloadable()
            ->previewable()
            ->maxSize(10240) // 10MB - limite ragionevole per documenti
            ->acceptedFileTypes(['image/jpeg', 'image/png', 'application/pdf'])
            ->imagePreviewHeight('150');
    }

    /**
     * Upload documento identità - documento sensibile paziente.
<<<<<<< HEAD
     *
     * Collection: 'documenti_identita'
     * Security: Private disk, audit trail
     *
=======
     * 
     * Collection: 'documenti_identita'
     * Security: Private disk, audit trail
     * 
>>>>>>> 727968c (.)
     * @return SpatieMediaLibraryFileUpload
     */
    public static function forIdentityDocument(): SpatieMediaLibraryFileUpload
    {
        return static::make('identity_document', 'documenti_identita')
            ->maxSize(5120)
            ->conversion('thumbnail')
            ->conversion('preview');
    }

    /**
     * Upload certificazione ISEE - documento fiscale sensibile.
<<<<<<< HEAD
     *
     * Collection: 'certificazioni_isee'
     * Formats: Solo PDF per documenti ufficiali
     *
=======
     * 
     * Collection: 'certificazioni_isee'
     * Formats: Solo PDF per documenti ufficiali
     * 
>>>>>>> 727968c (.)
     * @return SpatieMediaLibraryFileUpload
     */
    public static function forIseeDocument(): SpatieMediaLibraryFileUpload
    {
        return static::make('isee_certificate', 'certificazioni_isee')
            ->acceptedFileTypes(['application/pdf'])
            ->maxSize(5120);
    }

    /**
     * Upload certificato gravidanza - documento medico sensibile.
<<<<<<< HEAD
     *
     * Collection: 'certificati_gravidanza'
     * GDPR: Retention policy automatica
     *
=======
     * 
     * Collection: 'certificati_gravidanza'
     * GDPR: Retention policy automatica
     * 
>>>>>>> 727968c (.)
     * @return SpatieMediaLibraryFileUpload
     */
    public static function forPregnancyDocument(): SpatieMediaLibraryFileUpload
    {
        return static::make('pregnancy_certificate', 'certificati_gravidanza')
            ->acceptedFileTypes(['application/pdf'])
            ->maxSize(5120);
    }

    /**
     * Upload certificazioni professionali mediche - documenti multipli.
<<<<<<< HEAD
     *
     * Collection: 'certificazioni_professionali'
     * Multiple: Supporta caricamento multiplo con riordinamento
     *
=======
     * 
     * Collection: 'certificazioni_professionali'
     * Multiple: Supporta caricamento multiplo con riordinamento
     * 
>>>>>>> 727968c (.)
     * @return SpatieMediaLibraryFileUpload
     */
    public static function forCertifications(): SpatieMediaLibraryFileUpload
    {
        return static::make('certifications', 'certificazioni_professionali')
            ->multiple()
            ->enableReordering()
            ->maxFiles(10) // Max 10 certificazioni per dottore
            ->acceptedFileTypes(['application/pdf'])
            ->maxSize(10240); // 10MB per certificazioni multiple
    }

    /**
     * Upload documento generico con collection personalizzata.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 727968c (.)
     * @param string $name Nome del campo
     * @param string $collection Nome della collection
     * @param array<string> $mimeTypes Tipi MIME accettati
     * @param int $maxSize Dimensione massima in KB
     * @return SpatieMediaLibraryFileUpload
     */
    public static function custom(
<<<<<<< HEAD
        string $name,
        string $collection,
        array $mimeTypes = ['image/jpeg', 'image/png', 'application/pdf'],
        int $maxSize = 10240,
=======
        string $name, 
        string $collection, 
        array $mimeTypes = ['image/jpeg', 'image/png', 'application/pdf'],
        int $maxSize = 10240
>>>>>>> 727968c (.)
    ): SpatieMediaLibraryFileUpload {
        return SpatieMediaLibraryFileUpload::make($name)
            ->collection($collection)
            ->disk('private')
            ->preserveFilenames()
            ->openable()
            ->downloadable()
            ->previewable()
            ->maxSize($maxSize)
            ->acceptedFileTypes($mimeTypes)
            ->imagePreviewHeight('150');
    }
<<<<<<< HEAD
}
=======
} 
>>>>>>> 727968c (.)
