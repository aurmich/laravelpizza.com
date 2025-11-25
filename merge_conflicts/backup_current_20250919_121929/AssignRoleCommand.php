<?php

declare(strict_types=1);

namespace Modules\User\Console\Commands;

use Illuminate\Console\Command;
use Modules\User\Models\Role;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;
use Symfony\Component\Console\Input\InputOption;

use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\text;

class AssignRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'user:assign-role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a module to user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
<<<<<<< HEAD
    
=======
    public function __construct()
    {
        parent::__construct();
    }
>>>>>>> fbc8f8e (.)

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $email = text('email ?');
        $user_class = XotData::make()->getUserClass();
        /** @var UserContract */
        $user = XotData::make()->getUserByEmail($email);
        /**
         * @var array<string, string>
         */
<<<<<<< HEAD
        $opts = Role::all()->pluck('name', 'name')->toArray();
=======
        $opts = Role::all()
            ->pluck('name', 'name')
            ->toArray();
>>>>>>> fbc8f8e (.)

        $rows = multiselect(
            label: 'What roles',
            options: $opts,
            required: true,
            scroll: 10,
<<<<<<< HEAD
        // validate: function (array $values) {
        //  return ! \in_array(\count($values), [1, 2], false)
        //    ? 'A maximum of two'
        //  : null;
        // }
=======
            // validate: function (array $values) {
            //  return ! \in_array(\count($values), [1, 2], false)
            //    ? 'A maximum of two'
            //  : null;
            // }
>>>>>>> fbc8f8e (.)
        );

        foreach ($rows as $row) {
            $role = Role::firstOrCreate(['name' => $row]);
            $user->assignRole($role);
        }

<<<<<<< HEAD
        $this->info(implode(', ', $rows) . ' assigned to ' . $email);
=======
        $this->info(implode(', ', $rows).' assigned to '.$email);
>>>>>>> fbc8f8e (.)
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
