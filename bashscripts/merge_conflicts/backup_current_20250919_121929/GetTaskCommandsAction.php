<?php

declare(strict_types=1);

namespace Modules\Job\Actions;

<<<<<<< HEAD
=======
use Webmozart\Assert\Assert;
>>>>>>> e1b0bf9 (.)
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Spatie\QueueableAction\QueueableAction;
use Symfony\Component\Console\Command\Command;
<<<<<<< HEAD
use Webmozart\Assert\Assert;
=======
>>>>>>> e1b0bf9 (.)

class GetTaskCommandsAction
{
    use QueueableAction;

    public function execute(): Collection
    {
        $all_commands = collect(Artisan::all());

        /*
<<<<<<< HEAD
         * $command_filter = config('totem.artisan.command_filter');
         * $whitelist = config('totem.artisan.whitelist', true);
         *
         * if (! empty($command_filter)) {
         * // $all_commands = $all_commands->filter(function (Command $command) use ($command_filter, $whitelist) {
         * $all_commands = $all_commands->filter(function ($command) use ($command_filter, $whitelist) {
         * foreach ($command_filter as $filter) {
         * if (fnmatch($filter, $command->getName())) {
         * return $whitelist;
         * }
         * }
         *
         * return ! $whitelist;
         * });
         * }
         */
        return $all_commands->sortBy(static function (Command $command): string {
            $name = $command->getName();
            Assert::string($name, __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
            if (mb_strpos($name, ':') === false) {
                return ':' . $name;
            }

            return $name;
        });
=======
        $command_filter = config('totem.artisan.command_filter');
        $whitelist = config('totem.artisan.whitelist', true);

        if (! empty($command_filter)) {
            // $all_commands = $all_commands->filter(function (Command $command) use ($command_filter, $whitelist) {
            $all_commands = $all_commands->filter(function ($command) use ($command_filter, $whitelist) {
                foreach ($command_filter as $filter) {
                    if (fnmatch($filter, $command->getName())) {
                        return $whitelist;
                    }
                }

                return ! $whitelist;
            });
        }
        */
        return $all_commands->sortBy(
            static function (Command $command): string {
                $name = $command->getName();
                Assert::string($name);
                if (mb_strpos($name, ':') === false) {
                    return ':'.$name;
                }

                return $name;
            }
        );
>>>>>>> e1b0bf9 (.)
    }
}
