<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Clusters\Test\Pages;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
<<<<<<< HEAD
use Override;
use Exception;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Modules\Notify\Datas\EmailData;
use Modules\Notify\Emails\EmailDataEmail;
use Modules\Notify\Emails\SpatieEmail;
use Modules\Notify\Filament\Clusters\Test;
use Modules\Notify\Models\MailTemplate;
use Modules\Notify\Notifications\RecordNotification;
use Modules\Xot\Filament\Pages\XotBasePage;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;
use Webmozart\Assert\Assert;
=======
use Exception;
use Filament\Forms;
use Filament\Actions\Action;
use Webmozart\Assert\Assert;
use Filament\Facades\Filament;
use Modules\Notify\Datas\EmailData;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Contracts\HasForms;
use Modules\Notify\Emails\SpatieEmail;
use Illuminate\Database\Eloquent\Model;
use Modules\Notify\Models\MailTemplate;
use Modules\Notify\Emails\EmailDataEmail;
use Modules\Notify\Filament\Clusters\Test;
use Modules\Xot\Filament\Pages\XotBasePage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Filament\Forms\Concerns\InteractsWithForms;
use Modules\Notify\Notifications\RecordNotification;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;
use Filament\Notifications\Notification as FilamentNotification;
>>>>>>> b19cd40 (.)

/**
 * @property \Filament\Schemas\Schema $emailForm
 */
class SendSpatieEmailPage extends XotBasePage
{
<<<<<<< HEAD
    public null|array $emailData = [];
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-paper-airplane';
    protected string $view = 'notify::filament.pages.send-email';
    protected static null|string $cluster = Test::class;
=======
    public ?array $emailData = [];
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-paper-airplane';
    protected string $view = 'notify::filament.pages.send-email';
    protected static ?string $cluster = Test::class;
>>>>>>> b19cd40 (.)

    public function mount(): void
    {
        $this->fillForms();
    }

    protected function getForms(): array
    {
        return [
            'emailForm',
        ];
    }

    protected function fillForms(): void
    {
        // $data = $this->getUser()->attributesToArray();

        // $this->editProfileForm->fill($data);
        $this->emailForm->fill();
    }

<<<<<<< HEAD
    public function emailForm(Schema $schema): Schema
    {
        return $schema->components($this->getEmailFormSchema())->model($this->getUser())->statePath('emailData');
=======


    public function emailForm(Schema $schema): Schema
    {
        return $schema
            ->components($this->getEmailFormSchema())
            ->model($this->getUser())
            ->statePath('emailData');
>>>>>>> b19cd40 (.)
    }

    public function getEmailFormSchema(): array
    {
        return [
<<<<<<< HEAD
            TextInput::make('to')->email()->required(),
            /*
             * Forms\Components\TextInput::make('subject')
             * ->required(),
             */
            Select::make('mail_template_slug')
                ->options(MailTemplate::all()->pluck('slug', 'slug'))
                ->required(),
            RichEditor::make('body_html')->required(),
=======
            TextInput::make('to')
                ->email()
                ->required(),
            /*
            Forms\Components\TextInput::make('subject')
                ->required(),
            */
            Select::make('mail_template_slug')
                ->options(MailTemplate::all()->pluck('slug', 'slug'))
                ->required(),
            RichEditor::make('body_html')
                ->required(),
>>>>>>> b19cd40 (.)
        ];
    }

    public function sendEmail(): void
    {
<<<<<<< HEAD
        $data = $this->emailForm->getState();
        /*
         * $email_data = EmailData::from($data);
         *
         * Mail::to($data['to'])->send(
         * new EmailDataEmail($email_data)
         * );
         *
         *
         */
=======

        $data = $this->emailForm->getState();
        /*
        $email_data = EmailData::from($data);

        Mail::to($data['to'])->send(
            new EmailDataEmail($email_data)
        );


        */
>>>>>>> b19cd40 (.)
        $user = $this->getUser();
        $attachments = [
            [
                'path' => public_path('images/avatars/default-3.svg'),
                'as' => 'logo.png',
                'mime' => 'image/png',
            ],
            [
                'path' => public_path('images/avatars/default-3.svg'),
                'as' => 'logo.png',
                'mime' => 'image/png',
            ],
        ];
        //Mail::to($data['to'])->locale('it')->send((new SpatieEmail($user,'due'))->addAttachments($attachments));
        /*
<<<<<<< HEAD
         * // Create and send the email
         * $email = new SpatieEmail($user, 'uno');
         * $email->addAttachments($attachments);
         *
         * Mail::to($data['to'])
         * ->locale('it')
         * ->send($email);
         */
        Assert::string($mail_template_slug = $data['mail_template_slug'], __FILE__ . ':' . __LINE__ . ' - ' . class_basename(__CLASS__));
        $notify = new RecordNotification($user, $mail_template_slug);
        $notify->mergeData($data);
=======
         // Create and send the email
         $email = new SpatieEmail($user, 'uno');
         $email->addAttachments($attachments);

         Mail::to($data['to'])
             ->locale('it')
             ->send($email);
        */
        Assert::string($mail_template_slug=$data['mail_template_slug']);
        $notify=(new RecordNotification($user,$mail_template_slug))->mergeData($data);
>>>>>>> b19cd40 (.)

        Notification::route('mail', $data['to'])
            //->locale('it')
            ->notify($notify);

<<<<<<< HEAD
        FilamentNotification::make()
            ->success()
            // ->title(__('filament-panels::pages/auth/edit-profile.notifications.saved.title'))
            ->title(__('check your email client'))
            ->send();
    }

    protected function getEmailFormActions(): array
    {
        return [
            Action::make('emailFormActions')->submit('emailFormActions'),
        ];
    }

    #[Override]
=======

        FilamentNotification::make()
        ->success()
        // ->title(__('filament-panels::pages/auth/edit-profile.notifications.saved.title'))
        ->title(__('check your email client'))
        ->send();
    }



    protected function getEmailFormActions(): array
    {
        return [
            Action::make('emailFormActions')
                ->submit('emailFormActions'),
        ];
    }

>>>>>>> b19cd40 (.)
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
<<<<<<< HEAD
=======


>>>>>>> b19cd40 (.)
}
