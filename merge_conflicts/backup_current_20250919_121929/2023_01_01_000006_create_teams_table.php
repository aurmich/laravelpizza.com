<?php

/**
 * ---.
 */

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

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
            $table->uuid('uuid')->nullable()->index();
            $table->string('user_id', 36)->nullable()->index();
            // $table->foreignIdFor(\Modules\Xot\Datas\XotData::make()->getUserClass());
            $table->string('name');
            $table->boolean('personal_team')->default(false);
        });
        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $table): void {
            // MySqlConnection::getDoctrineSchemaManager does not exist.
            // MySqlConnection::getSchemaGrammar() ?
            // if ($this->hasIndexName('team_invitations_team_id_foreign')) {
            //    $table->dropForeign('team_invitations_team_id_foreign');
            // }
            if ($this->hasColumn('uuid')) {
                $table->uuid('uuid')->nullable()->change();
            }
            if ($this->hasColumn('personal_team')) {
                $table->boolean('personal_team')->default(false)->change();
            }

            if (!$this->hasColumn('code')) {
                $table->string('code', 36)->nullable()->index();
            }
            $this->updateTimestamps($table, true);

            // $this->updateUser($table);
        });
=======
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->uuid('uuid')->nullable()->index();
                $table->string('user_id', 36)->nullable()->index();
                // $table->foreignIdFor(\Modules\Xot\Datas\XotData::make()->getUserClass());
                $table->string('name');
                $table->boolean('personal_team')->default(false);
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                // MySqlConnection::getDoctrineSchemaManager does not exist.
                // MySqlConnection::getSchemaGrammar() ?
                // if ($this->hasIndexName('team_invitations_team_id_foreign')) {
                //    $table->dropForeign('team_invitations_team_id_foreign');
                // }
                if ($this->hasColumn('uuid')) {
                    $table->uuid('uuid')->nullable()->change();
                }
                if ($this->hasColumn('personal_team')) {
                    $table->boolean('personal_team')->default(false)->change();
                }

                if (! $this->hasColumn('code')) {
                    $table->string('code', 36)->nullable()->index();
                }
                $this->updateTimestamps($table, true);
                // $this->updateUser($table);
            }
        );
>>>>>>> fbc8f8e (.)
    }
};
