<?php

declare(strict_types=1);

namespace Modules\Notify\Enums;

/**
 * Enum per i tipi di media supportati
<<<<<<< HEAD
 *
=======
 * 
>>>>>>> b19cd40 (.)
 * Questo enum centralizza la gestione dei tipi di media disponibili
 * e fornisce metodi helper per ottenere le opzioni e le etichette.
 */
enum MediaTypeEnum: string
{
    case IMAGE = 'image';
    case VIDEO = 'video';
    case DOCUMENT = 'document';
    case AUDIO = 'audio';
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
            self::IMAGE->value => 'Image',
            self::VIDEO->value => 'Video',
            self::DOCUMENT->value => 'Document',
            self::AUDIO->value => 'Audio',
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
            self::IMAGE->value => __('notify::whatsapp.media_types.image'),
            self::VIDEO->value => __('notify::whatsapp.media_types.video'),
            self::DOCUMENT->value => __('notify::whatsapp.media_types.document'),
            self::AUDIO->value => __('notify::whatsapp.media_types.audio'),
        ];
    }
<<<<<<< HEAD

    /**
     * Verifica se un tipo di media è supportato
     *
=======
    
    /**
     * Verifica se un tipo di media è supportato
     * 
>>>>>>> b19cd40 (.)
     * @param string $type
     * @return bool
     */
    public static function isSupported(string $type): bool
    {
<<<<<<< HEAD
        return in_array($type, array_column(self::cases(), 'value'), strict: true);
    }

    /**
     * Restituisce il tipo di media predefinito
     *
=======
        return in_array($type, array_column(self::cases(), 'value'));
    }
    
    /**
     * Restituisce il tipo di media predefinito
     * 
>>>>>>> b19cd40 (.)
     * @return self
     */
    public static function getDefault(): self
    {
        return self::IMAGE;
    }
}
