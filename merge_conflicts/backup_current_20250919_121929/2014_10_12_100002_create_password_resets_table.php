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
        $this->tableCreate(function (Blueprint $table): void {
            $table->id();
            $table->string('uuid', 36)->nullable()->index();
            $table->string('email')->index();
            $table->string('token');
            // $table->timestamp('created_at')->nullable();
            $this->timestamps($table);
        });

        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $table): void {
            // if (! $this->hasColumn('email')) {
            //    $table->string('email')->nullable();
            // }
            // $this->updateUser($table);
            if ($this->getColumnType('id') === 'uuid') {
                $table->dropColumn('id');
            }
            if (!$this->hasColumn('id')) {
                $table->id();
            }
        });
=======
        $this->tableCreate(
            function (Blueprint $table): void {
                $table->id();
                $table->string('uuid', 36)->nullable()->index();
                $table->string('email')->index();
                $table->string('token');
                // $table->timestamp('created_at')->nullable();
                $this->timestamps($table);
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                // if (! $this->hasColumn('email')) {
                //    $table->string('email')->nullable();
                // }
                // $this->updateUser($table);
                if ($this->getColumnType('id') === 'uuid') {
                    $table->dropColumn('id');
                }
                if (! $this->hasColumn('id')) {
                    $table->id();
                }
            }
        );
>>>>>>> fbc8f8e (.)
    }
};
