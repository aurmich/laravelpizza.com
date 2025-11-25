<?php

declare(strict_types=1);

namespace Modules\Notify\Actions\WhatsApp;

<<<<<<< HEAD
use Override;
=======
>>>>>>> b19cd40 (.)
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Notify\Contracts\WhatsAppProviderActionInterface;
use Modules\Notify\Datas\WhatsAppData;
use Spatie\QueueableAction\QueueableAction;
<<<<<<< HEAD

=======
>>>>>>> b19cd40 (.)
use function Safe\json_decode;

final class SendTwilioWhatsAppAction implements WhatsAppProviderActionInterface
{
    use QueueableAction;

    private string $accountSid;
    private string $authToken;
    private string $baseUrl = 'https://api.twilio.com/2010-04-01';
    /** @var array<string, mixed> */
    private array $vars = [];
    protected bool $debug;
    protected int $timeout;
<<<<<<< HEAD
    protected null|string $defaultSender = null;
=======
    protected ?string $defaultSender = null;
>>>>>>> b19cd40 (.)

    /**
     * Create a new action instance.
     */
    public function __construct()
    {
        $accountSid = config('services.twilio.account_sid');
        if (!is_string($accountSid)) {
<<<<<<< HEAD
            throw new Exception(
                'put [TWILIO_ACCOUNT_SID] variable to your .env and config [services.twilio.account_sid]',
            );
=======
            throw new Exception('put [TWILIO_ACCOUNT_SID] variable to your .env and config [services.twilio.account_sid]');
>>>>>>> b19cd40 (.)
        }
        $this->accountSid = $accountSid;

        $authToken = config('services.twilio.auth_token');
        if (!is_string($authToken)) {
<<<<<<< HEAD
            throw new Exception(
                'put [TWILIO_AUTH_TOKEN] variable to your .env and config [services.twilio.auth_token]',
            );
=======
            throw new Exception('put [TWILIO_AUTH_TOKEN] variable to your .env and config [services.twilio.auth_token]');
>>>>>>> b19cd40 (.)
        }
        $this->authToken = $authToken;

        // Parametri a livello di root
        $sender = config('whatsapp.from');
        $this->defaultSender = is_string($sender) ? $sender : null;
        $this->debug = (bool) config('whatsapp.debug', false);
<<<<<<< HEAD
        $this->timeout = is_numeric(config('whatsapp.timeout', 30)) ? ((int) config('whatsapp.timeout', 30)) : 30;
=======
        $this->timeout = is_numeric(config('whatsapp.timeout', 30)) ? (int) config('whatsapp.timeout', 30) : 30;
>>>>>>> b19cd40 (.)
    }

    /**
     * Execute the action.
     *
     * @param WhatsAppData $whatsAppData I dati del messaggio WhatsApp
     * @return array Risultato dell'operazione
     * @throws Exception In caso di errore durante l'invio
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> b19cd40 (.)
    public function execute(WhatsAppData $whatsAppData): array
    {
        $from = 'whatsapp:' . ($whatsAppData->from ?? $this->defaultSender);
        $to = 'whatsapp:' . $whatsAppData->to;
<<<<<<< HEAD

=======
        
>>>>>>> b19cd40 (.)
        // Log di debug se abilitato
        if ($this->debug) {
            Log::debug('Invio WhatsApp Twilio', [
                'to' => $to,
                'from' => $from,
                'message_length' => strlen($whatsAppData->body),
            ]);
        }
<<<<<<< HEAD

        $client = new Client([
            'timeout' => $this->timeout,
            'auth' => [$this->accountSid, $this->authToken],
        ]);

        $endpoint = $this->baseUrl . '/Accounts/' . $this->accountSid . '/Messages.json';

=======
        
        $client = new Client([
            'timeout' => $this->timeout,
            'auth' => [$this->accountSid, $this->authToken]
        ]);
        
        $endpoint = $this->baseUrl . '/Accounts/' . $this->accountSid . '/Messages.json';
        
>>>>>>> b19cd40 (.)
        $payload = [
            'To' => $to,
            'From' => $from,
            'Body' => $whatsAppData->body,
        ];
<<<<<<< HEAD

=======
        
>>>>>>> b19cd40 (.)
        // Aggiungi media se presente
        if (!empty($whatsAppData->media)) {
            $payload['MediaUrl'] = $whatsAppData->media[0];
        }
<<<<<<< HEAD

        try {
            $response = $client->post($endpoint, [
                'form_params' => $payload,
            ]);

=======
        
        try {
            $response = $client->post($endpoint, [
                'form_params' => $payload
            ]);
            
>>>>>>> b19cd40 (.)
            $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
            /** @var array<string, mixed>|null $responseData */
            $responseData = json_decode($responseContent, true) ?: [];
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
            Log::info('WhatsApp Twilio inviato con successo', [
                'to' => $whatsAppData->to,
                'response_code' => $statusCode,
            ]);
<<<<<<< HEAD

            return [
                'success' => $statusCode >= 200 && $statusCode < 300,
                'message_id' => isset($responseData['sid']) && is_string($responseData['sid'])
                    ? $responseData['sid']
                    : null,
=======
            
            return [
                'success' => ($statusCode >= 200 && $statusCode < 300),
                'message_id' => isset($responseData['sid']) && is_string($responseData['sid']) ? $responseData['sid'] : null,
>>>>>>> b19cd40 (.)
                'response' => $responseData,
                'vars' => $this->vars,
            ];
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            /** @var array<string, mixed>|null $responseBody */
            $responseBody = json_decode($response->getBody()->getContents(), true) ?: [];
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
            Log::warning('Errore invio WhatsApp Twilio', [
                'to' => $whatsAppData->to,
                'status' => $statusCode,
                'response' => $responseBody,
            ]);
<<<<<<< HEAD

            return [
                'success' => false,
                'error' => isset($responseBody['message']) && is_string($responseBody['message'])
                    ? $responseBody['message']
                    : 'Errore sconosciuto',
=======
            
            return [
                'success' => false,
                'error' => isset($responseBody['message']) && is_string($responseBody['message']) ? $responseBody['message'] : 'Errore sconosciuto',
>>>>>>> b19cd40 (.)
                'status_code' => $statusCode,
                'vars' => $this->vars,
            ];
        }
    }
}
