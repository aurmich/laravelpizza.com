<?php

declare(strict_types=1);

namespace Modules\Xot\Filament\Resources\Pages;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Filament\Resources\Pages\EditRecord as FilamentEditRecord;
use Modules\Xot\Filament\Traits\TransTrait;
=======

use Filament\Schemas\Schema;
use Modules\Xot\Filament\Traits\TransTrait;
use Filament\Resources\Pages\EditRecord as FilamentEditRecord;
>>>>>>> f1d4085 (.)

abstract class XotBaseEditRecord extends FilamentEditRecord
{
    use TransTrait;

    /**
     * Configure the form.
     *
<<<<<<< HEAD
     * @param Schema $form The form instance to configure
     * @return Schema The configured form
=======
     * @param \Filament\Schemas\Schema $form The form instance to configure
     * @return \Filament\Schemas\Schema The configured form
>>>>>>> f1d4085 (.)
     */
    public function form(Schema $form): Schema
    {
        $schema = $this->getFormSchema();
<<<<<<< HEAD

=======
        
>>>>>>> f1d4085 (.)
        if (empty($schema)) {
            $resource = $this->getResource();
            $schema = $resource::getFormSchema();
        }
<<<<<<< HEAD

        // Ensure schema is properly typed for PHPStan level 10
        /** @var array<string|int, Component>|array<Component> $validSchema */
        $validSchema = $schema;

        return $form->components($validSchema);
    }

    /**
     * Get the form schema.
     *
     * @return array<string|int, Component>|array<Component>
=======
        
        // Ensure schema is properly typed for PHPStan level 10
        /** @var array<string|int, \Filament\Schemas\Components\Component>|array<\Filament\Schemas\Components\Component> $validSchema */
        $validSchema = $schema;
        
        return $form->components($validSchema);
    }
    
    /**
     * Get the form schema.
     *
     * @return array<string|int, \Filament\Schemas\Components\Component>|array<\Filament\Schemas\Components\Component>
>>>>>>> f1d4085 (.)
     */
    protected function getFormSchema(): array
    {
        return [];
    }

    public static function getNavigationLabel(): string
    {
        return static::transFunc(__FUNCTION__);
    }

    public static function getNavigationIcon(): string
    {
        return static::transFunc(__FUNCTION__);
    }
<<<<<<< HEAD
=======

>>>>>>> f1d4085 (.)
}
