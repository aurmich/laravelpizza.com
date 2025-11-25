<?php

/**
 * @see https://coderflex.com/blog/create-advanced-filters-with-filament
 */

declare(strict_types=1);

namespace Modules\Xot\Filament\Actions\Header;

// Header actions must be an instance of Filament\Actions\Action, or Filament\Actions\ActionGroup.
// use Filament\Tables\Actions\Action;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Actions\String\SanitizeAction;
use Webmozart\Assert\Assert;

class SanitizeFieldsHeaderAction extends Action
{
    public array $fields = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->translateLabel()
<<<<<<< HEAD
=======
            
>>>>>>> f1d4085 (.)
            ->tooltip('sanitize')
            ->icon('heroicon-o-shield-exclamation')
            ->action(function (ListRecords $livewire) {
                $resource = $livewire->getResource();
                $modelClass = $resource::getModel();
                // @phpstan-ignore staticMethod.nonObject
                $rows = $modelClass::get();
<<<<<<< HEAD
                if (!is_iterable($rows)) {
=======
                if (! is_iterable($rows)) {
>>>>>>> f1d4085 (.)
                    $rows = [];
                }
                $c = 0;
                foreach ($rows as $row) {
                    Assert::isInstanceOf($row, Model::class);
                    $save = false;
                    foreach ($this->fields as $field) {
<<<<<<< HEAD
                        Assert::string($item = $row->{$field}, __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
                        $string = app(SanitizeAction::class)->execute($item);
                        if ($string !== $item) {
=======
                        Assert::string($item = $row->{$field});
                        $string = app(SanitizeAction::class)->execute($item);
                        if ($string != $item) {
>>>>>>> f1d4085 (.)
                            $row->{$field} = $string;
                            $save = true;
                            ++$c;
                        }
                    }
                    if ($save) {
                        $row->save();
                    }
                }
                Notification::make()
<<<<<<< HEAD
                    ->title('' . $c . ' record sanitized')
=======
                    ->title(''.$c.' record sanitized')
>>>>>>> f1d4085 (.)
                    ->success()
                    ->send();
            });
    }

    public function setFields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

<<<<<<< HEAD
    public static function getDefaultName(): null|string
=======
    public static function getDefaultName(): ?string
>>>>>>> f1d4085 (.)
    {
        return 'sanitize-fields-header';
    }
}
