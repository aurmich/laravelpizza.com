<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use InvalidArgumentException;
use Modules\Tenant\Models\Traits\SushiToJson;
use Sushi\Sushi;
use Webmozart\Assert\Assert;
=======
use Sushi\Sushi;
use Webmozart\Assert\Assert;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
>>>>>>> f1d4085 (.)

/**
 * Represents a table in the INFORMATION_SCHEMA.TABLES.
 *
 * Provides metadata and statistics about database tables.
 *
 * @property string|null $TABLE_CATALOG
 * @property string|null $TABLE_SCHEMA
 * @property string|null $TABLE_NAME
 * @property string|null $TABLE_TYPE
 * @property string|null $ENGINE
 * @property int|null $VERSION
 * @property string|null $ROW_FORMAT
<<<<<<< HEAD
 * @property int|null $table_rows
=======
 * @property int|null $TABLE_ROWS
>>>>>>> f1d4085 (.)
 * @property int|null $AVG_ROW_LENGTH
 * @property int|null $DATA_LENGTH
 * @property int|null $MAX_DATA_LENGTH
 * @property int|null $INDEX_LENGTH
 * @property int|null $DATA_FREE
 * @property int|null $AUTO_INCREMENT
 * @property Carbon|null $CREATE_TIME
 * @property Carbon|null $UPDATE_TIME
 * @property Carbon|null $CHECK_TIME
 * @property string|null $TABLE_COLLATION
 * @property int|null $CHECKSUM
 * @property string|null $CREATE_OPTIONS
 * @property string|null $TABLE_COMMENT
 * @property int $id
 * @method static Builder<static>|InformationSchemaTable newModelQuery()
 * @method static Builder<static>|InformationSchemaTable newQuery()
 * @method static Builder<static>|InformationSchemaTable query()
 * @method static Builder<static>|InformationSchemaTable whereAUTOINCREMENT($value)
 * @method static Builder<static>|InformationSchemaTable whereAVGROWLENGTH($value)
 * @method static Builder<static>|InformationSchemaTable whereCHECKSUM($value)
 * @method static Builder<static>|InformationSchemaTable whereCHECKTIME($value)
 * @method static Builder<static>|InformationSchemaTable whereCREATEOPTIONS($value)
 * @method static Builder<static>|InformationSchemaTable whereCREATETIME($value)
 * @method static Builder<static>|InformationSchemaTable whereDATAFREE($value)
 * @method static Builder<static>|InformationSchemaTable whereDATALENGTH($value)
 * @method static Builder<static>|InformationSchemaTable whereENGINE($value)
 * @method static Builder<static>|InformationSchemaTable whereINDEXLENGTH($value)
 * @method static Builder<static>|InformationSchemaTable whereId($value)
 * @method static Builder<static>|InformationSchemaTable whereMAXDATALENGTH($value)
 * @method static Builder<static>|InformationSchemaTable whereROWFORMAT($value)
 * @method static Builder<static>|InformationSchemaTable whereTABLECATALOG($value)
 * @method static Builder<static>|InformationSchemaTable whereTABLECOLLATION($value)
 * @method static Builder<static>|InformationSchemaTable whereTABLECOMMENT($value)
 * @method static Builder<static>|InformationSchemaTable whereTABLENAME($value)
 * @method static Builder<static>|InformationSchemaTable whereTABLEROWS($value)
 * @method static Builder<static>|InformationSchemaTable whereTABLESCHEMA($value)
 * @method static Builder<static>|InformationSchemaTable whereTABLETYPE($value)
 * @method static Builder<static>|InformationSchemaTable whereUPDATETIME($value)
 * @method static Builder<static>|InformationSchemaTable whereVERSION($value)
<<<<<<< HEAD
 * @property string|null $table_schema
 * @property string|null $table_name
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_at
 * @property string|null $created_by
 * @method static Builder<static>|InformationSchemaTable whereCreatedAt($value)
 * @method static Builder<static>|InformationSchemaTable whereCreatedBy($value)
 * @method static Builder<static>|InformationSchemaTable whereTableName($value)
 * @method static Builder<static>|InformationSchemaTable whereTableRows($value)
 * @method static Builder<static>|InformationSchemaTable whereTableSchema($value)
 * @method static Builder<static>|InformationSchemaTable whereUpdatedAt($value)
 * @method static Builder<static>|InformationSchemaTable whereUpdatedBy($value)
=======
>>>>>>> f1d4085 (.)
 * @mixin \Eloquent
 */
class InformationSchemaTable extends Model
{
<<<<<<< HEAD
    use SushiToJson;
=======
    use Sushi;

    /**
     * The connection name for the model.
     */
    protected $connection = 'information_schema';

    /**
     * The table associated with the model.
     */
    protected $table = 'tables';

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;
>>>>>>> f1d4085 (.)

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'table_schema',
        'table_name',
<<<<<<< HEAD
        'table_rows',
        'model_class',
        'updated_at',
        'updated_by',
        'created_at',
        'created_by',
=======
        'engine',
        'version',
        'row_format',
        'table_rows',
        'avg_row_length',
        'data_length',
        'max_data_length',
        'index_length',
        'data_free',
        'create_time',
        'update_time',
        'check_time',
        'table_collation',
        'checksum',
        'create_options',
        'table_comment',
>>>>>>> f1d4085 (.)
    ];

    /**
     * The schema for the Sushi model.
     *
     * @var array<string, string>
     */
    protected $schema = [
        'id' => 'integer',
<<<<<<< HEAD
        'table_schema' => 'string',
        'table_name' => 'string',
        'table_rows' => 'integer',
        'model_class' => 'string',
        'updated_at' => 'datetime',
        'updated_by' => 'string',
        'created_at' => 'datetime',
        'created_by' => 'string',
    ];

=======
        'TABLE_CATALOG' => 'string',
        'TABLE_SCHEMA' => 'string',
        'TABLE_NAME' => 'string',
        'TABLE_TYPE' => 'string',
        'ENGINE' => 'string',
        'VERSION' => 'integer',
        'ROW_FORMAT' => 'string',
        'TABLE_ROWS' => 'integer',
        'AVG_ROW_LENGTH' => 'integer',
        'DATA_LENGTH' => 'integer',
        'MAX_DATA_LENGTH' => 'integer',
        'INDEX_LENGTH' => 'integer',
        'DATA_FREE' => 'integer',
        'AUTO_INCREMENT' => 'integer',
        'CREATE_TIME' => 'datetime',
        'UPDATE_TIME' => 'datetime',
        'CHECK_TIME' => 'datetime',
        'TABLE_COLLATION' => 'string',
        'CHECKSUM' => 'integer',
        'CREATE_OPTIONS' => 'string',
        'TABLE_COMMENT' => 'string',
    ];

    
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return array_merge(parent::casts(), [
            'TABLE_ROWS' => 'integer',
            'AVG_ROW_LENGTH' => 'integer',
            'DATA_LENGTH' => 'integer',
            'MAX_DATA_LENGTH' => 'integer',
            'INDEX_LENGTH' => 'integer',
            'DATA_FREE' => 'integer',
            'AUTO_INCREMENT' => 'integer',
            'CHECKSUM' => 'integer',
            'CREATE_TIME' => 'datetime',
            'UPDATE_TIME' => 'datetime',
            'CHECK_TIME' => 'datetime',
            'VERSION' => 'integer',
        ]);
    }

>>>>>>> f1d4085 (.)
    /**
     * Get the rows array for the Sushi model.
     * This method is required by Sushi to provide the data.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getRows(): array
    {
<<<<<<< HEAD
        return $this->getSushiRows();
    }

    public static function updateModelCount(string $modelClass, int $total): void
    {
        if (!class_exists($modelClass)) {
            throw new InvalidArgumentException("Model class [{$modelClass}] does not exist");
        }

        /** @var Model $model */
        $model = app($modelClass);

        if (!($model instanceof Model)) {
            throw new InvalidArgumentException("Class [{$modelClass}] must be an instance of " . Model::class);
        }

        $connection = $model->getConnection();
        $database = $connection->getDatabaseName();
        $driver = $connection->getDriverName();
        $table = $model->getTable();
        $where = ['table_schema' => $database, 'model_class' => $modelClass, 'table_name' => $table];
        $row = InformationSchemaTable::updateOrCreate($where, ['table_rows' => $total]);
=======
        $query = "SELECT 
            TABLE_CATALOG,
            TABLE_SCHEMA,
            TABLE_NAME,
            TABLE_TYPE,
            ENGINE,
            VERSION,
            ROW_FORMAT,
            TABLE_ROWS,
            AVG_ROW_LENGTH,
            DATA_LENGTH,
            MAX_DATA_LENGTH,
            INDEX_LENGTH,
            DATA_FREE,
            AUTO_INCREMENT,
            CREATE_TIME,
            UPDATE_TIME,
            CHECK_TIME,
            TABLE_COLLATION,
            CHECKSUM,
            CREATE_OPTIONS,
            TABLE_COMMENT
        FROM information_schema.TABLES
        WHERE TABLE_SCHEMA = ?";

        $results = collect(DB::select($query, [DB::connection()->getDatabaseName()]))
            ->map(function ($row, $index) {
                $data = (array) $row;
                $data['id'] = $index + 1; // Aggiungi un ID incrementale
                return $data;
            })
            ->toArray();

        /** @var array<int, array<string, mixed>> */
        return $results;
    }

    /**
     * Get table statistics from Sushi or information_schema as fallback.
     *
     * @param string $schema The schema name
     * @param string $table The table name
     */
    public static function getTableStats(string $schema, string $table): ?self
    {
        $result = DB::connection('mysql')
            ->table('information_schema.TABLES')
            ->select([
                'TABLE_CATALOG',
                'TABLE_SCHEMA',
                'TABLE_NAME',
                'TABLE_TYPE',
                'ENGINE',
                'VERSION',
                'ROW_FORMAT',
                'TABLE_ROWS',
                'AVG_ROW_LENGTH',
                'DATA_LENGTH',
                'MAX_DATA_LENGTH',
                'INDEX_LENGTH',
                'DATA_FREE',
                'AUTO_INCREMENT',
                'CREATE_TIME',
                'UPDATE_TIME',
                'CHECK_TIME',
                'TABLE_COLLATION',
                'CHECKSUM',
                'CREATE_OPTIONS',
                'TABLE_COMMENT'
            ])
            ->where('TABLE_SCHEMA', '=', $schema)
            ->where('TABLE_NAME', '=', $table)
            ->first();

        if (!$result) {
            return null;
        }

        // Creiamo una nuova istanza e popoliamola manualmente
        $instance = new self();
        foreach ((array) $result as $key => $value) {
            $instance->setAttribute($key, $value);
        }
        return $instance;
>>>>>>> f1d4085 (.)
    }

    /**
     * Get the row count for a model class.
     * This method incorporates the logic from CountAction.
     *
     * @param class-string<Model> $modelClass The fully qualified model class name
     *
     * @throws InvalidArgumentException If model class is invalid or not found
     */
    public static function getModelCount(string $modelClass): int
    {
<<<<<<< HEAD
        if (!class_exists($modelClass)) {
            throw new InvalidArgumentException("Model class [{$modelClass}] does not exist");
=======
        if (! class_exists($modelClass)) {
            throw new InvalidArgumentException("Model class [$modelClass] does not exist");
>>>>>>> f1d4085 (.)
        }

        /** @var Model $model */
        $model = app($modelClass);

<<<<<<< HEAD
        if (!($model instanceof Model)) {
            throw new InvalidArgumentException("Class [{$modelClass}] must be an instance of " . Model::class);
=======
        if (! $model instanceof Model) {
            throw new InvalidArgumentException("Class [$modelClass] must be an instance of ".Model::class);
>>>>>>> f1d4085 (.)
        }

        $connection = $model->getConnection();
        $database = $connection->getDatabaseName();
        $driver = $connection->getDriverName();
        $table = $model->getTable();

<<<<<<< HEAD
        $where = ['table_schema' => $database, 'model_class' => $modelClass, 'table_name' => $table];
        $row = InformationSchemaTable::firstOrCreate($where);
        if ($row->table_rows === null) {
            $table_rows = $model->count();
            $row = tap($row)->update(['table_rows' => $table_rows]);
        }

        return intval($row->table_rows);

        /*
         * // Handle in-memory database
         * if (':memory:' === $database) {
         * return (int) $model->count();
         * }
         *
         * // Handle SQLite specifically
         * if ('sqlite' === $driver) {
         * return (int) $model->count();
         * }
         *
         * return $model->count();
         *
         * return static::getAccurateRowCount($table, $database);
         */
=======
        // Handle in-memory database
        if (':memory:' === $database) {
            return (int) $model->count();
        }

        // Handle SQLite specifically
        if ('sqlite' === $driver) {
            return (int) $model->count();
        }

        return static::getAccurateRowCount($table, $database);
    }

    /**
     * Get accurate row count for a table.
     *
     * @param string $tableName The name of the table
     * @param string $database The database name
     */
    public static function getAccurateRowCount(string $tableName, string $database): int
    {
        $stats = static::getTableStats($database, $tableName);
        if ($stats === null) {
            return 0;
        }

        $rows = $stats->getAttribute('TABLE_ROWS');
        if ($rows === null) {
            return 0;
        }
        Assert::numeric($rows);
        return (int) $rows;
    }

    /**
     * Get table size in bytes.
     *
     * @param string $tableName The name of the table
     * @param string $database The database name
     */
    public static function getTableSize(string $tableName, string $database): int
    {
        $stats = static::getTableStats($database, $tableName);
        if ($stats === null) {
            return 0;
        }

        $dataLength = $stats->getAttribute('DATA_LENGTH');
        $indexLength = $stats->getAttribute('INDEX_LENGTH');

        if ($dataLength === null || $indexLength === null) {
            return 0;
        }

        // Assicuriamo che i valori siano convertiti correttamente in intero
        $dataLengthInt = is_numeric($dataLength) ? (int) $dataLength : 0;
        $indexLengthInt = is_numeric($indexLength) ? (int) $indexLength : 0;
        
        return $dataLengthInt + $indexLengthInt;
    }

    /**
     * Refresh the cache for a specific table.
     *
     * @param string $tableName The name of the table
     * @param string $database The database name
     */
    public static function refreshCache(string $tableName, string $database): void
    {
        DB::connection('mysql')
            ->statement("ANALYZE TABLE `{$database}`.`{$tableName}`");
>>>>>>> f1d4085 (.)
    }
}
