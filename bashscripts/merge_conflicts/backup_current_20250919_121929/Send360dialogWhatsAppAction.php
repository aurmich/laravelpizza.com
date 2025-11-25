<?php

declare(strict_types=1);

namespace Modules\Notify\Actions\WhatsApp;

use Modules\Xot\Actions\Cast\SafeIntCastAction;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
<<<<<<< HEAD
use Modules\Notify\Datas\WhatsAppData;
use Spatie\QueueableAction\QueueableAction;

=======

use Modules\Notify\Datas\WhatsAppData;
use Spatie\QueueableAction\QueueableAction;
>>>>>>> b19cd40 (.)
use function Safe\json_decode;

final class Send360dialogWhatsAppAction
{
    use QueueableAction;

    private string $apiKey;
    private string $baseUrl = 'https://waba.360dialog.io/v1';
    private array $vars = [];
    protected bool $debug;
    protected int $timeout;

    /**
     * Create a new action instance.
     */
    public function __construct()
    {
        $apiKey = config('services.360dialog.api_key');
        if (!is_string($apiKey)) {
<<<<<<< HEAD
            throw new Exception(
                'put [360DIALOG_API_KEY] variable to your .env and config [services.360dialog.api_key]',
            );
=======
            throw new Exception('put [360DIALOG_API_KEY] variable to your .env and config [services.360dialog.api_key]');
>>>>>>> b19cd40 (.)
        }
        $this->apiKey = $apiKey;

        // Parametri a livello di root
        $this->debug = (bool) config('whatsapp.debug', false);
<<<<<<< HEAD
        $this->timeout = app(SafeIntCastAction::class)
            ->execute(config('whatsapp.timeout'), 30);
=======
        $this->timeout = app(SafeIntCastAction::class)->execute(config('whatsapp.timeout'), 30);
>>>>>>> b19cd40 (.)
    }

    /**
     * Execute the action.
     *
     * @param WhatsAppData $whatsAppData I dati del messaggio WhatsApp
     * @return array Risultato dell'operazione
     * @throws Exception In caso di errore durante l'invio
     */
    public function execute(WhatsAppData $whatsAppData): array
    {
        // Log di debug se abilitato
        if ($this->debug) {
            Log::debug('Invio WhatsApp 360dialog', [
                'to' => $whatsAppData->to,
                'message_length' => strlen($whatsAppData->body),
                'type' => $whatsAppData->type,
            ]);
        }
<<<<<<< HEAD

=======
        
>>>>>>> b19cd40 (.)
        $client = new Client([
            'timeout' => $this->timeout,
            'headers' => [
                'D360-API-KEY' => $this->apiKey,
                'Content-Type' => 'application/json',
<<<<<<< HEAD
            ],
        ]);

        $endpoint = $this->baseUrl . '/messages';

        $payload = [
            'to' => $whatsAppData->to,
        ];

=======
            ]
        ]);
        
        $endpoint = $this->baseUrl . '/messages';
        
        $payload = [
            'to' => $whatsAppData->to,
        ];
        
>>>>>>> b19cd40 (.)
        // Gestione diversi tipi di messaggi
        if ($whatsAppData->type === 'text') {
            $payload['type'] = 'text';
            $payload['text'] = [
                'body' => $whatsAppData->body,
            ];
        } elseif ($whatsAppData->type === 'template' && !empty($whatsAppData->template)) {
            $payload['type'] = 'template';
            $payload['template'] = $whatsAppData->template;
        } elseif ($whatsAppData->type === 'media' && !empty($whatsAppData->media)) {
            $mediaUrl = $whatsAppData->media[0];
            $mediaType = $this->determineMediaType($mediaUrl);
<<<<<<< HEAD

=======
            
>>>>>>> b19cd40 (.)
            $payload['type'] = $mediaType;
            $payload[$mediaType] = [
                'link' => $mediaUrl,
                'caption' => $whatsAppData->body,
            ];
        }
<<<<<<< HEAD

        try {
            $response = $client->post($endpoint, [
                'json' => $payload,
            ]);

=======
        
        try {
            $response = $client->post($endpoint, [
                'json' => $payload
            ]);
            
>>>>>>> b19cd40 (.)
            $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
            /** @var array $responseData */
            $responseData = json_decode($responseContent, true);
<<<<<<< HEAD

=======
            
>>>>>>> b19cd40 (.)
            // Salva i dati della risposta nelle variabili dell'azione
            $this->vars['status_code'] = $statusCode;
            $this->vars['status_txt'] = $responseContent;
            $this->vars['response_data'] = $responseData;
<<<<<<< HEAD

=======
            
>>>>>>> b19cd40 (.)
            Log::info('WhatsApp 360dialog inviato con successo', [
                'to' => $whatsAppData->to,
                'response_code' => $statusCode,
            ]);
<<<<<<< HEAD

            return [
                'success' => $statusCode >= 200 && $statusCode < 300,
=======
            
            return [
                'success' => ($statusCode >= 200 && $statusCode < 300),
>>>>>>> b19cd40 (.)
                'message_id' => $responseData['messages'][0]['id'] ?? null,
                'response' => $responseData,
                'vars' => $this->vars,
            ];
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            /** @var array $responseBody */
            $responseBody = json_decode($response->getBody()->getContents(), true);
<<<<<<< HEAD

=======
            
>>>>>>> b19cd40 (.)
            // Salva i dati dell'errore nelle variabili dell'azione
            $this->vars['error_code'] = $statusCode;
            $this->vars['error_message'] = $e->getMessage();
            $this->vars['error_response'] = $responseBody;
<<<<<<< HEAD

=======
            
>>>>>>> b19cd40 (.)
            Log::warning('Errore invio WhatsApp 360dialog', [
                'to' => $whatsAppData->to,
                'status' => $statusCode,
                'response' => $responseBody,
            ]);
<<<<<<< HEAD

=======
            
>>>>>>> b19cd40 (.)
            return [
                'success' => false,
                'error' => $responseBody['errors'][0]['message'] ?? 'Errore sconosciuto',
                'status_code' => $statusCode,
                'vars' => $this->vars,
            ];
        }
    }
<<<<<<< HEAD

=======
    
>>>>>>> b19cd40 (.)
    /**
     * Determina il tipo di media basato sull'URL o sull'estensione del file.
     *
     * @param string $url URL del media
     * @return string Tipo di media (image, video, audio, document)
     */
    private function determineMediaType(string $url): string
    {
        $extension = strtolower(pathinfo($url, PATHINFO_EXTENSION));
<<<<<<< HEAD

        return match ($extension) {
=======
        
        return match($extension) {
>>>>>>> b19cd40 (.)
            'jpg', 'jpeg', 'png', 'gif', 'webp' => 'image',
            'mp4', 'mov', 'avi', 'webm' => 'video',
            'mp3', 'wav', 'ogg' => 'audio',
            default => 'document',
        };
    }
}
