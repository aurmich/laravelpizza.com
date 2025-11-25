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
            // $table->morphs('authenticatable');
            $table->uuidMorphs('authenticatable', 'k_authenticatable');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('login_at')->nullable();
            $table->boolean('login_successful')->default(false);
            $table->timestamp('logout_at')->nullable();
            $table->boolean('cleared_by_user')->default(false);
            $table->json('location')->nullable();
        });

        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $table): void {
            // if (! $this->hasColumn('email')) {
            //    $table->string('email')->nullable();
            // }
            $this->updateTimestamps($table);
        });
=======
        $this->tableCreate(
            function (Blueprint $table): void {
                $table->id();
                // $table->morphs('authenticatable');
                $table->uuidMorphs('authenticatable', 'k_authenticatable');
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamp('login_at')->nullable();
                $table->boolean('login_successful')->default(false);
                $table->timestamp('logout_at')->nullable();
                $table->boolean('cleared_by_user')->default(false);
                $table->json('location')->nullable();
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                // if (! $this->hasColumn('email')) {
                //    $table->string('email')->nullable();
                // }
                $this->updateTimestamps($table);
            }
        );
>>>>>>> fbc8f8e (.)
    }
};
