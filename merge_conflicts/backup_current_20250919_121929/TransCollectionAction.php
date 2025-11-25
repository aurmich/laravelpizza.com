<?php

declare(strict_types=1);

namespace Modules\Lang\Actions;

<<<<<<< HEAD
use Illuminate\Support\Collection;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;
=======

use Webmozart\Assert\Assert;
use Illuminate\Support\Collection;
use Spatie\QueueableAction\QueueableAction;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
>>>>>>> 8b0b6ac (.)

/**
 * Action per la traduzione di elementi di una collezione.
 */
class TransCollectionAction
{
    use QueueableAction;

<<<<<<< HEAD
    public null|string $transKey;
=======
    public ?string $transKey;
>>>>>>> 8b0b6ac (.)

    /**
     * Esegue la traduzione di una collezione.
     *
     * @param Collection<int|string, mixed> $collection
     * @param string|null $transKey
     *
     * @return Collection<int|string, string>
     */
<<<<<<< HEAD
    public function execute(Collection $collection, null|string $transKey): Collection
    {
        if (null === $transKey) {
            return $collection->map(SafeStringCastAction::cast(...));
=======
    public function execute(
        Collection $collection,
        ?string $transKey,
    ): Collection {
        if (null === $transKey) {
            return $collection->map(fn (mixed $item): string => SafeStringCastAction::cast($item));
>>>>>>> 8b0b6ac (.)
        }

        $this->transKey = $transKey;

<<<<<<< HEAD
        return $collection->map($this->trans(...));
=======
        return $collection->map(fn (mixed $item): string => $this->trans($item));
>>>>>>> 8b0b6ac (.)
    }

    /**
     * Traduce un singolo elemento.
     *
     * @param mixed $item L'elemento da tradurre
     *
     * @return string L'elemento tradotto o l'elemento originale se la traduzione non esiste
     */
    public function trans(mixed $item): string
    {
        // Converte l'item in stringa se non lo è già
        if (!\is_string($item)) {
            $item = SafeStringCastAction::cast($item);
        }

        if (empty($item) || null === $this->transKey) {
            return $item;
        }

        // Prima prova la traduzione diretta
<<<<<<< HEAD
        $key = $this->transKey . '.' . $item;
=======
        $key = $this->transKey.'.'.$item;
>>>>>>> 8b0b6ac (.)
        $trans = trans($key);

        // Se la traduzione esiste ed è una stringa, la restituisce
        if ($trans !== $key && \is_string($trans)) {
            return $trans;
        }

        // Seconda prova: sostituisce i punti con underscore
        $itemWithUnderscore = str_replace('.', '_', $item);
<<<<<<< HEAD
        $keyWithUnderscore = $this->transKey . '.' . $itemWithUnderscore;
=======
        $keyWithUnderscore = $this->transKey.'.'.$itemWithUnderscore;
>>>>>>> 8b0b6ac (.)
        $transWithUnderscore = trans($keyWithUnderscore);

        // Se la traduzione con underscore esiste ed è una stringa, la restituisce
        if ($transWithUnderscore !== $keyWithUnderscore && \is_string($transWithUnderscore)) {
            return $transWithUnderscore;
        }

        // Se nessuna traduzione è stata trovata, restituisce l'elemento originale
        return $item;
    }
}
