<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

<<<<<<< HEAD
return new class extends XotBaseMigration {
=======
return new class extends XotBaseMigration
{
>>>>>>> e1b0bf9 (.)
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
<<<<<<< HEAD
        $this->tableCreate(static function (Blueprint $table): void {
            $table->id();
            // $table->unsignedBigInteger('schedule_id');
            $table->string('command');
            $table->text('params')->nullable();
            $table->text('output');
            $table->text('options')->nullable();

            /*
             * $table->foreign('schedule_id')
             * ->references('id')
             * ->on(Config::get('filament-database-schedule.table.schedules', 'schedules'));
             */
            $table->integer('schedule_id')->nullable();
        });
        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $table): void {
            $this->updateTimestamps(
                table: $table,
                hasSoftDeletes: true,
            );
        });
=======
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                // $table->unsignedBigInteger('schedule_id');
                $table->string('command');
                $table->text('params')->nullable();
                $table->text('output');
                $table->text('options')->nullable();

                /*
                            $table->foreign('schedule_id')
                                ->references('id')
                                ->on(Config::get('filament-database-schedule.table.schedules', 'schedules'));
                            */
                $table->integer('schedule_id')->nullable();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
>>>>>>> e1b0bf9 (.)
    }
};
