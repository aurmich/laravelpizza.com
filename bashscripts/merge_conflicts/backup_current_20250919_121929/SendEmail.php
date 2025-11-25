<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Clusters\Test\Pages;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Exception;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Modules\Notify\Datas\EmailData;
use Modules\Notify\Emails\EmailDataEmail;
use Modules\Notify\Filament\Clusters\Test;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;

/**
 * @property \Filament\Schemas\Schema $emailForm
 */
class SendEmail extends Page implements HasForms
{
    use InteractsWithForms;

    // use NavigationLabelTrait;

<<<<<<< HEAD
    public null|array $emailData = [];
=======
    public ?array $emailData = [];
>>>>>>> b19cd40 (.)

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-paper-airplane';

    protected string $view = 'notify::filament.pages.send-email';

<<<<<<< HEAD
    protected static null|string $cluster = Test::class;
=======
    protected static ?string $cluster = Test::class;
>>>>>>> b19cd40 (.)

    public function mount(): void
    {
        $this->fillForms();
    }

    public function emailForm(Schema $schema): Schema
    {
        return $schema
<<<<<<< HEAD
            ->components([
                Section::make()
                    // ->description('Update your account\'s profile information and email address.')
                    ->schema([
                        TextInput::make('to')
                            // ->unique(ignoreRecord: true)
                            ->email()
                            ->required(),
                        TextInput::make('subject')->required(),
                        RichEditor::make('body_html')->required(),
                    ]),
            ])
=======
            ->components(
                [
                    Section::make()
                        // ->description('Update your account\'s profile information and email address.')
                        ->schema(
                            [
                                TextInput::make('to')
                                    // ->unique(ignoreRecord: true)
                                    ->email()
                                    ->required(),
                                TextInput::make('subject')
                                    ->required(),
                                RichEditor::make('body_html')
                                    ->required(),
                            ]
                        ),
                ]
            )
>>>>>>> b19cd40 (.)
            ->model($this->getUser())
            ->statePath('emailData');
    }

    public function sendEmail(): void
    {
        $data = $this->emailForm->getState();
        $email_data = EmailData::from($data);
        // $from_address = config('mail.from.address');

<<<<<<< HEAD
        Mail::to($data['to'])->send(new EmailDataEmail($email_data));
=======
        Mail::to($data['to'])
            ->send(
                new EmailDataEmail($email_data)
            );
>>>>>>> b19cd40 (.)

        Notification::make()
            ->success()
            // ->title(__('filament-panels::pages/auth/edit-profile.notifications.saved.title'))
            ->title(__('check your email client'))
            ->send();
    }

    protected function getForms(): array
    {
        return [
            'emailForm',
        ];
    }

    protected function getEmailFormActions(): array
    {
        return [
<<<<<<< HEAD
            Action::make('emailFormActions')->submit('emailFormActions'),
=======
            Action::make('emailFormActions')

                ->submit('emailFormActions'),
>>>>>>> b19cd40 (.)
        ];
    }

    protected function getUser(): Authenticatable&Model
    {
        $user = Filament::auth()->user();

<<<<<<< HEAD
        if (!($user instanceof Model)) {
            throw new Exception(
                'The authenticated user object must be an Eloquent model to allow the profile page to update it.',
            );
=======
        if (! $user instanceof Model) {
            throw new Exception('The authenticated user object must be an Eloquent model to allow the profile page to update it.');
>>>>>>> b19cd40 (.)
        }

        return $user;
    }

    protected function fillForms(): void
    {
        // $data = $this->getUser()->attributesToArray();

        // $this->editProfileForm->fill($data);
        $this->emailForm->fill();
    }
}
