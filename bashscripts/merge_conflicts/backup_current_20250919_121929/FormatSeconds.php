<?php

declare(strict_types=1);

/**
 * ---.
 */

namespace Modules\Job\Traits;

trait FormatSeconds
{
    public function formatSeconds(int $seconds): string
    {
        $days = floor($seconds / (60 * 60 * 24));
<<<<<<< HEAD
        $seconds -= $days * 60 * 60 * 24;

        $hours = floor($seconds / (60 * 60));
        $seconds -= $hours * 60 * 60;
=======
        $seconds -= $days * (60 * 60 * 24);

        $hours = floor($seconds / (60 * 60));
        $seconds -= $hours * (60 * 60);
>>>>>>> e1b0bf9 (.)

        $minutes = floor($seconds / 60);
        $seconds -= $minutes * 60;

        $formattedSeconds = '';

        if ($days > 0) {
<<<<<<< HEAD
            $formattedSeconds .= "{$days} d ";
        }

        if ($hours > 0 || $days > 0) {
            $formattedSeconds .= "{$hours} h ";
        }

        if ($minutes > 0 || $hours > 0 || $days > 0) {
            $formattedSeconds .= "{$minutes} m ";
        }

        if ($days < 1 && ($seconds > 0 || $minutes > 0 || $hours > 0)) {
            $formattedSeconds .= "{$seconds} s";
=======
            $formattedSeconds .= "$days d ";
        }

        if ($hours > 0 || $days > 0) {
            $formattedSeconds .= "$hours h ";
        }

        if ($minutes > 0 || $hours > 0 || $days > 0) {
            $formattedSeconds .= "$minutes m ";
        }

        if ($days < 1 && ($seconds > 0 || $minutes > 0 || $hours > 0)) {
            $formattedSeconds .= "$seconds s";
>>>>>>> e1b0bf9 (.)
        }

        return $formattedSeconds;
    }
}
