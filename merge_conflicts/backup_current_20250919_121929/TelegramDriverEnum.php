<?php

declare(strict_types=1);

namespace Modules\Notify\Enums;

/**
 * Enum per i driver Telegram supportati
<<<<<<< HEAD
 *
=======
 * 
>>>>>>> b19cd40 (.)
 * Questo enum centralizza la gestione dei driver Telegram disponibili
 * e fornisce metodi helper per ottenere le opzioni e le etichette.
 */
enum TelegramDriverEnum: string
{
    case TELEGRAM = 'telegram';
    case BOTAPI = 'botapi';
    case LARAVEL_TELEGRAM = 'laravel-telegram';
<<<<<<< HEAD

    /**
     * Restituisce le opzioni per il componente Select di Filament
     *
=======
    
    /**
     * Restituisce le opzioni per il componente Select di Filament
     * 
>>>>>>> b19cd40 (.)
     * @return array<string, string>
     */
    public static function options(): array
    {
        return [
            self::TELEGRAM->value => 'Telegram',
            self::BOTAPI->value => 'Bot API',
            self::LARAVEL_TELEGRAM->value => 'Laravel Telegram',
        ];
    }
<<<<<<< HEAD

    /**
     * Restituisce le etichette localizzate per il componente Select di Filament
     *
=======
    
    /**
     * Restituisce le etichette localizzate per il componente Select di Filament
     * 
>>>>>>> b19cd40 (.)
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::TELEGRAM->value => __('notify::telegram.drivers.telegram'),
            self::BOTAPI->value => __('notify::telegram.drivers.botapi'),
            self::LARAVEL_TELEGRAM->value => __('notify::telegram.drivers.laravel_telegram'),
        ];
    }
<<<<<<< HEAD

    /**
     * Verifica se un driver è supportato
     *
=======
    
    /**
     * Verifica se un driver è supportato
     * 
>>>>>>> b19cd40 (.)
     * @param string $driver
     * @return bool
     */
    public static function isSupported(string $driver): bool
    {
<<<<<<< HEAD
        return in_array($driver, array_column(self::cases(), 'value'), strict: true);
    }

    /**
     * Restituisce il driver predefinito dal file di configurazione
     *
=======
        return in_array($driver, array_column(self::cases(), 'value'));
    }
    
    /**
     * Restituisce il driver predefinito dal file di configurazione
     * 
>>>>>>> b19cd40 (.)
     * @return self
     */
    public static function getDefault(): self
    {
        $default = config('telegram.default', self::TELEGRAM->value);
<<<<<<< HEAD

=======
        
>>>>>>> b19cd40 (.)
        return self::from(is_string($default) ? $default : self::TELEGRAM->value);
    }
}
