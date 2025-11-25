# Troubleshooting Notification Issues in Laravel Modules

## Overview
This document provides guidance on diagnosing and resolving common issues encountered with the Notify module, ensuring smooth operation of notification systems.

## Key Principles
1. **Diagnosis**: Identify the root cause of notification failures through logs and error messages.
2. **Resolution**: Apply targeted fixes to restore functionality without disrupting other systems.
3. **Prevention**: Implement best practices to avoid recurring issues.

## Common Issues and Fixes
### 1. Notification Delivery Failures
- **Symptoms**: Notifications are not received by users.
- **Diagnosis**: Check logs for errors related to API calls or provider responses.
- **Fix**: Verify API keys, endpoint URLs, and network connectivity. Ensure provider accounts are active and funded.
  ```php
  // Example Log Check
  Log::channel('notifications')->error('Delivery failed', ['error' => $exception->getMessage()]);
  ```

### 2. Template Rendering Errors
- **Symptoms**: Notifications are sent but content is incorrect or missing.
- **Diagnosis**: Review template syntax and dynamic data passed to templates.
- **Fix**: Correct Blade syntax errors and ensure all required variables are provided.

### 3. Rate Limiting by Providers
- **Symptoms**: Notifications are delayed or blocked after a certain number of sends.
- **Diagnosis**: Look for rate limit exceeded errors in provider responses.
- **Fix**: Implement queueing to throttle sends or contact provider for higher limits.

### 4. Configuration Errors
- **Symptoms**: Notifications fail immediately with configuration-related errors.
- **Diagnosis**: Check environment variables and configuration files for typos or missing values.
- **Fix**: Update configurations with correct values and restart application if necessary.

### 5. ParseError durante composer update - Assert::string con assegnazione inline
- **Symptoms**: Errore `ParseError: syntax error, unexpected token "->"` durante `composer update -W` o `php artisan package:discover`.
- **Diagnosis**: Il problema si verifica quando si usa `Assert::string()` con un'assegnazione inline seguita immediatamente da una chiamata a metodo con `->`.
- **Cause**: PHP può avere problemi di parsing quando un'assegnazione è incorporata direttamente nella chiamata di funzione seguita da una chiamata a metodo.
- **Fix**: Separare sempre l'assegnazione dalla chiamata `Assert::string()`:
  ```php
  // ❌ ERRATO - causa ParseError
  Assert::string($template_slug = $data['template_slug'], __FILE__ . ':' . __LINE__);
  $notify = new RecordNotification($user, $template_slug)->mergeData($data);

  // ✅ CORRETTO - separare assegnazione e validazione
  $template_slug = $data['template_slug'];
  Assert::string($template_slug, __FILE__ . ':' . __LINE__);
  $notify = new RecordNotification($user, $template_slug)->mergeData($data);
  ```
- **Files interessati**: 
  - `Modules/Notify/app/Filament/Clusters/Test/Pages/SendSmsPage.php`
  - `Modules/Notify/app/Filament/Clusters/Test/Pages/SendSpatieEmailPage.php`
- **Prevenzione**: Evitare sempre assegnazioni inline dentro chiamate `Assert::*()` quando seguite da chiamate a metodo.

### 6. PHPStan Livello 10: Errori di Tipizzazione
- **Symptoms**: Errori PHPStan livello 10 durante l'analisi statica del codice
- **Diagnosis**: Mancanza di tipizzazione esplicita per array, parametri mixed, accesso a offset su mixed
- **Fix**: Aggiungere tipizzazione esplicita con PHPDoc e shape types per array strutturati
- **Files interessati**: 
  - `Modules/Notify/app/Actions/SendNotificationAction.php` - Tipizzazione parametri e array
  - `Modules/Notify/app/Notifications/GenericNotification.php` - Tipizzazione channels e metodi
  - `Modules/Notify/app/Models/NotificationTemplate.php` - Tipizzazione preview data e channels
  - `Modules/Notify/app/Notifications/RecordNotification.php` - Tipizzazione attachments e data
  - `Modules/Notify/app/Actions/Telegram/*.php` - Accesso sicuro a offset array
  - `Modules/Notify/app/Actions/WhatsApp/*.php` - Tipizzazione mediaUrl
- **Pattern di correzione**:
  ```php
  // ❌ ERRATO
  public function execute(Model $recipient, string $templateCode, array $data = []): bool
  
  // ✅ CORRETTO
  public function execute(Model $recipient, string $templateCode, array<string, mixed> $data = []): bool
  
  // ❌ ERRATO - Accesso diretto a offset mixed
  'message_id' => $responseData['result']['message_id'] ?? null
  
  // ✅ CORRETTO - Verifica tipo prima dell'accesso
  /** @var array<string, mixed> $result */
  $result = $responseData['result'] ?? [];
  /** @var int|null $messageId */
  $messageId = isset($result['message_id']) && is_int($result['message_id']) ? $result['message_id'] : null;
  ```
- **Prevenzione**: Utilizzare sempre tipizzazione esplicita per array e verificare tipi prima di accedere a offset su valori mixed
- **Documentazione completa**: Vedi [phpstan-level10-analysis.md](./phpstan-level10-analysis.md)

## Testing and Verification
- Use sandbox environments or test modes provided by notification services to simulate sends without affecting real users.
- Verify fixes by sending test notifications after applying changes.

## Documentation and Updates
- Document any recurring issues or unique troubleshooting scenarios in the relevant module's documentation folder.
- Update this document if new issues or resolution strategies are identified.

## Links to Related Documentation
- [Notify Module Index](./INDEX.md)
- [Architecture Overview](./ARCHITECTURE.md)
- [Notification Channels Implementation](./NOTIFICATION_CHANNELS_IMPLEMENTATION.md)
- [Email Templates](./EMAIL_TEMPLATES.md)
- [SMS Implementation](./SMS_IMPLEMENTATION.md)
