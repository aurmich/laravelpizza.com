<<<<<<< HEAD
<?php

declare(strict_types=1);

?>
=======
>>>>>>> 727968c (.)
@php
    $gridDirection = $getGridDirection() ?? 'column';
    $id = $getId();
    $isDisabled = $isDisabled();
    $isInline = $isInline();
    $statePath = $getStatePath();
@endphp

<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
<<<<<<< HEAD
    <div
        {{
=======
    <x-filament::grid
        :default="$getColumns('default')"
        :sm="$getColumns('sm')"
        :md="$getColumns('md')"
        :lg="$getColumns('lg')"
        :xl="$getColumns('xl')"
        :two-xl="$getColumns('2xl')"
        :is-grid="! $isInline"
        :direction="$gridDirection"
        :attributes="
>>>>>>> 727968c (.)
            \Filament\Support\prepare_inherited_attributes($attributes)
                ->merge($getExtraAttributes(), escape: false)
                ->class([
                    'fi-fo-radio gap-4',
                    '-mt-4' => (! $isInline) && ($gridDirection === 'column'),
                    'flex flex-wrap' => $isInline,
<<<<<<< HEAD
                    'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6' => ! $isInline,
                ])
        }}
=======
                ])
        "
>>>>>>> 727968c (.)
    >
        @foreach ($getOptions() as $value => $label)
            <div
                @class([
                    'break-inside-avoid pt-4' => (! $isInline) && ($gridDirection === 'column'),
                ])
            >
                <label class="flex gap-x-3">
                    <x-filament::input.radio
                        :valid="! $errors->has($statePath)"
                        :attributes="
                            \Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())
                                ->merge([
                                    'disabled' => $isDisabled || $isOptionDisabled($value, $label),
                                    'id' => $id . '-' . $value,
                                    'name' => $id,
                                    'value' => $value,
                                    'wire:loading.attr' => 'disabled',
                                    $applyStateBindingModifiers('wire:model') => $statePath,
                                ], escape: false)
                                ->class(['mt-1'])
                        "
                    />

                    <div class="grid text-sm leading-6">
                        <span class="font-medium text-gray-950 dark:text-white">
                            <x-filament::icon
                                class="h-2 w-2 text-gray-500 dark:text-gray-400"
                                style="width:32px;"
                                :icon="$label"
                            />
                            {!! $label !!}
                        </span>

                        @if ($hasDescription($value))
                            <p class="text-gray-500 dark:text-gray-400">
                                {{ $getDescription($value) }}
                            </p>
                        @endif
                    </div>
                </label>
            </div>
        @endforeach
<<<<<<< HEAD
    </div>
=======
    </x-filament::grid>
>>>>>>> 727968c (.)
</x-dynamic-component>
