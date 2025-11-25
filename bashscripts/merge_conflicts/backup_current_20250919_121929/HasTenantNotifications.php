<?php

declare(strict_types=1);

namespace Modules\Notify\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Notify\Models\NotificationLog;
use Modules\Tenant\Services\TenantManager;

trait HasTenantNotifications
{
    /**
     * Ottiene tutte le notifiche per il tenant corrente.
     *
     * @return MorphMany
     */
    public function notifications(): MorphMany
    {
<<<<<<< HEAD
        return $this->morphMany(NotificationLog::class, 'notifiable')->where('tenant_id', $this->getTenantId());
=======
        return $this->morphMany(NotificationLog::class, 'notifiable')
            ->where('tenant_id', $this->getTenantId());
>>>>>>> b19cd40 (.)
    }

    /**
     * Ottiene le notifiche non lette per il tenant corrente.
     *
     * @return MorphMany
     */
    public function unreadNotifications(): MorphMany
    {
<<<<<<< HEAD
        return $this->notifications()->whereNull('read_at');
=======
        return $this->notifications()
            ->whereNull('read_at');
>>>>>>> b19cd40 (.)
    }

    /**
     * Ottiene le notifiche lette per il tenant corrente.
     *
     * @return MorphMany
     */
    public function readNotifications(): MorphMany
    {
<<<<<<< HEAD
        return $this->notifications()->whereNotNull('read_at');
=======
        return $this->notifications()
            ->whereNotNull('read_at');
>>>>>>> b19cd40 (.)
    }

    /**
     * Scope per filtrare le notifiche per tenant.
     *
     * @param Builder $query
     * @param string|null $tenantId
     * @return Builder
     */
<<<<<<< HEAD
    public function scopeForTenant(Builder $query, null|string $tenantId = null): Builder
    {
        $tenantId ??= $this->getTenantId();
=======
    public function scopeForTenant(Builder $query, ?string $tenantId = null): Builder
    {
        $tenantId = $tenantId ?? $this->getTenantId();
>>>>>>> b19cd40 (.)
        return $query->where('tenant_id', $tenantId);
    }

    /**
     * Ottiene l'ID del tenant corrente.
     *
     * @return string|null
     */
<<<<<<< HEAD
    protected function getTenantId(): null|string
=======
    protected function getTenantId(): ?string
>>>>>>> b19cd40 (.)
    {
        /** @var TenantManager */
        $tenantManager = app(TenantManager::class);
        return $tenantManager->getTenantId();
    }

    /**
     * Verifica se il modello appartiene al tenant specificato.
     *
     * @param string $tenantId
     * @return bool
     */
    public function belongsToTenant(string $tenantId): bool
    {
        return $this->tenant_id === $tenantId;
    }

    /**
     * Verifica se il modello appartiene al tenant corrente.
     *
     * @return bool
     */
    public function belongsToCurrentTenant(): bool
    {
        return $this->belongsToTenant($this->getTenantId());
    }

    /**
     * Boot del trait.
     *
     * @return void
     */
    public static function bootHasTenantNotifications(): void
    {
        static::creating(function (Model $model) {
            if (!isset($model->tenant_id)) {
                $model->tenant_id = $model->getTenantId();
            }
        });

        static::addGlobalScope('tenant', function (Builder $builder) {
            /** @var Model $model */
            $model = $builder->getModel();
            $builder->where($model->getTable() . '.tenant_id', $model->getTenantId());
        });
    }
<<<<<<< HEAD
}
=======
} 
>>>>>>> b19cd40 (.)
