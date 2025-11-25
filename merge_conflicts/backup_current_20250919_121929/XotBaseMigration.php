<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Migrations;

use ReflectionClass;
use Exception;
use Closure;
use RuntimeException;
use Illuminate\Database\Schema\ColumnDefinition;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Modules\Xot\Datas\XotData;
use Nwidart\Modules\Facades\Module;
use Webmozart\Assert\Assert;

/**
 * Class XotBaseMigration.
 */
abstract class XotBaseMigration extends Migration
{
    protected Model $model;

<<<<<<< HEAD
    protected null|string $model_class = null;

    public function __construct()
    {
        $this->model_class ??= $this->getModelClass();
=======
    protected ?string $model_class = null;

    public function __construct()
    {


        $this->model_class = $this->model_class ?? $this->getModelClass();
>>>>>>> f1d4085 (.)
        Assert::isInstanceOf($model = app($this->model_class), Model::class);
        $this->model = $model;
    }

    /**
     * Get the model class based on the migration class name.
     */
    public function getModelClass(): string
    {
        if (null !== $this->model_class) {
            return $this->model_class;
        }

        $name = class_basename($this);

        $name = Str::before(Str::after($name, 'Create'), 'Table');
        $name = Str::singular($name);
        if (Str::contains($name, '.php')) {
            $name = Str::of($name)
                ->between('_create_', '_table.php')
                ->singular()
                ->studly()
                ->toString();
        }

        $reflectionClass = new ReflectionClass($this);
        $filename = $reflectionClass->getFilename();
        $mod_path = Module::getPath();

        // Controllo che $filename sia valido prima di passarlo a Str::of()
<<<<<<< HEAD
        $mod_name = false !== $filename ? Str::of($filename)->after($mod_path)->explode(\DIRECTORY_SEPARATOR)[1] : ''; // Fallback nel caso in cui $filename non sia valido.

        $this->model_class = Str::of('\Modules\\' . $mod_name . '\Models\\' . $name)
=======
        $mod_name = false !== $filename
            ? Str::of($filename)
                ->after($mod_path)
                ->explode(\DIRECTORY_SEPARATOR)[1]
            : ''; // Fallback nel caso in cui $filename non sia valido.

        $this->model_class = Str::of('\Modules\\'.$mod_name.'\Models\\'.$name)
>>>>>>> f1d4085 (.)
            ->replace('/', \DIRECTORY_SEPARATOR)
            ->toString();

        return $this->model_class;
    }

    public function getTable(): string
    {
<<<<<<< HEAD
=======

>>>>>>> f1d4085 (.)
        return $this->model->getTable();
    }

    public function getConn(): Builder
    {
<<<<<<< HEAD
=======

>>>>>>> f1d4085 (.)
        return Schema::connection($this->model->getConnectionName());
    }

    /**
     * Commentato perché Doctrine non è supportato nativamente in Laravel.
     * Se hai bisogno di questa funzione, assicurati di installare doctrine/dbal.
     */
    // public function getSchemaManager(): AbstractSchemaManager
    // {
    //     return $this->getConn()->getConnection()->getDoctrineSchemaManager();
    // }

    /**
     * Get table details using Doctrine's schema manager.
     *
     * @throws \Doctrine\DBAL\Exception
     */
    // public function getTableDetails(): Table
    // {
    //     return $this->getSchemaManager()->listTableDetails($this->getTable());
    // }

    /**
     * Get the table indexes using Doctrine's schema manager.
     *
     * @throws \Doctrine\DBAL\Exception
     *
     * @return array<\Doctrine\DBAL\Schema\Index>
     */
    // public function getTableIndexes(): array
    // {
    //     return $this->getSchemaManager()->listTableIndexes($this->getTable());
    // }

    /**
     * Add common fields to the table.
     *
     * @param Blueprint $table The table blueprint
     */
    public function addCommonFields(Blueprint $table): void
    {
        // Implementazione vuota di base
        // Le classi figlie possono sovrascrivere questo metodo per aggiungere campi comuni
    }

    /**
     * Check if a table exists.
     */
<<<<<<< HEAD
    public function tableExists(null|string $table = null): bool
=======
    public function tableExists(?string $table = null): bool
>>>>>>> f1d4085 (.)
    {
        return $this->getConn()->hasTable($table ?? $this->getTable());
    }

    public function hasColumn(string $column): bool
    {
        return $this->getConn()->hasColumn($this->getTable(), $column);
    }

    public function hasTable(string $table): bool
    {
        return $this->getConn()->hasTable($table);
    }

    public function getColumnType(string $column): string
    {
        try {
            return $this->getConn()->getColumnType($this->getTable(), $column);
        } catch (Exception $e) {
            return 'not-exists';
        }
    }

    public function isColumnType(string $column, string $type): bool
    {
        return $this->hasColumn($column) && $this->getColumnType($column) === $type;
    }

    public function query(string $sql): void
    {
        $this->getConn()->getConnection()->statement($sql);
    }

    public function hasIndex(string $column): bool
    {
        return $this->getConn()->hasIndex($this->getTable(), $column);
    }

    /**
     * Check if the table has a primary key.
     */
    public function hasPrimaryKey(): bool
    {
        // Commentato perché dipende da Doctrine DBAL
        // return $this->getTableDetails()->hasPrimaryKey();
        $connection = $this->getConn()->getConnection();
        $table = $this->getTable();
        $database = $connection->getDatabaseName();

        $query = "SELECT COUNT(*) as count
              FROM information_schema.table_constraints
              WHERE table_schema = ?
              AND table_name = ?
              AND constraint_type = 'PRIMARY KEY'";

        $result = $connection->selectOne($query, [$database, $table]);

        // Check if result is an array or object and handle accordingly
        if (is_array($result)) {
<<<<<<< HEAD
            return isset($result['count']) && ((int) $result['count']) > 0;
=======
            return isset($result['count']) && (int) $result['count'] > 0;
>>>>>>> f1d4085 (.)
        }

        // If it's an object, cast to array to avoid undefined property issues
        if (is_object($result)) {
            $resArray = (array) $result;
<<<<<<< HEAD
            return isset($resArray['count']) && ((int) $resArray['count']) > 0;
=======
            return isset($resArray['count']) && (int) $resArray['count'] > 0;
>>>>>>> f1d4085 (.)
        }

        // If neither, handle the error or unexpected case
        return false;
    }

    /**
     * Drop the primary key from the table.
     */
    public function dropPrimaryKey(): void
    {
<<<<<<< HEAD
        $sql = 'ALTER TABLE ' . $this->getTable() . ' DROP PRIMARY KEY;';
=======
        $sql = 'ALTER TABLE '.$this->getTable().' DROP PRIMARY KEY;';
>>>>>>> f1d4085 (.)
        $this->query($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $this->dropTableIfExists($this->getTable());
    }

    public function dropTableIfExists(string $table): void
    {
        $this->getConn()->dropIfExists($table);
    }

    public function renameTable(string $from, string $to): void
    {
        if ($this->tableExists($from)) {
            $this->getConn()->rename($from, $to);
        }
    }

    public function renameColumn(string $from, string $to): void
    {
        $this->getConn()->table($this->getTable(), function (Blueprint $table) use ($from, $to) {
<<<<<<< HEAD
            $table->renameColumn($from, $to);
        });
    }

    public function tableCreate(Closure $next, null|string $table = null): void
    {
        $tableName = $table ?? $this->getTable();
        if (!$this->tableExists($tableName)) {
=======

                $table->renameColumn($from, $to);

        });
    }

    public function tableCreate(Closure $next, ?string $table = null): void
    {
        $tableName = $table ?? $this->getTable();
        if (! $this->tableExists($tableName)) {
>>>>>>> f1d4085 (.)
            $this->getConn()->create($tableName, $next);
        }
    }

<<<<<<< HEAD
    public function tableUpdate(Closure $next, null|string $table = null): void
=======
    public function tableUpdate(Closure $next, ?string $table = null): void
>>>>>>> f1d4085 (.)
    {
        $tableName = $table ?? $this->getTable();
        $this->getConn()->table($tableName, $next);
    }

    public function timestamps(Blueprint $table, bool $hasSoftDeletes = false): void
    {
        $xot = XotData::make();
        $userClass = $xot->getUserClass();

<<<<<<< HEAD
        $table->timestamps();
        $table->foreignIdFor($userClass, 'user_id')->nullable();
        $table->foreignIdFor($userClass, 'updated_by')->nullable();
        $table->foreignIdFor($userClass, 'created_by')->nullable();

        if ($hasSoftDeletes) {
=======

            $table->timestamps();
            $table->foreignIdFor($userClass, 'user_id')->nullable();
            $table->foreignIdFor($userClass, 'updated_by')->nullable();
            $table->foreignIdFor($userClass, 'created_by')->nullable();


        if ($hasSoftDeletes ) {
>>>>>>> f1d4085 (.)
            $table->softDeletes();
        }
    }

    public function updateTimestamps(Blueprint $table, bool $hasSoftDeletes = false): void
    {
        $xot = XotData::make();
        $userClass = $xot->getUserClass();

<<<<<<< HEAD
        if (!$this->hasColumn('updated_at') && !$this->hasColumn('created_at')) {
            $table->timestamps();
        }

        if (!$this->hasColumn('updated_by')) {
            $table->foreignIdFor($userClass, 'updated_by')->nullable();
        }

        if (!$this->hasColumn('created_by')) {
            $table->foreignIdFor($userClass, 'created_by')->nullable();
        }

        if ($hasSoftDeletes && !$this->hasColumn('deleted_at')) {
            $table->softDeletes();
            if (!$this->hasColumn('deleted_by')) {
=======
        if (! $this->hasColumn('updated_at') && ! $this->hasColumn('created_at')) {
            $table->timestamps();
        }

        if (! $this->hasColumn('updated_by')) {
            $table->foreignIdFor($userClass, 'updated_by')->nullable();
        }

        if (! $this->hasColumn('created_by')) {
            $table->foreignIdFor($userClass, 'created_by')->nullable();
        }

        if ($hasSoftDeletes && ! $this->hasColumn('deleted_at')) {
            $table->softDeletes();
            if (! $this->hasColumn('deleted_by')) {
>>>>>>> f1d4085 (.)
                $table->foreignIdFor($userClass, 'deleted_by')->nullable();
            }
        }

<<<<<<< HEAD
        if ($this->hasColumn('deleted_at') && !$this->hasColumn('deleted_by')) {
=======
        if ($this->hasColumn('deleted_at') && ! $this->hasColumn('deleted_by')) {
>>>>>>> f1d4085 (.)
            $table->foreignIdFor($userClass, 'deleted_by')->nullable();
        }
    }

    public function updateUser(Blueprint $table): void
    {
<<<<<<< HEAD
        $methodName = 'updateUserKey' . Str::studly($this->model->getKeyType());
        $this->{$methodName}($table);

        if ($this->hasColumn('model_id') && 'bigint' === $this->getColumnType('model_id')) {
            $table->string('model_id', 36)->index()->change();
        }

        if ($this->hasColumn('team_id') && 'bigint' === $this->getColumnType('team_id')) {
            $table->uuid('team_id')->nullable()->change();
=======
        $methodName = 'updateUserKey'.Str::studly($this->model->getKeyType());
        $this->{$methodName}($table);

        if ($this->hasColumn('model_id') && 'bigint' === $this->getColumnType('model_id')) {

                $table->string('model_id', 36)->index()->change();

        }

        if ($this->hasColumn('team_id') && 'bigint' === $this->getColumnType('team_id')) {

                $table->uuid('team_id')->nullable()->change();

>>>>>>> f1d4085 (.)
        }
    }

    public function updateUserKeyString(Blueprint $table): void
    {
<<<<<<< HEAD
        if (!$this->hasColumn('id')) {
=======
        if (! $this->hasColumn('id')) {
>>>>>>> f1d4085 (.)
            $table->uuid('id')->primary()->first();
        }

        if ($this->hasColumn('id') && 'bigint' === $this->getColumnType('id')) {
            $table->uuid('id')->change();
        }

        if ($this->hasColumn('user_id') && 'bigint' === $this->getColumnType('user_id')) {
            $table->uuid('user_id')->change();
        }
    }

    public function updateUserKeyInt(Blueprint $table): void
    {
<<<<<<< HEAD
        if (!$this->hasColumn('id')) {
=======
        if (! $this->hasColumn('id')) {
>>>>>>> f1d4085 (.)
            $table->id('id')->first();
        }

        if ($this->hasColumn('id') && in_array($this->getColumnType('id'), ['string', 'guid'], true)) {
            $table->renameColumn('id', 'uuid');
        }
    }

    /**
     * Get the migration connection name.
     */
<<<<<<< HEAD
    public function getConnection(): null|string
=======
    public function getConnection(): ?string
>>>>>>> f1d4085 (.)
    {
        /** @var string */
        $pulse_connection = Config::get('pulse.storage.database.connection');

        return $pulse_connection;
    }

    /**
     * Determine if the migration should run.
     */
    public function shouldRun(): bool
    {
<<<<<<< HEAD
        if (in_array($this->driver(), ['mariadb', 'mysql', 'pgsql', 'sqlite'], strict: true)) {
            return true;
        }

        if (!App::environment('testing')) {
=======
        if (in_array($this->driver(), ['mariadb', 'mysql', 'pgsql', 'sqlite'])) {
            return true;
        }

        if (! App::environment('testing')) {
>>>>>>> f1d4085 (.)
            throw new RuntimeException("Pulse does not support the [{$this->driver()}] database driver.");
        }

        if (Config::get('pulse.enabled')) {
<<<<<<< HEAD
            throw new RuntimeException(
                "Pulse does not support the [{$this->driver()}] database driver. You can disable Pulse in your testsuite by adding `<env name=\"PULSE_ENABLED\" value=\"false\"/>` to your project's `phpunit.xml` file.",
            );
=======
            throw new RuntimeException("Pulse does not support the [{$this->driver()}] database driver. You can disable Pulse in your testsuite by adding `<env name=\"PULSE_ENABLED\" value=\"false\"/>` to your project's `phpunit.xml` file.");
>>>>>>> f1d4085 (.)
        }

        return false;
    }

    /**
     * Get the database connection driver.
     */
    protected function driver(): string
    {
        return DB::connection($this->getConnection())->getDriverName();
    }
<<<<<<< HEAD

=======
>>>>>>> f1d4085 (.)
    /**
     * Add a foreign ID column to the table based on a related model.
     *
     * @param Blueprint $table
     * @param  string  $class
     * @param  string|null  $column
     * @return ColumnDefinition
     */
<<<<<<< HEAD
    public function foreignIdFor($table, string $class, null|string $column = null)
    {
        return $table->foreignIdFor($class, $column);
    }
}

// end XotBaseMigration
=======
    public function foreignIdFor($table, string $class, ?string $column = null) {
        return $table->foreignIdFor($class, $column);
    } 


}// end XotBaseMigration
>>>>>>> f1d4085 (.)
