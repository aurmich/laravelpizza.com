<?php

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
            $table->uuid('uuid');
            $table->string('team_id', 36)->nullable()->index();
            $table->string('email');
            $table->string('role')->nullable();

            // $table->unique(['team_id', 'email']);
        });

        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $table): void {
            // if ($this->hasIndexName('team_invitations_team_id_foreign')) {
            //    $table->dropForeign('team_invitations_team_id_foreign');
            // }

            $this->updateTimestamps($table, true);
        });
=======
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->uuid('uuid');
                $table->string('team_id', 36)->nullable()->index();
                $table->string('email');
                $table->string('role')->nullable();
                // $table->unique(['team_id', 'email']);
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                // if ($this->hasIndexName('team_invitations_team_id_foreign')) {
                //    $table->dropForeign('team_invitations_team_id_foreign');
                // }

                $this->updateTimestamps($table, true);
            }
        );
>>>>>>> fbc8f8e (.)
    }
};
