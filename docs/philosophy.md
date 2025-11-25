# Modulo Media - Filosofia, Religione, Politica, Zen

## 🎯 Panoramica

Il modulo Media è il sistema di gestione file e media per l'architettura Laraxot, responsabile dell'upload, storage, conversione e gestione di file multimediali. La sua filosofia è incentrata sulla **separazione storage/presentazione, la tracciabilità e la type safety**, garantendo che i file siano sempre gestiti in modo sicuro, efficiente e tracciabile.

## 🏛️ Filosofia: Media come Entità Indipendente

### Principio: Il File è un'Entità, Non un Attributo

La filosofia di Media si basa sull'idea che i file debbano essere gestiti come entità indipendenti con relazioni polimorfe, piuttosto che come attributi dei modelli. Questo permette riutilizzo, tracciabilità e gestione centralizzata.

- **Spatie MediaLibrary Integration**: Estensione diretta di `Spatie\MediaLibrary\MediaCollections\Models\Media` per compatibilità completa.
- **Polymorphic Relationships**: I file sono collegati ai modelli attraverso relazioni polimorfe (`morphTo`), permettendo flessibilità massima.
- **Collections**: Organizzazione dei file in collezioni (`collection_name`) per gestione logica.
- **Conversions**: Sistema di conversione automatica per immagini (thumbnails, formati diversi).

## 📜 Religione: La Sacra Ereditarietà Spatie

### Principio: Media Estende SpatieMedia, NON BaseModel

La "religione" di Media si manifesta nella rigorosa aderenza al principio Laraxot di estendere direttamente i modelli dei pacchetti vendor, piuttosto che interporre `BaseModel`. Questo garantisce la piena compatibilità con la logica interna di Spatie MediaLibrary.

- **Ereditarietà Diretta Spatie**: Il modello `Media` estende direttamente `Spatie\MediaLibrary\MediaCollections\Models\Media`. Questo garantisce la piena compatibilità con tutte le funzionalità di Spatie (collections, conversions, responsive images).
- **Trait per Funzionalità Laraxot**: Le funzionalità aggiuntive specifiche di Laraxot (es. `HasXotFactory`, `Updater`) vengono aggiunte tramite trait, evitando di modificare la catena di ereditarietà principale del vendor.
- **Connection Isolation**: `protected $connection = 'media'` garantisce l'isolamento dei dati media.

### Esempio: Ereditarietà di `Media`

```php
// Modules/Media/app/Models/Media.php
namespace Modules\Media\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;
use Modules\Xot\Models\Traits\HasXotFactory;
use Modules\Xot\Traits\Updater;

class Media extends SpatieMedia // Estende SpatieMedia direttamente
{
    use HasXotFactory;
    use Updater;

    /** @var string */
    protected $connection = 'media';

    /**
     * Relazione con il creatore del media.
     */
    public function creator(): BelongsTo
    {
        /** @var class-string<Model> $userClass */
        $userClass = XotData::make()->getUserClass();
        return $this->belongsTo($userClass, 'created_by');
    }

    /**
     * Relazione con TemporaryUpload per upload temporanei.
     */
    public function temporaryUpload(): BelongsTo
    {
        return $this->belongsTo(TemporaryUpload::class);
    }
}
```
Questa scelta architetturale è fondamentale per la "religione" di Media, garantendo che l'integrazione con Spatie MediaLibrary sia robusta e manutenibile.

## ⚖️ Politica: Type Safety e Tracciabilità (PHPStan Livello 10)

### Principio: Ogni File è Tracciato, Ogni Operazione è Type-Safe

La "politica" di Media è l'applicazione rigorosa della type safety e della tracciabilità, specialmente nella gestione degli upload e delle conversioni. Ogni file deve essere tracciato e ogni operazione deve essere type-safe.

- **PHPStan Livello 10**: Tutti i componenti del modulo Media devono passare l'analisi statica al livello massimo.
- **Creator/Updater Tracking**: Ogni file traccia chi l'ha creato e modificato attraverso `created_by` e `updated_by`.
- **Temporary Upload Management**: Gestione type-safe degli upload temporanei con validazione della sessione.
- **Conversion Type Safety**: Le conversioni sono gestite in modo type-safe attraverso `MediaConvert` model.

### Esempio: Temporary Upload e Session Validation

```php
// Modules/Media/app/Models/Media.php
class Media extends SpatieMedia
{
    /**
     * Trova media con TemporaryUpload nella sessione corrente.
     */
    public static function findWithTemporaryUploadInCurrentSession(array $uuids): EloquentCollection
    {
        return static::whereIn('uuid', $uuids)
            ->whereHasMorph('model', [TemporaryUpload::class], static fn (Builder $builder) => 
                $builder->where('session_id', session()->getId())
            )
            ->get();
    }

    /**
     * Relazione con TemporaryUpload.
     */
    public function temporaryUpload(): BelongsTo
    {
        return $this->belongsTo(TemporaryUpload::class);
    }
}
```
Questo approccio garantisce che gli upload temporanei siano validati per sessione, un aspetto cruciale della "politica" di Media.

## 🧘 Zen: Semplicità e Auto-Gestione

### Principio: Il File si Gestisce da Solo

Lo "zen" di Media si manifesta nella preferenza per l'auto-gestione e le convenzioni rispetto alla configurazione esplicita. Il modulo mira a rendere la gestione dei file il più trasparente possibile.

- **Auto-Discovery Collections**: Le collezioni sono scoperte automaticamente basandosi sul contesto.
- **Automatic Conversions**: Le conversioni sono eseguite automaticamente quando necessario.
- **URL Auto-Generation**: Gli URL dei file sono generati automaticamente, nascondendo i dettagli di storage.
- **Disk Abstraction**: L'astrazione del disco permette il cambio di storage senza modificare il codice che usa i media.

### Esempio: Auto-Gestione e URL Generation

```php
// Modules/Media/app/Models/Media.php
class Media extends SpatieMedia
{
    /**
     * Ottiene l'URL per una conversione specifica.
     */
    public function getUrlConv(string $conv): string
    {
        $url = $this->getUrl();
        $info = pathinfo($url);
        // Auto-generazione URL conversione
        return $info['dirname'].'/'.$info['filename'].'_'.$conv.'.'.$info['extension'];
    }

    /**
     * Relazione con le conversioni.
     */
    public function mediaConverts(): HasMany
    {
        return $this->hasMany(MediaConvert::class);
    }
}
```
Questo approccio incarna lo zen della semplicità, nascondendo la complessità della gestione dei file dietro un'interfaccia semplice.

## 📚 Riferimenti Interni

- [Documentazione Master del Progetto](../../../docs/project-master-analysis.md)
- [Filosofia Completa Laraxot](../../Xot/docs/philosophy-complete.md)
- [Regole Critiche di Architettura](../../Xot/docs/critical-architecture-rules.md)
- [Filosofia Ereditarietà Modelli Terze Parti](../../Xot/docs/third-party-model-inheritance-philosophy.md)
- [Documentazione Media README](./README.md)

