# Database Issues in User Module

## Missing `doctor_team` Table

**Issue**: An `Internal Server Error` was encountered due to the missing `doctor_team` table when fetching team data for a user in the `BaseUser` model.

**Resolution**: A migration file `2025_05_16_000001_create_doctor_team_table.php` was created to establish the relationship between users (doctors) and teams. The migration was run to apply the changes to the database.

**Latest Update (Conflict Resolution)**: Identified a conflict with the migration for `doctor_team` table. The table appears to exist in the database, but migrations are marked as pending. Updated the migration file to check for table existence before creation and attempted to run the migration again on 2025-05-16.

**Latest Update (Migration Analysis and Rules)**: Analyzed the changes made to the migration file for `doctor_team` table on 2025-05-16. Updated the project rules in `.mdc` files to reflect the use of `XotBaseMigration` and the importance of checking for table existence before creation. Also updated other migration files for consistency.

**Latest Update (Migration Status and Table Check)**: After updating migration files and rules on 2025-05-16, checked the migration status and verified if the `doctor_team` table exists in the database to resolve the `Internal Server Error`.

**Latest Update (User Modification)**: The user has updated the migration file for `doctor_team` table on 2025-05-16 to include a composite primary key using `$table->primary(['user_id', 'team_id']);` for enhanced data integrity in the pivot table. The migration was attempted again to resolve the `Internal Server Error`.

**Latest Update (Corrected Migration Structure)**: Updated the migration files for `doctor_team` table on 2025-05-16 to use the correct structure with `tableCreate` and `tableUpdate` methods from `XotBaseMigration`. Also updated project rules in `.mdc` files to enforce this convention. Attempted migration again to resolve the `Internal Server Error`.

**Latest Update (2025-11-12 – Pivot & Device Migrations Fix)**: Durante l'analisi PHPStan del 12 novembre 2025 sono emersi errori di parsing nelle migrazioni `2023_01_01_000000_create_devices_table.php`, `2023_01_01_000004_create_device_user_table.php`, `2023_01_01_000004_create_team_user_table.php`, `2023_01_01_000006_create_teams_table.php`, `2023_01_22_000007_create_permissions_table.php` e `2025_05_16_221811_add_owner_id_to_teams_table.php`. I file contenevano frammenti incompleti dovuti a merge conflict risolti manualmente senza ripristinare l'anonima `XotBaseMigration`. Abbiamo ripristinato la struttura canonica `return new class extends XotBaseMigration` e introdotto la proprietà `protected string $table_name` per ogni migrazione, garantendo che `tableCreate()` e `tableUpdate()` operino sul contesto corretto. Con questa correzione l'analisi statica non segnala più errori di sintassi e le migrazioni rispettano nuovamente le regole documentate in `../../Xot/docs/architecture/struttura-percorsi.md`.

**Latest Update (2025-11-12 – Seeder Tipizzato per PHPStan)**: L’analisi PHPStan ha evidenziato metodi invocati su valori `mixed` all’interno di `database/seeders/UserMassSeeder.php`. Il seeder è stato rifattorizzato introducendo annotazioni `EloquentCollection` in corrispondenza delle factory (`User`, `AuthenticationLog`, `Device`, `SocialProvider`) così da rendere espliciti i tipi restituiti da `create()`. Ora PHPStan riconosce le collection tipizzate e non segnala più errori nei blocchi di creazione massiva.

**Related Documentation**:
- [User Module Overview](../INDEX.md)
- [Team Management](./TEAM_MANAGEMENT.md)
- [BaseUser Model](./BaseUser.md)
- [Database Structure](../DATABASE_STRUCTURE.md)
- [Migration Guidelines](../../../../docs/collegamenti-documentazione.md)
