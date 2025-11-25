<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
// ---- models ---
use Modules\Xot\Database\Migrations\XotBaseMigration;
use Modules\Xot\Datas\XotData;

/*
 * Class CreateModelHasPermissionsTable.
 */
<<<<<<< HEAD
return new class extends XotBaseMigration {
=======
return new class extends XotBaseMigration
{
>>>>>>> fbc8f8e (.)
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
<<<<<<< HEAD
        $this->tableCreate(static function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('permission_id');
            $table->uuidMorphs('model');
        });
        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $table): void {
            $team_class = XotData::make()->getTeamClass();
            if (!$this->hasColumn('team_id')) {
                $table->foreignIdFor($team_class, 'team_id')->nullable();
            }
            if ($this->getColumnType('model_id') === 'uuid') {
                $table->string('model_id', 36)->index()->change();
            }
            $this->updateTimestamps($table);

            // $this->updateUser($table);
        });
=======
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->unsignedBigInteger('permission_id');
                $table->uuidMorphs('model');
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                $team_class = XotData::make()->getTeamClass();
                if (! $this->hasColumn('team_id')) {
                    $table->foreignIdFor($team_class, 'team_id')->nullable();
                }
                if ($this->getColumnType('model_id') === 'uuid') {
                    $table->string('model_id', 36)->index()->change();
                }
                $this->updateTimestamps($table);
                // $this->updateUser($table);
            }
        );
>>>>>>> fbc8f8e (.)
    }
};
