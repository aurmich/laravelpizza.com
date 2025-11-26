# Sistema Blocks UI

## Panoramica

Il sistema Blocks del modulo UI permette di renderizzare collezioni di blocchi dinamici utilizzando componenti Blade riutilizzabili.

## Componente Blocks

Il componente `Modules\UI\View\Components\Render\Blocks` è responsabile del rendering di un array di blocchi.

### Utilizzo Base

```php
use Modules\UI\View\Components\Render\Blocks;

$blocksComponent = new Blocks(
    blocks: $blocksArray,
    model: $pageModel,
    tpl: 'v1' // o 'ui::components.render.blocks.v1' per percorso completo
);

return $blocksComponent->render();
```

### Parametri

- **blocks** (array): Array di blocchi da renderizzare
- **model** (Model|null): Modello opzionale da passare ai blocchi
- **tpl** (string): Template da utilizzare. Può essere:
  - Nome template semplice: `'v1'` (costruisce il percorso dal file chiamante)
  - Percorso view completo: `'ui::components.render.blocks.v1'` (utilizzato direttamente)

## GetViewAction Integration

Il componente utilizza `GetViewAction` per determinare la view corretta. Se viene passato un percorso view completo (contiene `::`), viene utilizzato direttamente senza processamento.

### Esempio con Template Name

```php
$blocksComponent = new Blocks($blocks, $model, 'v1');
// GetViewAction costruisce: 'ui::components.render.blocks.v1'
```

### Esempio con Percorso Completo

```php
$blocksComponent = new Blocks($blocks, $model, 'ui::components.render.blocks.v1');
// GetViewAction restituisce direttamente: 'ui::components.render.blocks.v1'
```

## View Template

La view template si trova in:
- `Modules/UI/resources/views/components/render/blocks/v1.blade.php`

### Struttura Template

```blade
@props(['blocks', 'model'])
@foreach ($blocks as $block)
    <x-render.block :block="$block" :model="$model" />
@endforeach
```

## Integrazione con CMS

Il modulo CMS utilizza il componente Blocks tramite `ThemeComposer`:

```php
use Modules\UI\View\Components\Render\Blocks;

$blocksComponent = new Blocks(
    $blocks,
    $page,
    'ui::components.render.blocks.v1'
);

return $blocksComponent->render();
```

## Best Practices

1. **Percorsi View Completi**: Quando si conosce esattamente la view da utilizzare, passare il percorso completo
2. **Template Names**: Per mantenere la flessibilità, utilizzare nomi template semplici
3. **Fallback**: Il sistema gestisce automaticamente il fallback tra tema pubblico e modulo

## Collegamenti

- [GetViewAction Fix](../../Xot/docs/actions/getviewaction-fix.md)
- [Cms Content Blocks System](../../Cms/docs/content-blocks-system.md)
- [Block Component](./blocks.md)


