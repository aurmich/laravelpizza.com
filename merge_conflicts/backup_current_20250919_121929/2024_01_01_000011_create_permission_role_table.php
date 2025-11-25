<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\User\Models\Permission;
use Modules\User\Models\Role;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 * Class CreateRolesTable.
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
            $table->foreignIdFor(Permission::class, 'permission_id')->nullable();
            $table->foreignIdFor(Role::class, 'role_id')->nullable();
        });
        // -- UPDATE --
        $this->tableUpdate(function (Blueprint $table): void {
            $this->updateTimestamps($table);
        });
=======
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->foreignIdFor(Permission::class, 'permission_id')
                    ->nullable();
                $table->foreignIdFor(Role::class, 'role_id')
                    ->nullable();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                $this->updateTimestamps($table);
            }
        );
>>>>>>> fbc8f8e (.)
    }
};
