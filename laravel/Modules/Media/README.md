# Modulo Media

## 📋 Panoramica

Il modulo Media gestisce l'upload, l'ottimizzazione e l'organizzazione di file multimediali nell'applicazione Laravel Pizza. Supporta immagini, documenti e altri tipi di file con funzionalità avanzate di gestione.

## 🚀 Installazione

Il modulo è già incluso nel progetto principale. Per verificare lo stato:

```bash
# Verifica se il modulo è attivo
php artisan module:list

# Abilita il modulo se necessario
php artisan module:enable Media
```

## 🎯 Funzionalità Principali

- **Upload Multiplo**: Supporto per upload di file multipli
- **Ottimizzazione Immagini**: Ridimensionamento e compressione automatica
- **Gestione Gallerie**: Organizzazione file in gallerie tematiche
- **CDN Integration**: Supporto per Content Delivery Networks
- **Watermark**: Applicazione watermark automatica
- **Thumbnail Generation**: Creazione automatica miniature
- **File Validation**: Validazione tipi file e dimensioni
- **Storage Management**: Gestione storage multiplo

## 🔧 Configurazione

### Configurazione Base
Il modulo si integra automaticamente con le configurazioni Laravel esistenti:

```php
// config/filesystems.php
'disks' => [
    'media' => [
        'driver' => 'local',
        'root' => storage_path('app/media'),
        'url' => env('APP_URL').'/storage/media',
        'visibility' => 'public',
    ],
],
```

### Configurazioni Specifiche
```php
// Modules/Media/config/media.php
return [
    'max_file_size' => 10240, // 10MB
    'allowed_mime_types' => [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/gif',
        'application/pdf',
    ],
    'image_optimization' => [
        'enabled' => true,
        'quality' => 85,
        'max_width' => 1920,
        'max_height' => 1080,
    ],
    'thumbnails' => [
        'small' => [150, 150],
        'medium' => [300, 300],
        'large' => [800, 600],
    ],
];
```

## 📁 Struttura

```
Modules/Media/
├── app/
│   ├── Actions/           # Business logic media
│   ├── Datas/             # Data objects media
│   ├── Filament/          # Admin panel resources
│   ├── Http/
│   │   ├── Controllers/   # Media controllers
│   │   └── Requests/      # Validation requests
│   ├── Models/            # Modelli media
│   ├── Providers/         # Service providers
│   └── Services/          # Servizi media
├── config/                # Configurazioni media
├── database/
│   ├── migrations/        # Tabelle media
│   └── seeders/
├── docs/                  # Documentazione
├── resources/
│   └── views/             # Componenti media
└── tests/                 # Test suite
```

## 🔗 Dipendenze

- **Xot**: Per base classes e utilities
- **Activity**: Per logging attività media
- **User**: Per gestione proprietari file

## 📚 Documentazione Correlata

- [Documentazione Tecnica](./docs/README.md)
- [Integration Guides](./docs/_integration/)

## 🎯 Esempi Utilizzo

### Upload File

```php
<?php

namespace Modules\Media\Services;

use Modules\Media\Datas\MediaData;
use Modules\Media\Models\Media;

class MediaService
{
    public function uploadFile(\Illuminate\Http\UploadedFile $file, array $data = []): Media
    {
        // Validazione file
        $this->validateFile($file);

        // Generazione nome file univoco
        $fileName = $this->generateFileName($file);
        $filePath = $file->storeAs('media', $fileName, 'public');

        // Ottimizzazione immagine se necessario
        if ($this->isImage($file)) {
            $this->optimizeImage($filePath);
            $this->generateThumbnails($filePath);
        }

        // Creazione record media
        $media = Media::create([
            'name' => $data['name'] ?? $file->getClientOriginalName(),
            'file_name' => $fileName,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'path' => $filePath,
            'disk' => 'public',
            'user_id' => auth()->id(),
        ]);

        return $media;
    }

    public function uploadMultiple(array $files, array $data = []): Collection
    {
        return collect($files)->map(function ($file) use ($data) {
            return $this->uploadFile($file, $data);
        });
    }
}
```

### Ottimizzazione Immagini

```php
<?php

namespace Modules\Media\Services;

use Intervention\Image\ImageManager;

class ImageOptimizationService
{
    public function __construct(
        private ImageManager $imageManager
    ) {}

    public function optimizeImage(string $filePath): void
    {
        $image = $this->imageManager->make(storage_path("app/public/{$filePath}"));

        // Ridimensionamento se necessario
        $maxWidth = config('media.image_optimization.max_width', 1920);
        $maxHeight = config('media.image_optimization.max_height', 1080);

        if ($image->width() > $maxWidth || $image->height() > $maxHeight) {
            $image->resize($maxWidth, $maxHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        // Compressione
        $quality = config('media.image_optimization.quality', 85);
        $image->save(storage_path("app/public/{$filePath}"), $quality);
    }

    public function generateThumbnails(string $filePath): array
    {
        $thumbnails = [];
        $image = $this->imageManager->make(storage_path("app/public/{$filePath}"));

        foreach (config('media.thumbnails', []) as $sizeName => $dimensions) {
            [$width, $height] = $dimensions;

            $thumbnail = $image->clone();
            $thumbnail->fit($width, $height);

            $thumbnailPath = $this->getThumbnailPath($filePath, $sizeName);
            $thumbnail->save(storage_path("app/public/{$thumbnailPath}"));

            $thumbnails[$sizeName] = $thumbnailPath;
        }

        return $thumbnails;
    }
}
```

### Gestione Gallerie

```php
<?php

namespace Modules\Media\Models;

use Modules\Xot\Models\XotBaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gallery extends XotBaseModel
{
    protected $fillable = [
        'name',
        'description',
        'slug',
        'is_public',
        'user_id',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function media(): BelongsToMany
    {
        return $this->belongsToMany(Media::class, 'gallery_media')
            ->withPivot(['order', 'caption'])
            ->orderBy('order');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
```

## 🔧 Comandi Artisan

```bash
# Pulisci file orfani
php artisan media:cleanup

# Rigenera thumbnails
php artisan media:thumbnails:regenerate

# Ottimizza immagini esistenti
php artisan media:optimize:images

# Migra storage
php artisan media:migrate-storage
```

## 📊 Monitoring

### Filament Admin Panel
Il modulo fornisce widget Filament per:
- Statistiche utilizzo storage
- Gestione file e gallerie
- Monitoraggio performance upload
- Report utilizzo media

### Storage Analytics
- Tracking spazio utilizzato
- Analisi tipi file
- Monitoraggio accessi file
- Report pulizia automatica

## 🐛 Troubleshooting

### Problemi Comuni

1. **Upload fallito**: Verifica permessi storage e dimensioni file
2. **Immagini non ottimizzate**: Controlla configurazione ImageOptimization
3. **Thumbnails mancanti**: Verifica generazione automatica

### Debug

```bash
# Verifica configurazione media
php artisan config:show media

# Test upload file
php artisan media:test-upload

# Analizza storage
php artisan media:analyze-storage
```

## 🔒 Sicurezza

- Validazione MIME types
- Limitazione dimensioni file
- Sanitizzazione nomi file
- Controllo accessi file
- Audit trail completo

---
**Modulo**: Media
**Versione**: 1.0
**Status**: ✅ Attivo
**PHPStan**: Level 10
**Documentazione**: Completa