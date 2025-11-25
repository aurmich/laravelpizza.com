<?php

declare(strict_types=1);

namespace Modules\Media\Filament\Resources\HasMediaResource\Actions;

use Filament\Actions\Action;
use Exception;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;

class AddAttachmentAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();
<<<<<<< HEAD
        $this->icon('heroicon-o-plus')
            ->color('success')
            ->button()
            ->schema(fn(): array => static::getFormSchema(false))
            ->action(static::formHandlerCallback(...));
=======
        $this
            ->icon('heroicon-o-plus')
            ->color('success')
            ->button()
            ->form(
                fn (): array => static::getFormSchema(false)
            )
            ->action(
                fn (RelationManager $livewire, array $data) => static::formHandlerCallback($livewire, $data),
            );
>>>>>>> 0a466ed (.)
    }

    public static function trans(string $key): string
    {
<<<<<<< HEAD
        Assert::string(
            $ris = trans('media::add_attachment_action.' . $key),
            '[' . $key . '][' . __LINE__ . '][' . class_basename(__CLASS__) . ']',
        );
=======
        Assert::string($ris = trans('media::add_attachment_action.'.$key), '['.$key.']['.__LINE__.']['.class_basename(__CLASS__).']');
>>>>>>> 0a466ed (.)

        return $ris;
    }

<<<<<<< HEAD
    public static function getDefaultName(): null|string
=======
    public static function getDefaultName(): ?string
>>>>>>> 0a466ed (.)
    {
        return 'add_attachment';
    }

    /**
     * @return array<int, Radio|TextInput|BaseFileUpload|FileUpload>
     */
    public static function getFormSchema(bool $asset = true): array
    {
        // Assert::string($disk = $asset ? config('xra.asset.attachments.disk.driver') : config('xra.operation.attachments.disk.driver'));
        // Assert::isArray($file_types = $asset ? config('xra.asset.attachments.allowed_file_types') : config('xra.operation.attachments.allowed_file_types'));
        Assert::integer($max_size = config('media-library.max_file_size'));

        return [
            FileUpload::make('file')
                ->hint(static::trans('fields.file_hint'))
                ->storeFileNamesIn('original_file_name')
                // ->disk($disk)
                // ->acceptedFileTypes($file_types)
                ->visibility('private')
                ->maxSize($max_size)
                ->required()
                ->columnSpanFull(),
            /*
<<<<<<< HEAD
             * Radio::make('attachment_type')
             * ->hiddenLabel()
             * ->options(
             * AttachmentTypeEnum::descriptionsByValue($asset ? AttachmentTypeEnum::cases() : AttachmentTypeEnum::operationCases()),
             * )
             * ->default(AttachmentTypeEnum::Image())
             * ->columns(
             * $asset ? \count(AttachmentTypeEnum::cases()) : \count(AttachmentTypeEnum::operationCases()),
             * )
             * ->required()
             * ->columnSpanFull(),
             */
=======
            Radio::make('attachment_type')
                ->hiddenLabel()
                ->options(
                    AttachmentTypeEnum::descriptionsByValue($asset ? AttachmentTypeEnum::cases() : AttachmentTypeEnum::operationCases()),
                )
                ->default(AttachmentTypeEnum::Image())
                ->columns(
                    $asset ? \count(AttachmentTypeEnum::cases()) : \count(AttachmentTypeEnum::operationCases()),
                )
                ->required()
                ->columnSpanFull(),
            */
>>>>>>> 0a466ed (.)
            // Radio::make('attachment_type')->columnSpanFull(),
            TextInput::make('name')
                ->hint(static::trans('fields.name_hint'))
                ->autocomplete(false)
                ->maxLength(255)
                ->columnSpanFull(),
        ];
    }

    public static function formHandlerCallback(RelationManager $livewire, array $data): void
    {
        $ownerRecord = $livewire->getOwnerRecord();
        $mediaCollection = $data['attachment_type'] ?? 'default';
        // $mediaCollection = 'default';

<<<<<<< HEAD
        if (!method_exists($ownerRecord, 'addMediaFromDisk')) {
=======
        if (! method_exists($ownerRecord, 'addMediaFromDisk')) {
>>>>>>> 0a466ed (.)
            throw new Exception('wip');
        }

        $attachment = $ownerRecord
<<<<<<< HEAD
            ->addMediaFromDisk($data['file'], config('attachment.upload.disk.driver'))
            ->setName($data['name'] ?? Str::beforeLast($data['original_file_name'], '.'))
=======
            ->addMediaFromDisk(
                $data['file'],
                config('attachment.upload.disk.driver'),
            )
            ->setName(
                $data['name'] ?? Str::beforeLast($data['original_file_name'], '.'),
            )
>>>>>>> 0a466ed (.)
            ->preservingOriginal()
            ->toMediaCollection($mediaCollection);

        $user_id = authId();
<<<<<<< HEAD
        $attachment->update([
            'created_by' => $user_id,
            'updated_by' => $user_id,
        ]);

        /*
         * $attachment->created_by=$user_id;
         * $attachment->created_by=$user_id;
         * $attachment->save();
         */
=======
        $attachment->update(
            [
                'created_by' => $user_id,
                'updated_by' => $user_id,
            ]
        );
        /*
        $attachment->created_by=$user_id;
        $attachment->created_by=$user_id;
        $attachment->save();
        */
>>>>>>> 0a466ed (.)
    }
}
