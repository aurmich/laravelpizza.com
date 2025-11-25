<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Tables\Columns;

use Filament\Tables\Columns\ViewColumn;
use Modules\Notify\Enums\ContactTypeEnum;

/**
 * ContactColumn - Colonna Filament riutilizzabile per rendering contatti
<<<<<<< HEAD
 *
 * Utilizza ViewColumn + Blade view per separare completamente
 * logica e presentazione seguendo i principi DRY/KISS
 *
=======
 * 
 * Utilizza ViewColumn + Blade view per separare completamente 
 * logica e presentazione seguendo i principi DRY/KISS
 * 
>>>>>>> b19cd40 (.)
 * PATTERN CORRETTO:
 * - ViewColumn per layout complessi
 * - Blade view separata per HTML
 * - Accessibilità WCAG 2.1 AA compliant
<<<<<<< HEAD
 *
=======
 * 
>>>>>>> b19cd40 (.)
 * @author Laraxot Team
 * @version 2.0 - REFACTOR COMPLETO
 * @since 2025-01-06
 */
class ContactColumn extends ViewColumn
{
    /**
     * View Blade per il rendering della colonna
     */
    protected string $view = 'notify::filament.tables.columns.contact';
<<<<<<< HEAD

    protected function setUp(): void
    {
        parent::setUp();

        // Passa i tipi di contatto alla view
        $contact_types = ContactTypeEnum::cases();

        $this->view(static::getView(), [
            'contact_types' => $contact_types,
        ])
=======
    
    protected function setUp(): void
    {
        parent::setUp();
        
        // Passa i tipi di contatto alla view
        $contact_types = ContactTypeEnum::cases();
        
        $this->view(static::getView(), [
                'contact_types' => $contact_types,
            ])
>>>>>>> b19cd40 (.)
            ->label(__('notify::columns.contact.label'))
            ->searchable(ContactTypeEnum::getSearchable())
            ->sortable(false)
            ->toggleable(isToggledHiddenByDefault: false);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> b19cd40 (.)
