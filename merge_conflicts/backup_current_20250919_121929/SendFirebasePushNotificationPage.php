<?php

declare(strict_types=1);

namespace Modules\Notify\Filament\Clusters\Test\Pages;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\KeyValue;
use Exception;
<<<<<<< HEAD
use Override;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Modules\Notify\Datas\FirebaseNotificationData;
use Modules\Notify\Filament\Clusters\Test;
use Modules\Notify\Notifications\PushNotification;
use Modules\Xot\Filament\Pages\XotBasePage;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;
=======
use Filament\Forms;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Database\Eloquent\Model;
use Modules\Notify\Filament\Clusters\Test;
use Modules\Xot\Filament\Pages\XotBasePage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Filament\Forms\Concerns\InteractsWithForms;
use Modules\Notify\Datas\FirebaseNotificationData;
use Modules\Notify\Notifications\PushNotification;
use Modules\Xot\Filament\Traits\NavigationLabelTrait;
use Filament\Notifications\Notification as FilamentNotification;
>>>>>>> b19cd40 (.)

/**
 * @property \Filament\Schemas\Schema $pushForm
 */
class SendFirebasePushNotificationPage extends XotBasePage
{
<<<<<<< HEAD
    public null|array $pushData = [];

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-bell-alert';

    protected string $view = 'notify::filament.pages.send-push';

    protected static null|string $cluster = Test::class;

=======
    
    public ?array $pushData = [];
    
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-bell-alert';
    
    protected string $view = 'notify::filament.pages.send-push';
    
    protected static ?string $cluster = Test::class;
    
>>>>>>> b19cd40 (.)
    public function mount(): void
    {
        $this->fillForms();
    }

    protected function getForms(): array
    {
        return [
            'pushForm',
        ];
    }

    protected function fillForms(): void
    {
        $this->pushForm->fill();
    }

    public function pushForm(Schema $schema): Schema
    {
<<<<<<< HEAD
        return $schema->components($this->getPushFormSchema())->model($this->getUser())->statePath('pushData');
=======
        return $schema
            ->components($this->getPushFormSchema())
            ->model($this->getUser())
            ->statePath('pushData');
>>>>>>> b19cd40 (.)
    }

    public function getPushFormSchema(): array
    {
        return [
            TextInput::make('token')
                ->label(__('notify::push.form.token.label'))
                ->required()
                ->helperText(__('notify::push.form.token.helper')),
            TextInput::make('title')
                ->label(__('notify::push.form.title.label'))
                ->required()
                ->maxLength(100),
            Textarea::make('body')
                ->label(__('notify::push.form.body.label'))
                ->required()
                ->rows(3),
            TextInput::make('image_url')
                ->label(__('notify::push.form.image_url.label'))
                ->url()
                ->helperText(__('notify::push.form.image_url.helper')),
            Select::make('notification_type')
                ->label(__('notify::push.form.notification_type.label'))
                ->options([
                    'message' => 'Message',
                    'alert' => 'Alert',
                    'reminder' => 'Reminder',
                    'update' => 'Update',
                ])
                ->default('message')
                ->required(),
            Toggle::make('high_priority')
                ->label(__('notify::push.form.high_priority.label'))
                ->default(false)
                ->helperText(__('notify::push.form.high_priority.helper')),
            KeyValue::make('custom_data')
                ->label(__('notify::push.form.custom_data.label'))
                ->keyLabel(__('notify::push.form.custom_data.key_label'))
                ->valueLabel(__('notify::push.form.custom_data.value_label'))
                ->helperText(__('notify::push.form.custom_data.helper')),
        ];
    }

    public function sendPushNotification(): void
    {
        $data = $this->pushForm->getState();
<<<<<<< HEAD

=======
        
>>>>>>> b19cd40 (.)
        try {
            // Creare i dati della notifica Firebase
            $notificationData = FirebaseNotificationData::from([
                'type' => $data['notification_type'] ?? 'message',
                'title' => $data['title'] ?? '',
                'body' => $data['body'] ?? '',
                'data' => $data['custom_data'] ?? [],
            ]);
<<<<<<< HEAD

=======
            
>>>>>>> b19cd40 (.)
            // TODO: Implementare PushNotification class
            // Inviare la notifica push
            // Notification::route('firebase', $data['token'])
            //     ->notify(new PushNotification($notificationData));
<<<<<<< HEAD

=======
            
>>>>>>> b19cd40 (.)
            // Notificare il successo
            FilamentNotification::make()
                ->success()
                ->title(__('notify::push.notifications.sent.title'))
                ->body(__('notify::push.notifications.sent.body'))
                ->send();
<<<<<<< HEAD

=======
                
>>>>>>> b19cd40 (.)
            // Loggare l'invio
            Log::info('Notifica push inviata con successo', [
                'token' => $data['token'],
                'title' => $data['title'],
                'type' => $data['notification_type'],
            ]);
        } catch (Exception $e) {
            // Loggare l'errore
            Log::error('Errore durante l\'invio della notifica push', [
                'error' => $e->getMessage(),
                'token' => $data['token'],
            ]);
<<<<<<< HEAD

=======
            
>>>>>>> b19cd40 (.)
            // Notificare l'errore
            FilamentNotification::make()
                ->danger()
                ->title(__('notify::push.notifications.error.title'))
                ->body($e->getMessage())
                ->send();
        }
    }

    protected function getPushFormActions(): array
    {
        return [
            Action::make('sendPushNotification')
                ->label(__('notify::push.actions.send'))
                ->submit('sendPushNotification'),
        ];
    }

<<<<<<< HEAD
    #[Override]
=======
>>>>>>> b19cd40 (.)
    protected function getUser(): Authenticatable&Model
    {
        $user = Filament::auth()->user();

<<<<<<< HEAD
        if (!($user instanceof Model)) {
            throw new Exception(
                'L\'utente autenticato deve essere un modello Eloquent per consentire l\'aggiornamento del profilo.',
            );
=======
        if (! $user instanceof Model) {
            throw new Exception('L\'utente autenticato deve essere un modello Eloquent per consentire l\'aggiornamento del profilo.');
>>>>>>> b19cd40 (.)
        }

        return $user;
    }
}
