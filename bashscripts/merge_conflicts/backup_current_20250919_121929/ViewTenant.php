<?php

/**
 * --.
 */
declare(strict_types=1);

namespace Modules\User\Filament\Resources\TenantResource\Pages;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> fbc8f8e (.)
use Filament\Schemas\Components\Section;
use Filament\Actions;
use Filament\Infolists\Components\TextEntry;
use Modules\User\Filament\Resources\TenantResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ViewTenant extends XotBaseViewRecord
{
    protected static string $resource = TenantResource::class;

    /**
<<<<<<< HEAD
     * @return array<string, Component>
     */
    #[Override]
    public function getInfolistSchema(): array
    {
        return [
            'tenant_info' => Section::make()->schema([
                TextEntry::make('id'),
                TextEntry::make('name'),
                TextEntry::make('slug'),
                TextEntry::make('created_at')->dateTime(),
                TextEntry::make('updated_at')->dateTime(),
            ]),
        ];
    }
=======
     * @return array<string, \Filament\Schemas\Components\Component>
     */
    public function getInfolistSchema(): array
    {
        return [
            'tenant_info' => Section::make()
                ->schema([
                    TextEntry::make('id'),
                    TextEntry::make('name'),
                    TextEntry::make('slug'),
                    TextEntry::make('created_at')
                        ->dateTime(),
                    TextEntry::make('updated_at')
                        ->dateTime(),
                ]),
        ];
    }

    
>>>>>>> fbc8f8e (.)
}
