<?php

/**
 * @see https://medium.com/modulr/send-telegram-notifications-with-laravel-9-342cc87b406
 * @see https://laravel-notification-channels.com/telegram/#usage
 */

declare(strict_types=1);

namespace Modules\Notify\Filament\Clusters\Test\Pages;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Exception;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
<<<<<<< HEAD
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Modules\Notify\Datas\TelegramData;
use Modules\Notify\Datas\TelegramMessageData;
use Modules\Notify\Filament\Clusters\Test;
use Modules\Notify\Notifications\TelegramNotification;
use Modules\Xot\Filament\Pages\XotBasePage;
=======
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Modules\Notify\Filament\Clusters\Test;
use Modules\Notify\Notifications\TelegramNotification;
>>>>>>> b19cd40 (.)
use Modules\Xot\Filament\Traits\NavigationLabelTrait;
use NotificationChannels\Telegram\TelegramMessage;
use Telegram\Bot\Laravel\Facades\Telegram;
use Webmozart\Assert\Assert;
<<<<<<< HEAD
=======
use Modules\Notify\Datas\TelegramMessageData;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification as FilamentNotification;
use Modules\Xot\Filament\Pages\XotBasePage;
use Modules\Notify\Datas\TelegramData;
>>>>>>> b19cd40 (.)

/**
 * @property \Filament\Schemas\Schema $telegramForm
 */
class SendTelegramPage extends XotBasePage implements HasForms
{
    use InteractsWithForms;

    // use NavigationLabelTrait;

<<<<<<< HEAD
    public null|array $telegramData = [];
=======
    public ?array $telegramData = [];
>>>>>>> b19cd40 (.)

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-paper-airplane';

    protected string $view = 'notify::filament.pages.send-telegram';

<<<<<<< HEAD
    protected static null|string $cluster = Test::class;
=======
    protected static ?string $cluster = Test::class;
>>>>>>> b19cd40 (.)

    public function mount(): void
    {
        $this->fillForms();
    }

    public function telegramForm(Schema $schema): Schema
    {
<<<<<<< HEAD
        return $schema->components($this->getTelegramFormSchema())->model($this->getUser())->statePath('telegramData');
=======
        return $schema
            ->components($this->getTelegramFormSchema())
            ->model($this->getUser())
            ->statePath('telegramData');
>>>>>>> b19cd40 (.)
    }

    public function getTelegramFormSchema(): array
    {
        return [
<<<<<<< HEAD
            TextInput::make('chat_id')->required()->helperText('ID della chat o username del canale'),
=======
            TextInput::make('chat_id')
                ->required()
                ->helperText('ID della chat o username del canale'),
>>>>>>> b19cd40 (.)
            TextInput::make('text')
                ->required()
                ->maxLength(4096)
                ->helperText('Il messaggio non può superare i 4096 caratteri'),
            Select::make('driver')
                ->options([
                    'bot' => 'Bot API',
                    'webhook' => 'Webhook',
                ])
                ->default('bot')
                ->required(),
            Select::make('parse_mode')
                ->options([
                    'HTML' => 'HTML',
                    'Markdown' => 'Markdown',
                    'MarkdownV2' => 'MarkdownV2',
                ])
                ->helperText('Formato del testo (opzionale)'),
<<<<<<< HEAD
            Toggle::make('disable_web_page_preview')->helperText('Disabilita l\'anteprima dei link'),
            Toggle::make('disable_notification')->helperText('Invia il messaggio silenziosamente'),
            TextInput::make('reply_to_message_id')
                ->numeric()
                ->helperText('ID del messaggio a cui rispondere'),
            TextInput::make('media_url')->url()->helperText('URL del media (opzionale)'),
=======
            Toggle::make('disable_web_page_preview')
                ->helperText('Disabilita l\'anteprima dei link'),
            Toggle::make('disable_notification')
                ->helperText('Invia il messaggio silenziosamente'),
            TextInput::make('reply_to_message_id')
                ->numeric()
                ->helperText('ID del messaggio a cui rispondere'),
            TextInput::make('media_url')
                ->url()
                ->helperText('URL del media (opzionale)'),
>>>>>>> b19cd40 (.)
            Select::make('media_type')
                ->options([
                    'photo' => 'Foto',
                    'video' => 'Video',
                    'document' => 'Documento',
                    'audio' => 'Audio',
                ])
                ->helperText('Tipo di media (opzionale)'),
<<<<<<< HEAD
            TextInput::make('caption')->helperText('Didascalia per il media (opzionale)'),
=======
            TextInput::make('caption')
                ->helperText('Didascalia per il media (opzionale)'),
>>>>>>> b19cd40 (.)
        ];
    }

    public function sendTelegram(): void
    {
        try {
            $data = $this->telegramForm->getState();
            $user = $this->getUser();

            $message = is_string($data['text']) ? $data['text'] : '';

<<<<<<< HEAD
            Notification::route('telegram', $data['chat_id'])->notify(
                new TelegramNotification($message, [
=======
            Notification::route('telegram', $data['chat_id'])
                ->notify(new TelegramNotification($message, [
>>>>>>> b19cd40 (.)
                    'driver' => $data['driver'],
                    'parse_mode' => $data['parse_mode'] ?? null,
                    'disable_web_page_preview' => $data['disable_web_page_preview'] ?? false,
                    'disable_notification' => $data['disable_notification'] ?? false,
                    'reply_to_message_id' => $data['reply_to_message_id'] ?? null,
                    'media_url' => $data['media_url'] ?? null,
                    'media_type' => $data['media_type'] ?? null,
                    'caption' => $data['caption'] ?? null,
<<<<<<< HEAD
                ]),
            );
=======
                ]));
>>>>>>> b19cd40 (.)

            FilamentNotification::make()
                ->success()
                ->title('Messaggio Telegram inviato con successo')
                ->send();
<<<<<<< HEAD
=======

>>>>>>> b19cd40 (.)
        } catch (Exception $e) {
            Log::error('Errore nell\'invio Telegram: ' . $e->getMessage());

            FilamentNotification::make()
                ->danger()
                ->title('Errore nell\'invio Telegram')
                ->body($e->getMessage())
                ->send();
        }
    }

    protected function getForms(): array
    {
        return [
            'telegramForm',
        ];
    }

    protected function getTelegramFormActions(): array
    {
        return [
<<<<<<< HEAD
            Action::make('telegramFormActions')->submit('telegramFormActions'),
=======
            Action::make('telegramFormActions')
                ->submit('telegramFormActions'),
>>>>>>> b19cd40 (.)
        ];
    }

    protected function fillForms(): void
    {
        // $data = $this->getUser()->attributesToArray();

        // $this->editProfileForm->fill($data);
        $this->telegramForm->fill();
    }
}
