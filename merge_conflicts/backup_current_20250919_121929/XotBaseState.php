<?php

declare(strict_types=1);

namespace Modules\Xot\States;

<<<<<<< HEAD
use Filament\Schemas\Components\Component;
use Override;
=======
>>>>>>> f1d4085 (.)
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Xot\Contracts\StateContract;
use Modules\Xot\Filament\Traits\TransTrait;
use Spatie\ModelStates\State;

/**
 * Abstract base class for appointment state management.
 *
 * Defines the state machine configuration and required methods
 * that must be implemented by each concrete state class.
 *
<<<<<<< HEAD
 * @property string $name  Il nome dello stato
=======
 * @property string $name Il nome dello stato
>>>>>>> f1d4085 (.)
 * @property string $value Il valore dello stato nel database
 */
abstract class XotBaseState extends State implements StateContract
{
    use TransTrait;

    public static string $name;

    public static function getName(): string
    {
        /* @phpstan-ignore-next-line */
        return static::$name ?? Str::of(class_basename(static::class))->snake()->toString();
    }

<<<<<<< HEAD
    #[Override]
    public function label(): string
    {
        return static::transClass(static::class, 'states.' . static::getName() . '.label');

        // return 'Annullato';
    }

    #[Override]
    public function color(): string
    {
        return static::transClass(static::class, 'states.' . static::getName() . '.color');
    }

    #[Override]
    public function bgColor(): string
    {
        return static::transClass(static::class, 'states.' . static::getName() . '.bg_color');

        // return 'info';
    }

    #[Override]
    public function icon(): string
    {
        return static::transClass(static::class, 'states.' . static::getName() . '.icon');

        // return 'heroicon-o-x-circle';
    }

    #[Override]
    public function modalHeading(): string
    {
        return static::transClass(static::class, 'states.' . static::getName() . '.modal_heading');

        // return 'Annulla Appuntamento';
    }

    #[Override]
=======
    public function label(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.label');
        // return 'Annullato';
    }

    public function color(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.color');
    }

    public function bgColor(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.bg_color');
        // return 'info';
    }

    public function icon(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.icon');
        // return 'heroicon-o-x-circle';
    }

    public function modalHeading(): string
    {
        return static::transClass(static::class, 'states.'.static::getName().'.modal_heading');
        // return 'Annulla Appuntamento';
    }

>>>>>>> f1d4085 (.)
    public function modalDescription(): string
    {
        $appointment = $this->getModel();

<<<<<<< HEAD
        return static::transClass(static::class, 'states.' . static::getName() . '.modal_description');

=======
        return static::transClass(static::class, 'states.'.static::getName().'.modal_description');
>>>>>>> f1d4085 (.)
        // return 'Sei sicuro di voler annullare questo appuntamento?';
    }

    /**
<<<<<<< HEAD
     * @return array<string, Component>
     */
    #[Override]
    public function modalFormSchema(): array
    {
        return [
            'message' => Textarea::make('message')->required()->maxLength(255),
=======
     * @return array<string, \Filament\Schemas\Components\Component>
     */
    public function modalFormSchema(): array
    {
        return [
            'message' => Textarea::make('message')
                ->required()
                ->maxLength(255),
>>>>>>> f1d4085 (.)
        ];
    }

    /**
     * Fill form data for modal.
     *
<<<<<<< HEAD
     * @param array<string, mixed> $arguments
     * @param array<string, mixed> $data
     *
=======
     * @param  array<string, mixed>  $arguments
     * @param  array<string, mixed>  $data
>>>>>>> f1d4085 (.)
     * @return array<string, mixed>
     */
    public function modalFillForm(array $arguments, array $data): array
    {
        return $data;
    }

    /**
     * Fill form data for modal by record.
     *
     * @return array<string, mixed>
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> f1d4085 (.)
    public function modalFillFormByRecord(Model $record): array
    {
        return [];
    }

    /**
     * Execute modal action.
     *
<<<<<<< HEAD
     * @param array<string, mixed> $arguments
     * @param array<string, mixed> $data
=======
     * @param  array<string, mixed>  $arguments
     * @param  array<string, mixed>  $data
>>>>>>> f1d4085 (.)
     */
    public function modalAction(array $arguments, array $data): void
    {
        $this->processStateAction($arguments, $data);
    }

    /**
     * Process state action.
     *
<<<<<<< HEAD
     * @param array<string, mixed> $arguments
     * @param array<string, mixed> $data
=======
     * @param  array<string, mixed>  $arguments
     * @param  array<string, mixed>  $data
>>>>>>> f1d4085 (.)
     */
    public function processStateAction(array $arguments, array $data): void
    {
        $message = Arr::get($data, 'message');
        $stateClass = static::class;
        /*
<<<<<<< HEAD
         *
         * $appointmentId = $arguments['appointment'];
         * $appointment = Appointment::firstWhere('id',$appointmentId);
         *
         * $appointment?->state->transitionTo($stateClass,$message);
         */
=======

        $appointmentId = $arguments['appointment'];
        $appointment = Appointment::firstWhere('id',$appointmentId);

        $appointment?->state->transitionTo($stateClass,$message);
        */
>>>>>>> f1d4085 (.)
        $record = $this->getModel();
        /* @phpstan-ignore-next-line */
        $record->state->transitionTo($stateClass, $message);
    }

    /**
     * Execute modal action by record.
     *
<<<<<<< HEAD
     * @param array<string, mixed> $data
     */
    #[Override]
=======
     * @param  array<string, mixed>  $data
     */
>>>>>>> f1d4085 (.)
    public function modalActionByRecord(Model $record, array $data): void
    {
        $this->processStateActionByRecord($record, $data);
    }

    /**
     * Process state action by record.
     *
<<<<<<< HEAD
     * @param array<string, mixed> $data
=======
     * @param  array<string, mixed>  $data
>>>>>>> f1d4085 (.)
     */
    public function processStateActionByRecord(Model $record, array $data): void
    {
        $message = Arr::get($data, 'message');
        $stateClass = static::class;
        /*
<<<<<<< HEAD
         *
         * $appointmentId = $arguments['appointment'];
         * $appointment = Appointment::firstWhere('id',$appointmentId);
         *
         * $appointment?->state->transitionTo($stateClass,$message);
         */
=======

        $appointmentId = $arguments['appointment'];
        $appointment = Appointment::firstWhere('id',$appointmentId);

        $appointment?->state->transitionTo($stateClass,$message);
        */
>>>>>>> f1d4085 (.)
        /* @phpstan-ignore-next-line */
        $record->state->transitionTo($stateClass, $message);
    }

    public function isMessageRequired(): bool
    {
        return false;
    }

    public static function getOptions(): array
    {
        $states = static::getStateMapping()->toArray();

<<<<<<< HEAD
        $states = Arr::map($states, fn($_stateClass, $state) => static::transClass(
            static::class,
            'states.' . $state . '.label',
        ));
=======
        $states = Arr::map($states, function ($stateClass, $state) {
            $stateStr = is_string($state) ? $state : (string) $state;

            return static::transClass(static::class, 'states.'.$stateStr.'.label');
        });
>>>>>>> f1d4085 (.)

        return $states;
    }
}
