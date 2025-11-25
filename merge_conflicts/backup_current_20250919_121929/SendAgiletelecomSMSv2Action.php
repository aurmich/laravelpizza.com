<?php

declare(strict_types=1);

namespace Modules\Notify\Actions\SMS;

<<<<<<< HEAD
use Override;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Modules\Notify\Contracts\SMS\SmsActionContract;
use Modules\Notify\Datas\SMS\AgiletelecomData;
use Modules\Notify\Datas\SmsData;
=======

use GuzzleHttp\Client;
use Modules\Notify\Datas\SmsData;
use Illuminate\Support\Facades\Http;
use Modules\Notify\Datas\SMS\AgiletelecomData;
use Modules\Notify\Contracts\SMS\SmsActionContract;
>>>>>>> b19cd40 (.)

/**
 * Azione per l'invio di SMS tramite Agile Telecom.
 * @see https://agiletelecom.com/docs/protocollo-http-post-e-get/
 */
class SendAgiletelecomSMSv2Action implements SmsActionContract
{
<<<<<<< HEAD
    #[Override]
    public function execute(SmsData $data): array
    {
        $agile = AgiletelecomData::make();

        $url = 'https://secure.agiletelecom.com/services/sms/send';
        $phone = app(NormalizePhoneNumberAction::class)->execute($data->to);
=======
    
    public function execute(SmsData $data): array
    {
        $agile=AgiletelecomData::make();
       

          
        $url = 'https://secure.agiletelecom.com/services/sms/send';
        $phone=app(NormalizePhoneNumberAction::class)->execute($data->to);
>>>>>>> b19cd40 (.)

        $payload = [
            //'globalId' => $data->reference ?? uniqid('sms_', true),
            //'maxIdLen' => 64,
            //'enableConcatenated' => true,
            //'enableUnicode' => true,
            //'enableDelivery' => $config['enable_delivery'] ?? true,
            //'simulation' => app()->environment('local', 'testing'),
            'messages' => [
                [
                    'destinations' => [$phone],
                    //'ids' => [$data->reference ?? uniqid('msg_', true)],
                    //'sender' => $config['sender'],
                    'sender' => $agile->sender,
                    'body' => $data->body,
                    //'hexBody' => false,
<<<<<<< HEAD
                ],
            ],
        ];

        // "{"globalId":"5a56f05b-a48c-41db-8fc2-063b53368e89","processedMessages":1,"processedSmsParts":1,"credit":9530.73}

        $response = Http::withHeaders($agile->getAuthHeaders())->timeout($agile->timeout)->post($url, $payload);
=======
                ]
            ]
        ];


        

        // "{"globalId":"5a56f05b-a48c-41db-8fc2-063b53368e89","processedMessages":1,"processedSmsParts":1,"credit":9530.73}

        $response = Http::withHeaders($agile->getAuthHeaders())
        ->timeout($agile->timeout)
        ->post($url, $payload);
>>>>>>> b19cd40 (.)

        //dddx($response->body());

        return [];
    }
<<<<<<< HEAD
=======



    
>>>>>>> b19cd40 (.)
}
