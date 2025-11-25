# icon state column business logic

## obiettivo
Garantire che la colonna `IconStateColumn` utilizzi callback sicuri per icona e colore, configuri l'azione di cambio stato durante il `setUp()` ed esponga notifiche localizzate senza utilizzare metodi vietati come `tooltip()`.

## implementazione aggiornata (2025-11-11)
- aggiunto `setUp()` per registrare `configureIconCallbacks()` e `configureStateAction()`.
- rimossa la chiamata a `->tooltip()`, eliminando l'uso manuale di label e rispettando il `LangServiceProvider`.
- le opzioni dello stato continuano a provenire da `getStateOptions()` e `mapStatesToOptions()` con traduzioni `pub_theme::*`.
- l'azione `change-state` ora emette notifiche usando `ui::notifications.state_transition.success.*` (title + body) al posto di stringhe hard-coded.
- mantenuta la transizione tramite `handleStateTransition()` con validazione di tipo esplicita e messaggi opzionali.

## motivazioni
- allineamento alle regole Laraxot: niente `tooltip/label/placeholder` manuali.
- notifica full-localized per evitare testo italiano hardcoded.
- prevenzione di errori di sintassi dovuti a trailing comma e catene Fluent non terminate.

## riferimenti
- codice: `Modules/UI/app/Filament/Tables/Columns/IconStateColumn.php`
- traduzioni: `Modules/UI/lang/*/notifications.php`
- regole progetto: `Modules/Xot/docs/never-use-label-rule.md`
