<?php

declare(strict_types=1);

namespace Modules\User\Filament\Pages\Tenancy;

use Filament\Schemas\Schema;
<<<<<<< HEAD
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant as BaseRegisterTenant;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\User\Contracts\TenantContract;
use Modules\Xot\Datas\XotData;
use Modules\Xot\Filament\Traits\TransTrait;
use Webmozart\Assert\Assert;
=======
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;
use Modules\Xot\Datas\XotData;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Modules\User\Contracts\TenantContract;
use Modules\Xot\Filament\Traits\TransTrait;
use Filament\Pages\Tenancy\RegisterTenant as BaseRegisterTenant;
>>>>>>> fbc8f8e (.)

class RegisterTenant extends BaseRegisterTenant
{
    use TransTrait;

    public string $resource;

    public static function getLabel(): string
    {
        $tenantClass = XotData::make()->getTenantClass();
<<<<<<< HEAD
        $func = Str::of(__FUNCTION__)->snake()->toString();
        if (Str::startsWith($func, 'get_')) {
            $func = Str::of($func)->after('get_')->toString();
        }
        $key = Str::of(class_basename(__CLASS__))
            ->snake()
            ->prepend('actions.')
            ->append('.' . $func)
            ->toString();
        $str = static::transClass($tenantClass, $key);
=======
        $func=Str::of(__FUNCTION__)->snake()->toString();
        if(Str::startsWith($func,'get_')){
            $func=Str::of($func)->after('get_')->toString();
        }
        $key=Str::of(class_basename(__CLASS__))->snake()->prepend('actions.')->append('.'.$func)->toString();
        $str= static::transClass($tenantClass,$key);
>>>>>>> fbc8f8e (.)

        return $str;
    }

<<<<<<< HEAD
    public function form(Schema $schema): Schema
    {
        $tenantClass = XotData::make()->getTenantClass();
        $resource = Str::of($tenantClass)
            ->replace('\Models\\', '\Filament\Resources\\')
            ->append('Resource')
            ->toString();
        $this->resource = $resource;
        return $schema->components($this->getFormSchema());
=======


    public function form(Schema $schema): Schema
    {
        $tenantClass = XotData::make()->getTenantClass();
        $resource=Str::of($tenantClass)
            ->replace('\Models\\','\Filament\Resources\\')
            ->append('Resource')
            ->toString();
        $this->resource=$resource;
        return $schema
            ->components($this->getFormSchema());
>>>>>>> fbc8f8e (.)
    }

    public function getFormSchema(): array
    {
        return $this->resource::getFormSchema();
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function handleRegistration(array $data): Model
    {
        $tenantClass = XotData::make()->getTenantClass();

        $tenant = $tenantClass::create($data);
        Assert::implementsInterface($tenant, TenantContract::class);

<<<<<<< HEAD
        $tenant->users()->attach(auth()->user());
=======
        $tenant->users()
            ->attach(auth()->user());
>>>>>>> fbc8f8e (.)

        return $tenant;
    }
}
