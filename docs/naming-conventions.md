```bash
# Rimuovere duplicato lowercase
rm tests/Feature/fixstructuretest.pest.php

# Verificare che PascalCase esista
ls tests/Feature/FixStructureTest.pest.php
```

## Pattern di Naming Completo

### Test Files
- Feature tests: `{FeatureName}Test.pest.php`
- Integration tests: `{ServiceName}IntegrationTest.php`
- Unit tests: `{TraitName}Test.php`

### Models, Services, Actions
- Models: `PascalCase` (User.php, Module.php)
- Services: `PascalCase + Service` (ModuleService.php)
- Actions: `PascalCase + Action` (SafeStringCastAction.php)
- Traits: `PascalCase + Trait` (HasExtraTrait.php)

### Variables & Methods
- Variables: `camelCase` ($moduleName, $isEnabled)
- Methods: `camelCase` (getModels(), setName())
- Constants: `UPPER_SNAKE_CASE` (MAX_RETRIES)

### Directories
- Sempre PascalCase per namespace: `app/Models/`, `app/Services/`
- Mai lowercase: `app/models/` ❌

## Verifica Duplicati

```bash
# Trova duplicati case-insensitive
find tests/ -iname "fixstructuretest*"

# Trova file test non PascalCase
find tests/ -name "*test.php" -o -name "*Test.php" | grep -v "[A-Z]"
```

## Checklist Pre-Commit

- [ ] Tutti i file test sono PascalCase?
- [ ] Nessun duplicato con diverse capitalizzazioni?
- [ ] Namespace corrispondono ai path?
- [ ] PHPStan passa senza errori?

---

**Regola d'oro**: File duplicati? **Mantieni PascalCase, elimina tutto il resto.**

**Data**: Ottobre 2025

---

## 🚨 Duplicati Case-Sensitivity - Regola Generale

### Problema Identificato (Novembre 2025)

Trovati **228 file duplicati** con case diverso in tutto il progetto:
- File documentazione: `LICENSE.md` vs `license.md`
- File Blade: `contentStart.blade.php` vs `contentstart.blade.php`
- File Vue/JS/CSS: `MapComponent.vue` vs `mapcomponent.vue`
- File build artifacts duplicati

### ✅ Regola Universale di Naming

#### File Documentazione
- **Mantenere**: `UPPERCASE.md` / `UPPERCASE.yml`
  - ✅ `LICENSE.md`, `CONTRIBUTING.md`, `SECURITY.md`, `FUNDING.yml`
- **Rimuovere**: `lowercase.md` / `lowercase.yml`
  - ❌ `license.md`, `contributing.md`, `security.md`, `funding.yml`

#### File Blade Templates
- **Mantenere**: `camelCase.blade.php`
  - ✅ `contentStart.blade.php`, `contentEnd.blade.php`, `wideImage.blade.php`
- **Rimuovere**: `lowercase.blade.php`
  - ❌ `contentstart.blade.php`, `contentend.blade.php`, `wideimage.blade.php`

#### File Vue/JS/CSS
- **Mantenere**: `CamelCase` o `PascalCase`
  - ✅ `MapComponent.vue`, `MyMap.vue`, `MarkerCluster.css`
- **Rimuovere**: `lowercase`
  - ❌ `mapcomponent.vue`, `mymap.vue`, `markercluster.css`

#### File PHP
- **Mantenere**: `PascalCase.php`
  - ✅ `UserResource.php`, `BaseModel.php`
- **Rimuovere**: `lowercase.php` / file backup lowercase
  - ❌ `userresource.php`, `basemodel.php`

#### Directory Build/Dist
- **Rimuovere**: TUTTE le directory `build/` e `dist/`
  - Sono file generati, non devono essere versionati
  - Aggiungere a `.gitignore`

### Script di Verifica

```bash
# Trova duplicati case-insensitive in Modules
cd /var/www/_bases/base_<nome progetto>_fila4_mono/laravel

python3 << 'PYSCRIPT'
import os
from collections import defaultdict

for root, dirs, files in os.walk('Modules'):
    if any(skip in root for skip in ['/vendor/', '/node_modules/', '/.git/']):
        continue
    
    name_map = defaultdict(list)
    for file in files:
        if file in ['README.md', 'readme.md', '.gitignore']:
            continue
        lower_name = file.lower()
        name_map[lower_name].append(file)
    
    for lower_name, file_list in name_map.items():
        if len(file_list) > 1:
            unique_names = set(file_list)
            if len(unique_names) > 1:
                print(f"📁 {root}")
                for name in sorted(unique_names):
                    print(f"  - {name}")
PYSCRIPT
```

### Azione Correttiva Applicata

**Data**: Novembre 2025  
**File rimossi**: 228  
**Duplicati risolti**: 100%  

Pattern di rimozione:
1. File documentazione: mantenuti UPPERCASE, rimossi lowercase
2. File Blade: mantenuti camelCase, rimossi lowercase
3. File Vue/JS/CSS: mantenuti CamelCase, rimossi lowercase
4. Directory build/dist: TUTTE rimosse

### Prevenzione Futura

Aggiungere a `.gitignore`:
```gitignore
# Build artifacts
**/build/
**/dist/

# Temp files
**/*.test
**/*.wip
**/*.fixed
**/*.no
```

### Regola d'Oro Universale

**NON possono coesistere**:
- `ContentStart.blade.php` E `contentstart.blade.php`
- `LICENSE.md` E `license.md`
- `MapComponent.vue` E `mapcomponent.vue`

**Soluzione**: Mantieni la versione con capitalizzazione corretta (UPPERCASE per docs, camelCase/PascalCase per codice), elimina tutti i duplicati lowercase.

**Data ultima verifica**: Novembre 2025  
**Status**: ✅ 0 duplicati rilevati su 3151 directory verificate
=======
