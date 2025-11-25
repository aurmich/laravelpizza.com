<?php

declare(strict_types=1);

/**
 * @see HusamTariq\FilamentDatabaseSchedule
 */

namespace Modules\Job\Rules;

use Closure;
use Cron\CronExpression;
use Illuminate\Contracts\Validation\ValidationRule;

class Corn implements ValidationRule
{
    /**
     * Run the validation rule.
     */
<<<<<<< HEAD
    public function validate(string $_attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value)) {
            $msg = 'value is not a string [' . __LINE__ . '][' . class_basename($this) . ']';
=======
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value)) {
            $msg = 'value is not a string ['.__LINE__.']['.class_basename($this).']';
>>>>>>> e1b0bf9 (.)
            $fail($msg);

            return;
        }
<<<<<<< HEAD
        if (!CronExpression::isValidExpression($value)) {
            $msg = trans('job::schedule.validation.cron');
            if (!is_string($msg)) {
                $msg = 'WIP [' . __LINE__ . '][' . class_basename($this) . ']';
=======
        if (! CronExpression::isValidExpression($value)) {
            $msg = trans('job::schedule.validation.cron');
            if (! is_string($msg)) {
                $msg = 'WIP ['.__LINE__.']['.class_basename($this).']';
>>>>>>> e1b0bf9 (.)
            }
            $fail($msg);
        }
    }
}
