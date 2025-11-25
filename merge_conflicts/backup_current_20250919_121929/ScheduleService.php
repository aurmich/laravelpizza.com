<?php

declare(strict_types=1);

namespace Modules\Job\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Job\Models\Schedule;
use Webmozart\Assert\Assert;

class ScheduleService
{
    /**
     * Undocumented variable.
     *
     * @var Schedule
     */
    private $model;

    public function __construct()
    {
<<<<<<< HEAD
        Assert::string($modelClass = config('job::model'), '[' . __LINE__ . '][' . class_basename($this) . ']');
=======
        Assert::string($modelClass = config('job::model'), '['.__LINE__.']['.class_basename($this).']');
>>>>>>> e1b0bf9 (.)
        $this->model = app($modelClass);
    }

    /**
     * Undocumented function.
     *
     * @return Collection
     */
    public function getActives()
    {
        if (config('job::cache.enabled')) {
            return $this->getFromCache();
        }

        return $this->model->active()->get();
    }

    public function clearCache(): void
    {
<<<<<<< HEAD
        Assert::string($store = config('job::cache.store'), '[' . __LINE__ . '][' . class_basename($this) . ']');
        Assert::string($key = config('job::cache.key'), '[' . __LINE__ . '][' . class_basename($this) . ']');
=======
        Assert::string($store = config('job::cache.store'), '['.__LINE__.']['.class_basename($this).']');
        Assert::string($key = config('job::cache.key'), '['.__LINE__.']['.class_basename($this).']');
>>>>>>> e1b0bf9 (.)

        Cache::store($store)->forget($key);
    }

    /**
     * Undocumented function.
     *
     * @return Collection
     */
    private function getFromCache()
    {
<<<<<<< HEAD
        Assert::string($store = config('job::cache.store'), '[' . __LINE__ . '][' . class_basename($this) . ']');
        Assert::string($key = config('job::cache.key'), '[' . __LINE__ . '][' . class_basename($this) . ']');

        return Cache::store($store)->rememberForever($key, $this->model->active()->get(...));
=======
        Assert::string($store = config('job::cache.store'), '['.__LINE__.']['.class_basename($this).']');
        Assert::string($key = config('job::cache.key'), '['.__LINE__.']['.class_basename($this).']');

        return Cache::store($store)->rememberForever($key, fn () => $this->model->active()->get());
>>>>>>> e1b0bf9 (.)
    }
}
