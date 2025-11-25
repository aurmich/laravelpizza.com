<?php

declare(strict_types=1);

/**
 * Test che la classe MetatagData possa essere istanziata correttamente.
 * Questo test verifica che la classe possa essere istanziata senza errori.
 */
test('MetatagData può essere istanziata', function (): void {
    $metatagData = new MetatagData;
    expect($metatagData)->toBeInstanceOf(MetatagData::class);
});

/**
 * Test che il metodo getFilamentColors() restituisca i colori corretti.
 * Questo test verifica che il metodo getFilamentColors() restituisca un array
 * con i colori Filament corretti.
 */
test('getFilamentColors restituisce i colori Filament corretti', function (): void {
    $metatagData = new MetatagData;
    /** @phpstan-ignore-next-line method.nonObject */
    $colors = $metatagData->getFilamentColors();

    expect($colors)
        ->toBeArray()
        ->and($colors)
        ->toHaveKeys(['danger', 'gray', 'info', 'primary', 'success', 'warning'])
        /** @phpstan-ignore-next-line offsetAccess.nonOffsetAccessible */
        ->and($colors['danger'])
        ->toBe(Color::Red)
        /** @phpstan-ignore-next-line offsetAccess.nonOffsetAccessible */
        ->and($colors['primary'])
        ->toBe(Color::Amber);
});

/**
 * Test che il metodo getColors() gestisca correttamente i colori personalizzati.
 * Questo test verifica che il metodo getColors() gestisca correttamente i colori
 * personalizzati quando l'array colors contiene valori personalizzati.
 */
test('getColors gestisce correttamente i colori personalizzati', function (): void {
    $metatagData = new MetatagData;
    $metatagData->colors = [
        'custom_color' => [
            'key' => 'custom_color',
            'color' => 'custom',
            'hex' => '#FF5500',
        ],
        'primary' => [
            'key' => 'primary',
            'color' => 'amber',
        ],
    ];

    /** @phpstan-ignore-next-line method.nonObject */
    $colors = $metatagData->getColors();

    expect($colors)->toBeArray()->and($colors)->toHaveKey('custom_color')->and($colors)->toHaveKey('primary');
    expect($colors)->toBeArray()->and($colors)->toHaveKey('custom_color')->and($colors)->toHaveKey('primary');
});

/**
 * Test che il metodo getLogoHeight() restituisca il valore corretto.
 * Questo test verifica che il metodo getLogoHeight() restituisca il valore
 * della proprietà logo_height.
 */
test('getLogoHeight restituisce il valore corretto', function (): void {
    $metatagData = new MetatagData;
    $metatagData->logo_height = '3em';

    expect($metatagData->getLogoHeight())->toBe('3em');
});

/**
 * Test che le proprietà della classe abbiano i valori di default corretti.
 * Questo test verifica che le proprietà della classe abbiano i valori di default
 * corretti quando viene istanziata la classe.
 */
test('Le proprietà hanno i valori di default corretti', function (): void {
    $metatagData = new MetatagData;

    expect($metatagData->generator)
        ->toBe('xot')
        ->and($metatagData->charset)
        ->toBe('UTF-8')
        ->and($metatagData->author)
        ->toBe('xot')
        ->and($metatagData->logo_height)
        ->toBe('2em')
        ->and($metatagData->favicon)
        ->toBe('/favicon.ico');
});
