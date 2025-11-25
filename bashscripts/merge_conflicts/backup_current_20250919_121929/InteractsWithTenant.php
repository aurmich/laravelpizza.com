<?php

declare(strict_types=1);

namespace Modules\User\Models\Traits;

use Throwable;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Contracts\TeamContract;
use Modules\User\Models\Scopes\TenantScope;
use Modules\User\Models\Tenant;
use Modules\Xot\Datas\XotData;

/**
 * @property TeamContract $currentTeam
 */
trait InteractsWithTenant
{
    /**
     * Tenant corrente.
     *
     * @var Model|null
     */
<<<<<<< HEAD
    protected null|Model $currentTenant = null;
=======
    protected ?Model $currentTenant = null;
>>>>>>> fbc8f8e (.)

    /**
     * Relazione con il tenant a cui appartiene il modello.
     *
     * @return BelongsTo<Model, self>
     * @phpstan-return BelongsTo<Model, $this>
     */
    public function tenant(): BelongsTo
    {
        $tenant = $this->getTenant();
        if ($tenant === null) {
            $this->loadTenantFromSession();
            $tenant = $this->getTenant();
        }

        $tenantClass = config('tenant.tenant_model', Tenant::class);

        // @phpstan-ignore argument.type, argument.templateType
        return $this->belongsTo($tenantClass, 'tenant_id');
    }

    /**
     * Ottiene il tenant corrente.
     *
     * @return Model|null
     */
<<<<<<< HEAD
    protected function getTenant(): null|Model
=======
    protected function getTenant(): ?Model
>>>>>>> fbc8f8e (.)
    {
        return $this->currentTenant;
    }

    /**
     * Carica il tenant dalla sessione.
     *
     * @return void
     */
    protected function loadTenantFromSession(): void
    {
        try {
            $this->currentTenant = Filament::getTenant();
        } catch (Throwable $e) {
            // Se Filament non è disponibile, lascia il tenant come null
            $this->currentTenant = null;
        }
    }

    /**
     * The "booted" method of the model.
     */
    protected static function bootInteractsWithTenant(): void
    {
<<<<<<< HEAD
        static::addGlobalScope(new TenantScope());

        static::creating(static function ($model): void {
            if ($model !== null) {
                $tenant = Filament::getTenant();
                if ($tenant !== null) {
                    $model->tenant_id = $tenant->getKey();
                }
            }
        });
=======
        static::addGlobalScope(new TenantScope);

        static::creating(
            static function ($model): void {
                if ($model !== null) {
                    $tenant = Filament::getTenant();
                    if ($tenant !== null) {
                        $model->tenant_id = $tenant->getKey();
                    }
                }
            }
        );
>>>>>>> fbc8f8e (.)
    }

    /**
     * Interact with the user's first name.
     */
<<<<<<< HEAD
    protected function setTenantIdAttribute(null|int $value): void
=======
    protected function setTenantIdAttribute(?int $value): void
>>>>>>> fbc8f8e (.)
    {
        $tenant = Filament::getTenant();
        if ($value === null && $tenant !== null) {
            $tenantId = $tenant->getKey();
            if (is_int($tenantId)) {
                $value = $tenantId;
            }
        }

        if ($value !== null) {
            $this->attributes['tenant_id'] = $value;
        }
    }

    /**
     * Applica lo scope del tenant.
     */
    protected function applyTenantScope(): void
    {
        $tenant = $this->getTenant();
        if ($tenant === null) {
            $this->loadTenantFromSession();
            $tenant = $this->getTenant();
        }

        if ($tenant !== null) {
            $tenantId = $tenant->getKey();
            if ($tenantId !== null) {
                static::addGlobalScope(new TenantScope());
            }
        }
    }
}
