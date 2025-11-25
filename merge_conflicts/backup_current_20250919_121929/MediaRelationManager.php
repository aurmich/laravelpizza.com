<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\HasMediaResource\RelationManagers;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
<<<<<<< HEAD
use Override;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Filament\Resources\HasMediaResource\Actions\AddAttachmentAction;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;

class MediaRelationManager extends XotBaseRelationManager
{
    protected static string $relationship = 'media';

    protected static null|string $inverseRelationship = 'model';
=======
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Filament\Resources\MediaResource;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;
use Modules\Xot\Filament\Resources\RelationManagers\XotBaseRelationManager;
use Modules\Media\Filament\Resources\HasMediaResource\Actions\AddAttachmentAction;

class MediaRelationManager extends XotBaseRelationManager
{


    protected static string $relationship = 'media';

    protected static ?string $inverseRelationship = 'model';




>>>>>>> 0a466ed (.)

    /**
     * @return array<string, Action|ActionGroup>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> 0a466ed (.)
    public function getTableHeaderActions(): array
    {
        return [
            'add_attachment' => AddAttachmentAction::make(),
        ];
    }
}
