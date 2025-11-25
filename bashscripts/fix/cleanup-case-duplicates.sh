#!/bin/bash
# Script di cleanup file duplicati per case-sensitivity
# Elimina file lowercase che sono duplicati di file UpperCamelCase (PSR-4 compliance)
#
# MOTIVAZIONE: Su filesystem case-sensitive (Linux production) i file con stesso nome
# ma case diverso sono DUE file distinti. Su Windows/macOS sono LO STESSO file.
# Questo causa conflitti Git e problemi di portabilità.
#
# REGOLA PSR-4: File PHP con classi DEVONO usare UpperCamelCase identico al nome classe
#
# Documentazione: laravel/Modules/Xot/docs/file-naming-case-sensitivity.md

set -e  # Exit on error

cd /var/www/_bases/base_ptvx_fila4_mono/laravel

echo "🧹 Cleanup File Duplicati (Case Sensitivity)"
echo "==========================================="
echo ""

# Contatore
COUNT=0

# Modulo Xot
echo "📦 Modulo Xot"
if [ -f "Modules/Xot/tests/Unit/metatagdatatest.php" ]; then
  rm "Modules/Xot/tests/Unit/metatagdatatest.php"
  echo "  ✅ Rimosso: tests/Unit/metatagdatatest.php"
  ((COUNT++))
fi

if [ -f "Modules/Xot/tests/Unit/Console/Commands/generatedbdocumentationcommandtest.pest.php" ]; then
  rm "Modules/Xot/tests/Unit/Console/Commands/generatedbdocumentationcommandtest.pest.php"
  echo "  ✅ Rimosso: tests/Unit/Console/Commands/generatedbdocumentationcommandtest.pest.php"
  ((COUNT++))
fi

if [ -f "Modules/Xot/tests/Feature/fixstructuretest.pest.php" ]; then
  rm "Modules/Xot/tests/Feature/fixstructuretest.pest.php"
  echo "  ✅ Rimosso: tests/Feature/fixstructuretest.pest.php"
  ((COUNT++))
fi

if [ -f "Modules/Xot/tests/pest.php" ]; then
  rm "Modules/Xot/tests/pest.php"
  echo "  ✅ Rimosso: tests/pest.php"
  ((COUNT++))
fi

if [ -f "Modules/Xot/app/Http/Http/Controllers/xotbasecontroller.php" ]; then
  rm "Modules/Xot/app/Http/Http/Controllers/xotbasecontroller.php"
  echo "  ✅ Rimosso: app/Http/Http/Controllers/xotbasecontroller.php"
  ((COUNT++))
fi

# Modulo Gdpr
echo ""
echo "📦 Modulo Gdpr"
if [ -f "Modules/Gdpr/tests/Feature/conflictresolutiontest.php" ]; then
  rm "Modules/Gdpr/tests/Feature/conflictresolutiontest.php"
  echo "  ✅ Rimosso: tests/Feature/conflictresolutiontest.php"
  ((COUNT++))
fi

# Modulo Media
echo ""
echo "📦 Modulo Media"
if [ -f "Modules/Media/tests/Filament/Resources/mediaconvertresourcetest.php" ]; then
  rm "Modules/Media/tests/Filament/Resources/mediaconvertresourcetest.php"
  echo "  ✅ Rimosso: tests/Filament/Resources/mediaconvertresourcetest.php"
  ((COUNT++))
fi

# Modulo Notify - Tests
echo ""
echo "📦 Modulo Notify"
if [ -f "Modules/Notify/tests/Feature/emailtemplatestest.php" ]; then
  rm "Modules/Notify/tests/Feature/emailtemplatestest.php"
  echo "  ✅ Rimosso: tests/Feature/emailtemplatestest.php"
  ((COUNT++))
fi

if [ -f "Modules/Notify/tests/Feature/jsoncomponentstest.php" ]; then
  rm "Modules/Notify/tests/Feature/jsoncomponentstest.php"
  echo "  ✅ Rimosso: tests/Feature/jsoncomponentstest.php"
  ((COUNT++))
fi

# Modulo Notify - Config
if [ -f "Modules/Notify/.php-cs-fixer.dist - copia.php" ]; then
  rm "Modules/Notify/.php-cs-fixer.dist - copia.php"
  echo "  ✅ Rimosso: .php-cs-fixer.dist - copia.php"
  ((COUNT++))
fi

# Modulo Notify - Blade templates ark
if [ -f "Modules/Notify/resources/views/emails/templates/ark/contentend.blade.php" ]; then
  rm "Modules/Notify/resources/views/emails/templates/ark/contentend.blade.php"
  echo "  ✅ Rimosso: resources/views/emails/templates/ark/contentend.blade.php"
  ((COUNT++))
fi

if [ -f "Modules/Notify/resources/views/emails/templates/ark/contentstart.blade.php" ]; then
  rm "Modules/Notify/resources/views/emails/templates/ark/contentstart.blade.php"
  echo "  ✅ Rimosso: resources/views/emails/templates/ark/contentstart.blade.php"
  ((COUNT++))
fi

if [ -f "Modules/Notify/resources/views/emails/templates/ark/wideimage.blade.php" ]; then
  rm "Modules/Notify/resources/views/emails/templates/ark/wideimage.blade.php"
  echo "  ✅ Rimosso: resources/views/emails/templates/ark/wideimage.blade.php"
  ((COUNT++))
fi

# Modulo Notify - Blade templates minty
if [ -f "Modules/Notify/resources/views/emails/templates/minty/contentcenteredend.blade.php" ]; then
  rm "Modules/Notify/resources/views/emails/templates/minty/contentcenteredend.blade.php"
  echo "  ✅ Rimosso: resources/views/emails/templates/minty/contentcenteredend.blade.php"
  ((COUNT++))
fi

if [ -f "Modules/Notify/resources/views/emails/templates/minty/contentcenteredstart.blade.php" ]; then
  rm "Modules/Notify/resources/views/emails/templates/minty/contentcenteredstart.blade.php"
  echo "  ✅ Rimosso: resources/views/emails/templates/minty/contentcenteredstart.blade.php"
  ((COUNT++))
fi

if [ -f "Modules/Notify/resources/views/emails/templates/minty/contentend.blade.php" ]; then
  rm "Modules/Notify/resources/views/emails/templates/minty/contentend.blade.php"
  echo "  ✅ Rimosso: resources/views/emails/templates/minty/contentend.blade.php"
  ((COUNT++))
fi

if [ -f "Modules/Notify/resources/views/emails/templates/minty/contentstart.blade.php" ]; then
  rm "Modules/Notify/resources/views/emails/templates/minty/contentstart.blade.php"
  echo "  ✅ Rimosso: resources/views/emails/templates/minty/contentstart.blade.php"
  ((COUNT++))
fi

# Modulo Notify - Blade templates sunny
if [ -f "Modules/Notify/resources/views/emails/templates/sunny/contentend.blade.php" ]; then
  rm "Modules/Notify/resources/views/emails/templates/sunny/contentend.blade.php"
  echo "  ✅ Rimosso: resources/views/emails/templates/sunny/contentend.blade.php"
  ((COUNT++))
fi

if [ -f "Modules/Notify/resources/views/emails/templates/sunny/contentstart.blade.php" ]; then
  rm "Modules/Notify/resources/views/emails/templates/sunny/contentstart.blade.php"
  echo "  ✅ Rimosso: resources/views/emails/templates/sunny/contentstart.blade.php"
  ((COUNT++))
fi

if [ -f "Modules/Notify/resources/views/emails/templates/sunny/wideimage.blade.php" ]; then
  rm "Modules/Notify/resources/views/emails/templates/sunny/wideimage.blade.php"
  echo "  ✅ Rimosso: resources/views/emails/templates/sunny/wideimage.blade.php"
  ((COUNT++))
fi

# Modulo Notify - Blade templates widgets
if [ -f "Modules/Notify/resources/views/emails/templates/widgets/articleend.blade.php" ]; then
  rm "Modules/Notify/resources/views/emails/templates/widgets/articleend.blade.php"
  echo "  ✅ Rimosso: resources/views/emails/templates/widgets/articleend.blade.php"
  ((COUNT++))
fi

if [ -f "Modules/Notify/resources/views/emails/templates/widgets/articlestart.blade.php" ]; then
  rm "Modules/Notify/resources/views/emails/templates/widgets/articlestart.blade.php"
  echo "  ✅ Rimosso: resources/views/emails/templates/widgets/articlestart.blade.php"
  ((COUNT++))
fi

if [ -f "Modules/Notify/resources/views/emails/templates/widgets/newfeatureend.blade.php" ]; then
  rm "Modules/Notify/resources/views/emails/templates/widgets/newfeatureend.blade.php"
  echo "  ✅ Rimosso: resources/views/emails/templates/widgets/newfeatureend.blade.php"
  ((COUNT++))
fi

if [ -f "Modules/Notify/resources/views/emails/templates/widgets/newfeaturestart.blade.php" ]; then
  rm "Modules/Notify/resources/views/emails/templates/widgets/newfeaturestart.blade.php"
  echo "  ✅ Rimosso: resources/views/emails/templates/widgets/newfeaturestart.blade.php"
  ((COUNT++))
fi

# Modulo Tenant
echo ""
echo "📦 Modulo Tenant"
if [ -f "Modules/Tenant/tests/Unit/domaintest.php" ]; then
  rm "Modules/Tenant/tests/Unit/domaintest.php"
  echo "  ✅ Rimosso: tests/Unit/domaintest.php"
  ((COUNT++))
fi

echo ""
echo "==========================================="
echo "✅ Cleanup completato: $COUNT file rimossi"
echo ""
echo "📝 Prossimi step:"
echo "  1. Verifica che i test passino: php artisan test"
echo "  2. Commit: git add -A && git commit -m 'fix: remove lowercase duplicate files (PSR-4 compliance)'"
echo ""
echo "📚 Documentazione: laravel/Modules/Xot/docs/file-naming-case-sensitivity.md"


