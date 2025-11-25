<?php

/**
 * @see https://github.com/husam-tariq/filament-database-schedule/blob/main/src/Filament/resources/ScheduleResource.php
 */

declare(strict_types=1);

namespace Modules\Job\Filament\Resources;

<<<<<<< HEAD
use Override;
=======
>>>>>>> e1b0bf9 (.)
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Job\Actions\Command\GetCommandsAction;
use Modules\Job\Datas\CommandData;
use Modules\Job\Filament\Resources\ScheduleResource\Pages\CreateSchedule;
use Modules\Job\Filament\Resources\ScheduleResource\Pages\EditSchedule;
use Modules\Job\Filament\Resources\ScheduleResource\Pages\ListSchedules;
use Modules\Job\Filament\Resources\ScheduleResource\Pages\ViewSchedule;
use Modules\Job\Models\Schedule;
use Modules\Job\Rules\Corn;
use Modules\Xot\Filament\Resources\XotBaseResource;
use Spatie\LaravelData\DataCollection;
use Webmozart\Assert\Assert;

class ScheduleResource extends XotBaseResource
{
<<<<<<< HEAD
    protected static null|string $model = Schedule::class;
=======
    protected static ?string $model = Schedule::class;
>>>>>>> e1b0bf9 (.)

    protected static bool $shouldRegisterNavigation = true;

    /** @var DataCollection<CommandData> */
    protected static DataCollection $commands;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

<<<<<<< HEAD
    #[Override]
=======
>>>>>>> e1b0bf9 (.)
    public static function getPages(): array
    {
        return [
            'index' => ListSchedules::route('/'),
            'create' => CreateSchedule::route('/create'),
            'edit' => EditSchedule::route('/{record}/edit'),
            'view' => ViewSchedule::route('/{record}'),
        ];
    }

<<<<<<< HEAD
    #[Override]
=======
>>>>>>> e1b0bf9 (.)
    public static function getFormSchema(): array
    {
        static::$commands = app(GetCommandsAction::class)->execute();
        $commands_opts = static::$commands->toCollection()->pluck('full_name', 'name')->toArray();

        return [
            'main_section' => Section::make([
                Select::make('command')
<<<<<<< HEAD
                    ->options(fn() => $commands_opts)
=======
                    ->options(fn () => $commands_opts)
>>>>>>> e1b0bf9 (.)
                    ->reactive()
                    ->searchable()
                    ->required()
                    ->afterStateUpdated(function (Set $set, $state): void {
<<<<<<< HEAD
                        Assert::isInstanceOf(
                            $command = static::$commands->where('name', $state)->first(),
                            CommandData::class,
                        );
=======
                        Assert::isInstanceOf($command = static::$commands->where('name', $state)->first(), CommandData::class);
>>>>>>> e1b0bf9 (.)
                        $params = $command->arguments;
                        $options_with_value = $command->options['withValue'] ?? [];
                        $set('params', $params);
                        $set('options_with_value', $options_with_value);
                    }),
                Repeater::make('params')
                    ->schema([
                        Hidden::make('name'),
                        TextInput::make('value')
<<<<<<< HEAD
                            ->label(fn(Get $get): mixed => $get('name'))
                            ->required(fn(Get $get): mixed => $get('required')),
=======
                            ->label(fn (Get $get): mixed => $get('name'))
                            ->required(fn (Get $get): mixed => $get('required')),
>>>>>>> e1b0bf9 (.)
                    ])
                    ->addable(false)
                    ->deletable(false)
                    ->reorderable(false),
                Repeater::make('options_with_value')
                    ->schema([
                        Hidden::make('name'),
<<<<<<< HEAD
                        Hidden::make('type')->default('string'),
                        TextInput::make('value')
                            ->label(fn(Get $get): mixed => $get('name'))
                            ->required(fn(Get $get): mixed => $get('required')),
=======
                        Hidden::make('type')
                            ->default('string'),
                        TextInput::make('value')
                            ->label(fn (Get $get): mixed => $get('name'))
                            ->required(fn (Get $get): mixed => $get('required')),
>>>>>>> e1b0bf9 (.)
                    ])
                    ->addable(false)
                    ->deletable(false)
                    ->reorderable(false),
                TextInput::make('expression')
                    ->placeholder('* * * * *')
<<<<<<< HEAD
                    ->rules([new Corn()])
                    ->required(),
                TagsInput::make('environments')->placeholder(null),
                TextInput::make('log_filename')->helperText(static::trans('messages.help-log-filename')),
=======
                    ->rules([new Corn])
                    ->required(),
                TagsInput::make('environments')
                    ->placeholder(null),
                TextInput::make('log_filename')
                    ->helperText(static::trans('messages.help-log-filename')),
>>>>>>> e1b0bf9 (.)
                TextInput::make('webhook_before'),
                TextInput::make('webhook_after'),
                TextInput::make('email_output'),
                Toggle::make('sendmail_success'),
                Toggle::make('sendmail_error'),
<<<<<<< HEAD
                Toggle::make('log_success')->default(true),
                Toggle::make('log_error')->default(true),
=======
                Toggle::make('log_success')
                    ->default(true),
                Toggle::make('log_error')
                    ->default(true),
>>>>>>> e1b0bf9 (.)
                Toggle::make('even_in_maintenance_mode'),
                Toggle::make('without_overlapping'),
                Toggle::make('on_one_server'),
                Toggle::make('run_in_background'),
            ])->inlineLabel(false),
        ];
    }

<<<<<<< HEAD
    #[Override]
    public static function getRelations(): array
    {
        return [
            
=======
    public static function getRelations(): array
    {
        return [
            //
>>>>>>> e1b0bf9 (.)
        ];
    }
}
