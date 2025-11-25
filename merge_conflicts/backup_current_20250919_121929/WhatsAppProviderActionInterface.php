<?php

declare(strict_types=1);

namespace Modules\Notify\Contracts;

use Modules\Notify\Datas\WhatsAppData;

/**
 * Interfaccia per le azioni dei provider WhatsApp.
<<<<<<< HEAD
 *
=======
 * 
>>>>>>> b19cd40 (.)
 * Questa interfaccia definisce il contratto che tutte le implementazioni
 * di provider WhatsApp devono rispettare.
 */
interface WhatsAppProviderActionInterface
{
    /**
     * Esegue l'invio del messaggio WhatsApp.
     *
     * @param WhatsAppData $whatsappData I dati del messaggio WhatsApp
     * @return array Risultato dell'operazione
     */
    public function execute(WhatsAppData $whatsappData): array;
<<<<<<< HEAD
}
=======
} 
>>>>>>> b19cd40 (.)
