=======
# Struttura dei percorsi nel progetto 

> **Ambiente di riferimento**: `/var/www/_bases/base_ptvx_fila4_mono/`

## 🔑 Regola Fondamentale
Tutti i percorsi assoluti DEVONO includere il segmento `laravel/` subito dopo la directory di base del progetto.

```
/var/www/_bases/base_ptvx_fila4_mono/laravel/{componente}/{resto-del-percorso}
                                 ↑
                           segmento obbligatorio
```

## ✅ Percorsi Correttamente Formati
```
/var/www/_bases/base_ptvx_fila4_mono/laravel/app/Models/User.php
/var/www/_bases/base_ptvx_fila4_mono/laravel/Modules/Xot/app/Providers/XotBaseServiceProvider.php
/var/www/_bases/base_ptvx_fila4_mono/laravel/Themes/One/resources/views/layouts/app.blade.php
/var/www/_bases/base_ptvx_fila4_mono/laravel/resources/lang/it/validation.php
/var/www/_bases/base_ptvx_fila4_mono/laravel/vendor/laravel/framework/src/Illuminate/Foundation/Application.php
```

## ❌ Percorsi Errati (segmento mancante)
```
/var/www/_bases/base_ptvx_fila4_mono/app/Models/User.php
/var/www/_bases/base_ptvx_fila4_mono/Modules/Xot/app/Providers/XotBaseServiceProvider.php
/var/www/_bases/base_ptvx_fila4_mono/resources/lang/it/validation.php
```

## 🗂️ Anatomia del Progetto
```
/var/www/_bases/base_ptvx_fila4_mono/
├── docs/                 # Documentazione generale
└── laravel/              # ⭐ Applicazione Laravel
    ├── app/
    │   ├── Console/
    │   ├── Exceptions/
    │   ├── Http/
    │   ├── Models/
    │   ├── Providers/
    │   └── View/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── Modules/          # Moduli Laraxot (36 moduli totali)
    │   ├── Activity/
    │   ├── Gdpr/
    │   ├── Lang/
    │   ├── Notify/
    │   ├── Sigma/
    │   ├── User/
    │   └── Xot/         # Core framework
    ├── public/
    ├── resources/
    ├── routes/
    ├── storage/
    ├── themes/
    └── vendor/
```

## Importanza della regola

Il rispetto di questa struttura è fondamentale per:

1. **Consistenza**: Garantisce uniformità nei riferimenti ai file
2. **Chiarezza**: Rende evidente la separazione tra l'app Laravel e il resto
3. **Deployment**: Facilita le operazioni di deploy e aggiornamento
4. **Modularità**: Supporta la struttura modulare del progetto
5. **Compatibilità**: Mantiene la compatibilità con tool e script

## Rilevamento errori nei percorsi

Prima di ogni commit, eseguire questi comandi per verificare la presenza di percorsi errati:

```bash

# Verifica percorsi errati
grep -r "/var/www/html/base_techplanner_fila3_mono/app" --include="*.php" /var/www/html/base_techplanner_fila3_mono/laravel
grep -r "/var/www/html/base_techplanner_fila3_mono/Modules" --include="*.php" /var/www/html/base_techplanner_fila3_mono/laravel
grep -r "/var/www/html/base_techplanner_fila3_mono/Themes" --include="*.php" /var/www/html/base_techplanner_fila3_mono/laravel
grep -r "/var/www/html/base_techplanner_fila3_mono/resources" --include="*.php" /var/www/html/base_techplanner_fila3_mono/laravel
grep -r "/var/www/html/base_<nome progetto>/app" --include="*.php" /var/www/html/base_<nome progetto>/laravel
grep -r "/var/www/html/base_<nome progetto>/Modules" --include="*.php" /var/www/html/base_<nome progetto>/laravel
grep -r "/var/www/html/base_<nome progetto>/Themes" --include="*.php" /var/www/html/base_<nome progetto>/laravel
grep -r "/var/www/html/base_<nome progetto>/resources" --include="*.php" /var/www/html/base_<nome progetto>/laravel
```

## Correzzione automatica (opzionale)

Se si trovano percorsi errati, è possibile correggerli automaticamente con:

```bash

# Correzione automatica (uso con cautela)
find /var/www/html/base_techplanner_fila3_mono/laravel -type f -name "*.php" -exec sed -i 's|/var/www/html/base_techplanner_fila3_mono/app|/var/www/html/base_techplanner_fila3_mono/laravel/app|g' {} \;
find /var/www/html/base_techplanner_fila3_mono/laravel -type f -name "*.php" -exec sed -i 's|/var/www/html/base_techplanner_fila3_mono/Modules|/var/www/html/base_techplanner_fila3_mono/laravel/Modules|g' {} \;
find /var/www/html/base_techplanner_fila3_mono/laravel -type f -name "*.php" -exec sed -i 's|/var/www/html/base_techplanner_fila3_mono/Themes|/var/www/html/base_techplanner_fila3_mono/laravel/Themes|g' {} \;
find /var/www/html/base_<nome progetto>/laravel -type f -name "*.php" -exec sed -i 's|/var/www/html/base_<nome progetto>/app|/var/www/html/base_<nome progetto>/laravel/app|g' {} \;
find /var/www/html/base_<nome progetto>/laravel -type f -name "*.php" -exec sed -i 's|/var/www/html/base_<nome progetto>/Modules|/var/www/html/base_<nome progetto>/laravel/Modules|g' {} \;
find /var/www/html/base_<nome progetto>/laravel -type f -name "*.php" -exec sed -i 's|/var/www/html/base_<nome progetto>/Themes|/var/www/html/base_<nome progetto>/laravel/Themes|g' {} \;
find /var/www/html/base_techplanner_fila3_mono/laravel -type f -name "*.php" -exec sed -i 's|/var/www/html/base_techplanner_fila3_mono/app|/var/www/html/base_techplanner_fila3_mono/laravel/app|g' {} \;
find /var/www/html/base_techplanner_fila3_mono/laravel -type f -name "*.php" -exec sed -i 's|/var/www/html/base_techplanner_fila3_mono/Modules|/var/www/html/base_techplanner_fila3_mono/laravel/Modules|g' {} \;
find /var/www/html/base_techplanner_fila3_mono/laravel -type f -name "*.php" -exec sed -i 's|/var/www/html/base_techplanner_fila3_mono/Themes|/var/www/html/base_techplanner_fila3_mono/laravel/Themes|g' {} \;
```

## Riferimenti correlati

- [Struttura del progetto](../Xot/docs/architecture/struttura-progetto.md)
- [Regole di namespace](../Xot/docs/standards/namespace-conventions.md)
- [Autoloading](../Xot/docs/standards/psr4-compliance.md)
- [Struttura del progetto](/var/www/html/base_<nome progetto>/laravel/Modules/Xot/docs/architecture/struttura-progetto.md)
- [Regole di namespace](/var/www/html/base_<nome progetto>/laravel/Modules/Xot/docs/standards/namespace-conventions.md)
- [Autoloading](/var/www/html/base_<nome progetto>/laravel/Modules/Xot/docs/standards/psr4-compliance.md)
- [Struttura del progetto](../Xot/docs/architecture/struttura-progetto.md)
- [Regole di namespace](../Xot/docs/standards/namespace-conventions.md)
- [Autoloading](../Xot/docs/standards/psr4-compliance.md)
- [Struttura del progetto](/var/www/html/base_<nome progetto>/laravel/Modules/Xot/project_docs/architecture/struttura-progetto.md)
- [Regole di namespace](/var/www/html/base_<nome progetto>/laravel/Modules/Xot/project_docs/standards/namespace-conventions.md)
- [Autoloading](/var/www/html/base_<nome progetto>/laravel/Modules/Xot/project_docs/standards/psr4-compliance.md)
=======
=======
=======
