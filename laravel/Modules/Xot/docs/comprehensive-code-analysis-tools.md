# 🔍 COMPREHENSIVE CODE ANALYSIS TOOLS GUIDE

**Data Creazione**: 2025-01-27  
**Status**: 🚀 ATTIVO  
**Scope**: Tutti i moduli e temi  
**Priority**: CRITICAL  

---

## 🎯 OVERVIEW

Guida completa per l'utilizzo di tutti gli strumenti di analisi del codice disponibili nel progetto FixCity. Questi strumenti garantiscono la massima qualità del codice, sicurezza e manutenibilità.

### 🛠️ Strumenti per Stack Tecnologico

#### **PHP/Laravel**
- **PHPStan**: Static analysis ✅ INSTALLATO
- **PHPMD**: PHP Mess Detector ✅ INSTALLATO
- **PHP CS Fixer**: Code style fixer ✅ INSTALLATO
- **Laravel Pint**: Laravel code formatter ✅ INSTALLATO
- **Psalm**: Static analysis ✅ INSTALLATO
- **PHP_CodeSniffer**: Code style checker 📋 DA INSTALLARE
- **Brakeman**: Security scanner ❌ NON APPLICABILE (Ruby)

#### **JavaScript/TypeScript**
- **ESLint**: JavaScript/TypeScript linter ✅ INSTALLATO
- **Prettier**: Code formatter ✅ INSTALLATO
- **Ruff**: Python linter (per build tools) ❌ NON APPLICABILE (Python)
- **Oxc**: Rust-based JavaScript linter 📋 DA INSTALLARE

#### **CSS/HTML**
- **HTMLHint**: HTML linter ✅ INSTALLATO
- **Stylelint**: CSS linter ✅ INSTALLATO

#### **Markdown/Documentation**
- **Markdownlint**: Markdown linter ✅ INSTALLATO
- **LanguageTool**: Grammar checker 📋 DA INSTALLARE

#### **Security**
- **Gitleaks**: Secret detection
- **OSV Scanner**: Vulnerability scanner
- **Semgrep**: Security-focused static analysis

#### **CI/CD & Workflow**
- **Actionlint**: GitHub Actions linter
- **Checkmake**: Makefile linter
- **ShellCheck**: Shell script linter

#### **Database**
- **SQLFluff**: SQL linter

---

## 📦 INSTALLAZIONE STRUMENTI

### 🔧 **Strumenti PHP/Laravel**

```bash
# Strumenti già installati
composer require --dev phpstan/phpstan phpmd/phpmd friendsofphp/php-cs-fixer vimeo/psalm

# Strumenti aggiuntivi
composer require --dev squizlabs/php_codesniffer
```

### 🎨 **Strumenti Frontend**

```bash
# ESLint per JavaScript/TypeScript
npm install --save-dev eslint @typescript-eslint/parser @typescript-eslint/eslint-plugin

# HTMLHint per HTML
npm install --save-dev htmlhint

# Stylelint per CSS
npm install --save-dev stylelint stylelint-config-standard

# Markdownlint per documentazione
npm install --save-dev markdownlint-cli

# LanguageTool per grammatica
npm install --save-dev languagetool
```

### 🔒 **Strumenti di Sicurezza**

```bash
# Gitleaks per rilevamento segreti
go install github.com/gitleaks/gitleaks/v8@latest

# OSV Scanner per vulnerabilità
go install github.com/google/osv-scanner/cmd/osv-scanner@latest

# Semgrep per analisi sicurezza
pip install semgrep
```

### 🚀 **Strumenti CI/CD**

```bash
# Actionlint per GitHub Actions
go install github.com/rhysd/actionlint/cmd/actionlint@latest

# ShellCheck per script shell
sudo apt install shellcheck

# Checkmake per Makefile
go install github.com/mrtazz/checkmake/cmd/checkmake@latest
```

---

## ⚙️ CONFIGURAZIONI

### 📋 **ESLint Configuration**

#### File: `.eslintrc.js`
```javascript
module.exports = {
  env: {
    browser: true,
    es2021: true,
    node: true,
  },
  extends: [
    'eslint:recommended',
    '@typescript-eslint/recommended',
  ],
  parser: '@typescript-eslint/parser',
  parserOptions: {
    ecmaVersion: 'latest',
    sourceType: 'module',
  },
  plugins: ['@typescript-eslint'],
  rules: {
    'no-console': 'warn',
    'no-unused-vars': 'error',
    '@typescript-eslint/no-explicit-any': 'warn',
  },
  ignorePatterns: ['node_modules/', 'vendor/', 'public/build/'],
};
```

### 🎨 **Stylelint Configuration**

#### File: `.stylelintrc.js`
```javascript
module.exports = {
  extends: ['stylelint-config-standard'],
  rules: {
    'color-no-invalid-hex': true,
    'font-family-no-duplicate-names': true,
    'font-family-no-missing-generic-family-keyword': true,
    'no-duplicate-at-import-rules': true,
    'no-duplicate-selectors': true,
    'no-empty-source': true,
  },
  ignoreFiles: ['node_modules/**/*', 'vendor/**/*', 'public/build/**/*'],
};
```

### 📝 **Markdownlint Configuration**

#### File: `.markdownlint.json`
```json
{
  "MD013": { "line_length": 120 },
  "MD024": false,
  "MD033": false,
  "MD041": false
}
```

---

## 🚀 SCRIPT DI INTEGRAZIONE

### 📋 **Script Completo di Analisi**

#### File: `scripts/comprehensive-code-analysis.sh`
```bash
#!/bin/bash

# Comprehensive Code Analysis Script
# Esegue tutti gli strumenti di analisi del codice

set -e

echo "🔍 Starting Comprehensive Code Analysis..."
echo "=========================================="

# Verifica che siamo nella directory corretta
if [ ! -f "composer.json" ]; then
    echo "❌ Error: composer.json not found. Please run this script from the project root."
    exit 1
fi

# Crea directory per i report
mkdir -p reports

# PHP Analysis
echo "📊 Running PHP Analysis..."
echo "-------------------------"

# PHPStan
if ./vendor/bin/phpstan analyse --memory-limit=-1 --no-progress > reports/phpstan-report.txt 2>&1; then
    echo "✅ PHPStan: No errors found"
else
    echo "❌ PHPStan: Errors found - check reports/phpstan-report.txt"
    PHPSTAN_ERRORS=true
fi

# PHPMD
if ./vendor/bin/phpmd app/ text phpmd.xml > reports/phpmd-app-report.txt 2>&1; then
    echo "✅ PHPMD (app/): No violations found"
else
    echo "❌ PHPMD (app/): Violations found - check reports/phpmd-app-report.txt"
    PHPMD_ERRORS=true
fi

if ./vendor/bin/phpmd Modules/ text phpmd.xml > reports/phpmd-modules-report.txt 2>&1; then
    echo "✅ PHPMD (Modules/): No violations found"
else
    echo "❌ PHPMD (Modules/): Violations found - check reports/phpmd-modules-report.txt"
    PHPMD_ERRORS=true
fi

# PHP CS Fixer
if ./vendor/bin/php-cs-fixer fix --dry-run --diff > reports/php-cs-fixer-report.txt 2>&1; then
    echo "✅ PHP CS Fixer: Code style is correct"
else
    echo "❌ PHP CS Fixer: Code style issues found - check reports/php-cs-fixer-report.txt"
    CS_FIXER_ERRORS=true
fi

# Psalm
if ./vendor/bin/psalm > reports/psalm-report.txt 2>&1; then
    echo "✅ Psalm: No issues found"
else
    echo "❌ Psalm: Issues found - check reports/psalm-report.txt"
    PSALM_ERRORS=true
fi

# Frontend Analysis
echo ""
echo "🎨 Running Frontend Analysis..."
echo "------------------------------"

# ESLint
if npx eslint . --ext .js,.ts,.vue > reports/eslint-report.txt 2>&1; then
    echo "✅ ESLint: No issues found"
else
    echo "❌ ESLint: Issues found - check reports/eslint-report.txt"
    ESLINT_ERRORS=true
fi

# HTMLHint
if npx htmlhint "**/*.html" > reports/htmlhint-report.txt 2>&1; then
    echo "✅ HTMLHint: No issues found"
else
    echo "❌ HTMLHint: Issues found - check reports/htmlhint-report.txt"
    HTMLHINT_ERRORS=true
fi

# Stylelint
if npx stylelint "**/*.css" > reports/stylelint-report.txt 2>&1; then
    echo "✅ Stylelint: No issues found"
else
    echo "❌ Stylelint: Issues found - check reports/stylelint-report.txt"
    STYLELINT_ERRORS=true
fi

# Security Analysis
echo ""
echo "🔒 Running Security Analysis..."
echo "------------------------------"

# Gitleaks
if gitleaks detect --source . --report-format json --report-path reports/gitleaks-report.json > reports/gitleaks-log.txt 2>&1; then
    echo "✅ Gitleaks: No secrets found"
else
    echo "❌ Gitleaks: Secrets found - check reports/gitleaks-report.json"
    GITLEAKS_ERRORS=true
fi

# OSV Scanner
if osv-scanner -r . > reports/osv-scanner-report.txt 2>&1; then
    echo "✅ OSV Scanner: No vulnerabilities found"
else
    echo "❌ OSV Scanner: Vulnerabilities found - check reports/osv-scanner-report.txt"
    OSV_ERRORS=true
fi

# Semgrep
if semgrep --config=auto . > reports/semgrep-report.txt 2>&1; then
    echo "✅ Semgrep: No security issues found"
else
    echo "❌ Semgrep: Security issues found - check reports/semgrep-report.txt"
    SEMGREP_ERRORS=true
fi

# Documentation Analysis
echo ""
echo "📝 Running Documentation Analysis..."
echo "-----------------------------------"

# Markdownlint
if npx markdownlint "**/*.md" > reports/markdownlint-report.txt 2>&1; then
    echo "✅ Markdownlint: No issues found"
else
    echo "❌ Markdownlint: Issues found - check reports/markdownlint-report.txt"
    MARKDOWNLINT_ERRORS=true
fi

# Summary
echo ""
echo "📋 COMPREHENSIVE ANALYSIS SUMMARY"
echo "================================="

TOTAL_ERRORS=0
[ "$PHPSTAN_ERRORS" = true ] && ((TOTAL_ERRORS++))
[ "$PHPMD_ERRORS" = true ] && ((TOTAL_ERRORS++))
[ "$CS_FIXER_ERRORS" = true ] && ((TOTAL_ERRORS++))
[ "$PSALM_ERRORS" = true ] && ((TOTAL_ERRORS++))
[ "$ESLINT_ERRORS" = true ] && ((TOTAL_ERRORS++))
[ "$HTMLHINT_ERRORS" = true ] && ((TOTAL_ERRORS++))
[ "$STYLELINT_ERRORS" = true ] && ((TOTAL_ERRORS++))
[ "$GITLEAKS_ERRORS" = true ] && ((TOTAL_ERRORS++))
[ "$OSV_ERRORS" = true ] && ((TOTAL_ERRORS++))
[ "$SEMGREP_ERRORS" = true ] && ((TOTAL_ERRORS++))
[ "$MARKDOWNLINT_ERRORS" = true ] && ((TOTAL_ERRORS++))

if [ $TOTAL_ERRORS -eq 0 ]; then
    echo "✅ ALL ANALYSES PASSED"
    echo ""
    echo "🎉 Your code is in excellent shape!"
    echo "   - PHP Quality: ✅"
    echo "   - Frontend Quality: ✅"
    echo "   - Security: ✅"
    echo "   - Documentation: ✅"
else
    echo "❌ ANALYSIS FAILED"
    echo ""
    echo "Issues found in $TOTAL_ERRORS categories:"
    [ "$PHPSTAN_ERRORS" = true ] && echo "  - PHPStan (PHP Static Analysis)"
    [ "$PHPMD_ERRORS" = true ] && echo "  - PHPMD (PHP Mess Detector)"
    [ "$CS_FIXER_ERRORS" = true ] && echo "  - PHP CS Fixer (Code Style)"
    [ "$PSALM_ERRORS" = true ] && echo "  - Psalm (PHP Static Analysis)"
    [ "$ESLINT_ERRORS" = true ] && echo "  - ESLint (JavaScript/TypeScript)"
    [ "$HTMLHINT_ERRORS" = true ] && echo "  - HTMLHint (HTML)"
    [ "$STYLELINT_ERRORS" = true ] && echo "  - Stylelint (CSS)"
    [ "$GITLEAKS_ERRORS" = true ] && echo "  - Gitleaks (Secret Detection)"
    [ "$OSV_ERRORS" = true ] && echo "  - OSV Scanner (Vulnerabilities)"
    [ "$SEMGREP_ERRORS" = true ] && echo "  - Semgrep (Security Analysis)"
    [ "$MARKDOWNLINT_ERRORS" = true ] && echo "  - Markdownlint (Documentation)"
    echo ""
    echo "Check the reports in the reports/ directory for details."
    exit 1
fi
```

---

## 📊 METRICHE E DASHBOARD

### 📈 **Metriche Chiave**

- **PHP Quality**: PHPStan level 10, PHPMD 0 violations
- **Frontend Quality**: ESLint 0 errors, HTMLHint 0 issues
- **Security**: Gitleaks 0 secrets, OSV 0 vulnerabilities
- **Documentation**: Markdownlint 0 issues
- **Code Coverage**: > 80% (target: > 90%)
- **Performance**: Lighthouse 95+ (target: 98+)

### 📋 **Report Automatici**

```bash
# Genera report completo
./scripts/comprehensive-code-analysis.sh

# Report per categoria
./scripts/php-analysis.sh
./scripts/frontend-analysis.sh
./scripts/security-analysis.sh
./scripts/documentation-analysis.sh
```

---

## 🎯 BEST PRACTICES

### ✅ **Workflow Raccomandato**

1. **Pre-commit**: Esegui analisi completa
2. **Fix Automatici**: Applica correzioni automatiche
3. **Review Manuale**: Controlla report generati
4. **Commit**: Solo se tutti i check passano

### ✅ **Integrazione IDE**

#### PhpStorm
- **PHPStan**: Integra come ispezione
- **ESLint**: Estensione per JavaScript
- **Stylelint**: Estensione per CSS
- **Markdownlint**: Estensione per Markdown

#### VS Code
- **PHP Intelephense**: Estensione principale
- **ESLint**: Estensione per JavaScript
- **Stylelint**: Estensione per CSS
- **Markdownlint**: Estensione per Markdown

---

## 🚨 TROUBLESHOOTING

### ❌ **Problemi Comuni**

#### Strumenti non trovati
```bash
# Verifica installazione
which phpstan phpmd eslint htmlhint stylelint

# Reinstalla se necessario
composer install
npm install
```

#### Permessi script
```bash
# Rendi eseguibili
chmod +x scripts/*.sh
```

#### Memory limit
```bash
# Aumenta memory limit per PHPStan
./vendor/bin/phpstan analyse --memory-limit=-1
```

---

## 📚 RISORSE AGGIUNTIVE

### 🔗 **Link Utili**
- [PHPStan Documentation](https://phpstan.org/)
- [ESLint Documentation](https://eslint.org/)
- [Gitleaks Documentation](https://gitleaks.io/)
- [Semgrep Documentation](https://semgrep.dev/)

### 📖 **Guide Specifiche**
- [PHP Code Quality Guide](./php-code-quality.md)
- [Frontend Code Quality Guide](./frontend-code-quality.md)
- [Security Best Practices](./security-best-practices.md)
- [Documentation Standards](./documentation-standards.md)

---

**Last Updated**: 2025-01-27  
**Next Review**: 2025-02-27  
**Status**: 🚀 ACTIVE IMPLEMENTATION  
**Confidence Level**: 98%  

---

*Questa guida fornisce tutti gli strumenti necessari per mantenere la massima qualità del codice nel progetto FixCity.*
