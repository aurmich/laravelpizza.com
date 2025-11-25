<?php

declare(strict_types=1);

namespace Modules\User\Console\Commands;

use Modules\Xot\Actions\Cast\SafeObjectCastAction;
use Illuminate\Console\Command;
<<<<<<< HEAD
use Illuminate\Support\Arr;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;
use Symfony\Component\Console\Input\InputOption;
use Webmozart\Assert\Assert;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;
=======
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Input\InputOption;
use Webmozart\Assert\Assert;

use function Laravel\Prompts\text;
use function Laravel\Prompts\select;
>>>>>>> fbc8f8e (.)

/**
 * Command to change user type based on project configuration.
 *
 * This command allows administrators to change the type of a user
 * by selecting from available child types in the system.
 */
class ChangeTypeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'user:change-type';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change user type based on project configuration';

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
     *
     * @return void
     */
    public function handle(): void
    {
        $xot = XotData::make();
        $email = text('User email?');
<<<<<<< HEAD

=======
        
>>>>>>> fbc8f8e (.)
        /** @var UserContract $user */
        $user = XotData::make()->getUserByEmail($email);

        if (!$user) {
            $this->error("User with email '{$email}' not found.");
            return;
        }
        if (!method_exists($user, 'getChildTypes')) {
            $this->error('User model does not have childTypes method.');
            return;
        }

        $childTypes = $xot->getUserChildTypes();
        /** @phpstan-ignore nullsafe.neverNull */
<<<<<<< HEAD
        $typeLabel = $user->type?->getLabel() ?? 'None';
        $typeLabelString = is_string($typeLabel) ? $typeLabel : $typeLabel->toHtml();
        $this->info("Current user type: " . $typeLabelString);

=======
        $this->info("Current user type: {$user->type?->getLabel()}");
        
>>>>>>> fbc8f8e (.)
        $typeClass = $xot->getUserChildTypeClass();
        /** @var array<string, string> */
        $options = [];
        foreach ($childTypes as $key => $item) {
<<<<<<< HEAD
            if (
                is_object($item) &&
                    method_exists($item, 'getLabel') &&
                    app(SafeObjectCastAction::class)->hasNonNullProperty($item, 'value')
            ) {
                $value = app(SafeObjectCastAction::class)
                    ->getStringProperty($item, 'value', '');
                $options[$value] = (string) $item->getLabel();
            } else {
                $options[(string) $key] = 'Unknown';
=======
            if (is_object($item) && method_exists($item, 'getLabel') && app(SafeObjectCastAction::class)->hasNonNullProperty($item, 'value')) {
                $value = app(SafeObjectCastAction::class)->getStringProperty($item, 'value', '');
                $options[$value] = (string)$item->getLabel();
            } else {
                $options[(string)$key] = 'Unknown';
>>>>>>> fbc8f8e (.)
            }
        }

        $newType = select('Select new user type:', $options);
<<<<<<< HEAD

        $newTypeEnum = $typeClass::tryFrom($newType);
        Assert::notNull($newTypeEnum);

        $user->type = $newTypeEnum;
        $user->save();

=======
        
        $newTypeEnum = $typeClass::tryFrom($newType);
        Assert::notNull($newTypeEnum);

        
        $user->type = $newTypeEnum;
        $user->save();
        
>>>>>>> fbc8f8e (.)
        $this->info("User type changed to '{$newTypeEnum->getLabel()}' for {$email}");
    }
}
