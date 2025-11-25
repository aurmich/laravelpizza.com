<?php

declare(strict_types=1);

namespace Modules\Notify\Actions\SMS;

<<<<<<< HEAD
use Override;
=======
>>>>>>> b19cd40 (.)
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Notify\Contracts\SMS\SmsActionContract;
<<<<<<< HEAD
use Modules\Notify\Datas\SMS\PlivoData;
use Modules\Notify\Datas\SmsData;
=======
use Modules\Notify\Datas\SmsData;
use Modules\Notify\Datas\SMS\PlivoData;
>>>>>>> b19cd40 (.)
use Spatie\QueueableAction\QueueableAction;

final class SendPlivoSMSAction implements SmsActionContract
{
    use QueueableAction;

    /** @var PlivoData */
    private PlivoData $plivoData;

    /** @var array<string, mixed> */
    private array $vars = [];

    /** @var bool */
    protected bool $debug;

    /** @var string|null */
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
        $this->plivoData = PlivoData::make();
<<<<<<< HEAD

=======
        
>>>>>>> b19cd40 (.)
        if (!$this->plivoData->auth_id) {
            throw new Exception('Auth ID Plivo non configurato in sms.php');
        }

        if (!$this->plivoData->auth_token) {
            throw new Exception('Auth Token Plivo non configurato in sms.php');
        }

        // Parametri a livello di root
        $sender = config('sms.from');
        $this->defaultSender = is_string($sender) ? $sender : null;
        $this->debug = (bool) config('sms.debug', false);
    }

    /**
     * Execute the action.
     *
     * @param SmsData $smsData I dati del messaggio SMS
     * @return array Risultato dell'operazione
     * @throws Exception In caso di errore durante l'invio
     */
<<<<<<< HEAD
    #[Override]
=======
>>>>>>> b19cd40 (.)
    public function execute(SmsData $smsData): array
    {
        // Normalizza il numero di telefono
        $to = (string) $smsData->to;
        if (Str::startsWith($to, '00')) {
            $to = $to !== '' ? ('+' . substr($to, 2)) : $to;
        }

        if (!Str::startsWith($to, '+')) {
            $to = '+39' . $to;
        }

        $from = $smsData->from ?? $this->defaultSender;

        // Plivo richiede l'autenticazione Basic
        $client = new Client([
            'timeout' => $this->plivoData->getTimeout(),
            'auth' => [$this->plivoData->auth_id, $this->plivoData->auth_token],
            'headers' => [
                'Content-Type' => 'application/json',
<<<<<<< HEAD
            ],
=======
            ]
>>>>>>> b19cd40 (.)
        ]);

        $endpoint = $this->plivoData->getBaseUrl() . '/v1/Account/' . $this->plivoData->auth_id . '/Message/';

        try {
            $response = $client->post($endpoint, [
                'json' => [
                    'src' => $from,
                    'dst' => $to,
                    'text' => $smsData->body,
<<<<<<< HEAD
                ],
=======
                ]
>>>>>>> b19cd40 (.)
            ]);

            $this->vars['status_code'] = $response->getStatusCode();
            $this->vars['status_txt'] = $response->getBody()->getContents();

            return $this->vars;
        } catch (ClientException $clientException) {
            throw new Exception(
                $clientException->getMessage() . '[' . __LINE__ . '][' . class_basename($this) . ']',
                $clientException->getCode(),
<<<<<<< HEAD
                $clientException,
=======
                $clientException
>>>>>>> b19cd40 (.)
            );
        }
    }
}
