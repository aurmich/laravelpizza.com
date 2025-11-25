<?php

declare(strict_types=1);

namespace Modules\User\Filament\Resources\TeamResource\Pages;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> fbc8f8e (.)
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Modules\User\Filament\Resources\TeamResource;
use Modules\Xot\Filament\Resources\Pages\XotBaseViewRecord;

class ViewTeam extends XotBaseViewRecord
{
    // //
    protected static string $resource = TeamResource::class;

    /**
<<<<<<< HEAD
     * @return array<Component>
     */
    #[Override]
    public function getInfolistSchema(): array
    {
        return [
            Section::make()->schema([
                TextEntry::make('id'),
                TextEntry::make('name'),
                TextEntry::make('display_name'),
                TextEntry::make('description'),
                TextEntry::make('created_at'),
                TextEntry::make('updated_at'),
            ]),
        ];
    }
=======
     * @return array<\Filament\Schemas\Components\Component>
     */
    public function getInfolistSchema(): array
    {
        return [
            Section::make()
                ->schema([
                    TextEntry::make('id'),
                    TextEntry::make('name'),
                    TextEntry::make('display_name'),
                    TextEntry::make('description'),
                    TextEntry::make('created_at'),
                    TextEntry::make('updated_at'),
                ])
        ];
    }

   
>>>>>>> fbc8f8e (.)
}
