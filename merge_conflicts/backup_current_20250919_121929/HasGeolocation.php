<?php

declare(strict_types=1);

namespace Modules\Geo\Contracts;

/**
 * Interfaccia per modelli che supportano la geolocalizzazione.
 */
interface HasGeolocation
{
    /**
     * Ottiene la latitudine.
     */
<<<<<<< HEAD
    public function getLatitude(): null|float;
=======
    public function getLatitude(): ?float;
>>>>>>> bc26394 (.)

    /**
     * Ottiene la longitudine.
     */
<<<<<<< HEAD
    public function getLongitude(): null|float;
=======
    public function getLongitude(): ?float;
>>>>>>> bc26394 (.)

    /**
     * Ottiene l'indirizzo formattato.
     */
<<<<<<< HEAD
    public function getFormattedAddress(): null|string;
=======
    public function getFormattedAddress(): ?string;
>>>>>>> bc26394 (.)

    /**
     * Verifica se le coordinate sono valide.
     */
    public function hasValidCoordinates(): bool;

    /**
     * Ottiene il tipo di luogo.
     */
<<<<<<< HEAD
    public function getLocationType(): null|string;
=======
    public function getLocationType(): ?string;
>>>>>>> bc26394 (.)

    /**
     * Ottiene l'icona per la mappa.
     */
<<<<<<< HEAD
    public function getMapIcon(): null|string;
=======
    public function getMapIcon(): ?string;
>>>>>>> bc26394 (.)
}
