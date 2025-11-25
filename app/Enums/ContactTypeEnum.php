<?php

declare(strict_types=1);

namespace Modules\Notify\Enums;

use Filament\Forms\Components\TextInput;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Illuminate\Support\Arr;
use Modules\Xot\Filament\Traits\TransTrait;

/**
 * Enum per i driver SMS supportati
 *
 * Questo enum centralizza la gestione dei driver SMS disponibili
 * e fornisce metodi helper per ottenere le opzioni e le etichette.
 */
enum ContactTypeEnum: string implements HasLabel, HasIcon, HasColor
{
    use TransTrait;

    case PHONE = 'phone';
    case MOBILE = 'mobile';
    case EMAIL = 'email';
    case PEC = 'pec';
    case WHATSAPP = 'whatsapp';
    case FAX = 'fax';

    public function getLabel(): string
    {
        return $this->transClass(self::class, $this->value . '.label');
    }

    public function getColor(): string
    {
        return $this->transClass(self::class, $this->value . '.color');
    }

    public function getIcon(): string
    {
        return $this->transClass(self::class, $this->value . '.icon');
    }

    public function getDescription(): string
    {
        return $this->transClass(self::class, $this->value . '.description');
    }

    /**
     * @return array<string>
     */
    public static function getSearchable(): array
    {
        return array_map(fn($item) => $item->value, ContactTypeEnum::cases());
    }

    /**
     * @return array<string, \Filament\Forms\Components\TextInput>
     */
    public static function getFormSchema(): array
    {
        // ContactTypeEnum::cases() restituisce un array shape specifico, non list<ContactTypeEnum>
        $cases = ContactTypeEnum::cases();
        /** @var array<string, \Filament\Forms\Components\TextInput> $result */
        $result = [];
        foreach ($cases as $item) {
            $result[$item->value] = TextInput::make($item->value)->prefixIcon($item->getIcon());
        }
        return $result;
    }
}
