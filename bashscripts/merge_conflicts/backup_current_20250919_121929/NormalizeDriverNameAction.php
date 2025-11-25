<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\String;

use Spatie\QueueableAction\QueueableAction;
<<<<<<< HEAD

=======
>>>>>>> f1d4085 (.)
use function Safe\preg_replace;

/**
 * Action per normalizzare i nomi dei driver.
<<<<<<< HEAD
 *
=======
 * 
>>>>>>> f1d4085 (.)
 * Questa action centralizza la logica di normalizzazione dei nomi dei driver
 * per evitare duplicazione di codice e garantire consistenza in tutta l'applicazione.
 */
class NormalizeDriverNameAction
{
    use QueueableAction;

    /**
     * Normalizza il nome del driver eliminando caratteri non alfanumerici
     * e gestendo eventuali casi speciali/alias.
     *
     * @param string $driver Nome del driver da normalizzare
     * @return string Nome normalizzato
     */
    public function execute(string $driver): string
    {
        // Gestione speciale per driver con caratteri non alfanumerici (es. 360dialog)
        return preg_replace('/[^a-zA-Z0-9]/', '', ucfirst(strtolower($driver)));
    }
<<<<<<< HEAD
}
=======
} 
>>>>>>> f1d4085 (.)
