<?php

declare(strict_types=1);

namespace Modules\UI\Forms\Components;

<<<<<<< HEAD
use Closure;
use Filament\Forms\Components\Field;

/**
 * Radio Card Selector Component
 *
=======
use Filament\Forms\Components\Field;
use Closure;

/**
 * Radio Card Selector Component
 * 
>>>>>>> 727968c (.)
 * Componente riutilizzabile per selezione tramite card radio.
 * Popola automaticamente un TextInput con il nome dell'elemento selezionato.
 */
class RadioCardSelector extends Field
{
    protected string $view = 'ui::forms.components.radio-card-selector';

    /**
     * @var array<int, array<string, mixed>>|Closure
     */
    protected array|Closure $cards = [];

    /**
     * @var string|null
     */
<<<<<<< HEAD
    protected null|string $sectionTitle = null;
=======
    protected ?string $sectionTitle = null;
>>>>>>> 727968c (.)

    /**
     * @var string|null
     */
<<<<<<< HEAD
    protected null|string $sectionSubtitle = null;
=======
    protected ?string $sectionSubtitle = null;
>>>>>>> 727968c (.)

    /**
     * @var string|null
     */
<<<<<<< HEAD
    protected null|string $targetFieldName = null;
=======
    protected ?string $targetFieldName = null;
>>>>>>> 727968c (.)

    /**
     * @var string|null
     */
<<<<<<< HEAD
    protected null|string $emptyStateTitle = null;
=======
    protected ?string $emptyStateTitle = null;
>>>>>>> 727968c (.)

    /**
     * @var string|null
     */
<<<<<<< HEAD
    protected null|string $emptyStateDescription = null;
=======
    protected ?string $emptyStateDescription = null;
>>>>>>> 727968c (.)

    /**
     * Imposta le card disponibili per la selezione.
     *
     * @param array<int, array<string, mixed>>|Closure $cards
     * @return static
     */
    public function cards(array|Closure $cards): static
    {
        $this->cards = $cards;

        return $this;
    }

    /**
     * Imposta il titolo della sezione.
     *
     * @param string|null $title
     * @return static
     */
<<<<<<< HEAD
    public function sectionTitle(null|string $title): static
=======
    public function sectionTitle(?string $title): static
>>>>>>> 727968c (.)
    {
        $this->sectionTitle = $title;

        return $this;
    }

    /**
     * Imposta il sottotitolo della sezione.
     *
     * @param string|null $subtitle
     * @return static
     */
<<<<<<< HEAD
    public function sectionSubtitle(null|string $subtitle): static
=======
    public function sectionSubtitle(?string $subtitle): static
>>>>>>> 727968c (.)
    {
        $this->sectionSubtitle = $subtitle;

        return $this;
    }

    /**
     * Campo da popolare quando si seleziona una card.
     *
     * @param string $fieldName
     * @return static
     */
    public function populatesField(string $fieldName): static
    {
        $this->targetFieldName = $fieldName;

        return $this;
    }

    /**
     * Imposta il titolo dello stato vuoto.
     *
     * @param string|null $title
     * @return static
     */
<<<<<<< HEAD
    public function emptyStateTitle(null|string $title): static
=======
    public function emptyStateTitle(?string $title): static
>>>>>>> 727968c (.)
    {
        $this->emptyStateTitle = $title;

        return $this;
    }

    /**
     * Imposta la descrizione dello stato vuoto.
     *
     * @param string|null $description
     * @return static
     */
<<<<<<< HEAD
    public function emptyStateDescription(null|string $description): static
=======
    public function emptyStateDescription(?string $description): static
>>>>>>> 727968c (.)
    {
        $this->emptyStateDescription = $description;

        return $this;
    }

    /**
     * Ottiene le card per la visualizzazione.
     *
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 727968c (.)
     */
    public function getCards(): array
    {
        $result = $this->evaluate($this->cards);
<<<<<<< HEAD

=======
        
>>>>>>> 727968c (.)
        return is_array($result) ? $result : [];
    }

    /**
     * Ottiene il titolo della sezione.
     *
     * @return string|null
     */
<<<<<<< HEAD
    public function getSectionTitle(): null|string
=======
    public function getSectionTitle(): ?string
>>>>>>> 727968c (.)
    {
        return $this->sectionTitle;
    }

    /**
     * Ottiene il sottotitolo della sezione.
     *
     * @return string|null
     */
<<<<<<< HEAD
    public function getSectionSubtitle(): null|string
=======
    public function getSectionSubtitle(): ?string
>>>>>>> 727968c (.)
    {
        return $this->sectionSubtitle;
    }

    /**
     * Ottiene il nome del campo target.
     *
     * @return string|null
     */
<<<<<<< HEAD
    public function getTargetFieldName(): null|string
=======
    public function getTargetFieldName(): ?string
>>>>>>> 727968c (.)
    {
        return $this->targetFieldName;
    }

    /**
     * Ottiene il titolo dello stato vuoto.
     *
     * @return string|null
     */
<<<<<<< HEAD
    public function getEmptyStateTitle(): null|string
=======
    public function getEmptyStateTitle(): ?string
>>>>>>> 727968c (.)
    {
        return $this->emptyStateTitle;
    }

    /**
     * Ottiene la descrizione dello stato vuoto.
     *
     * @return string|null
     */
<<<<<<< HEAD
    public function getEmptyStateDescription(): null|string
    {
        return $this->emptyStateDescription;
    }
}
=======
    public function getEmptyStateDescription(): ?string
    {
        return $this->emptyStateDescription;
    }
} 
>>>>>>> 727968c (.)
