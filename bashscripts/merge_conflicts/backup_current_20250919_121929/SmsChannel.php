<?php

declare(strict_types=1);

namespace Modules\Notify\Channels;

use Exception;
use Illuminate\Notifications\Notification;
use Modules\Notify\Datas\SmsData;
use Modules\Notify\Factories\SmsActionFactory;

/**
 * Canale di notifica per l'invio di messaggi SMS.
 *
 * Questo canale utilizza il driver SMS configurato in config/sms.php
 * per inviare messaggi SMS attraverso il provider selezionato.
 */
class SmsChannel
{
    /**
     * Factory per la creazione di azioni SMS.
     */
    private SmsActionFactory $factory;

    /**
     * Crea una nuova istanza del canale.
     */
    public function __construct(SmsActionFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Invia la notifica attraverso il canale SMS.
     *
     * @param mixed $notifiable Entità che riceve la notifica
     * @param Notification $notification Notifica da inviare
     * @return array|null Risultato dell'operazione o null in caso di errore
     * @throws Exception Se la notifica non ha il metodo toSms o il driver non è supportato
     */
    public function send($notifiable, Notification $notification)
    {
<<<<<<< HEAD
        if (!method_exists($notification, 'toSms')) {
=======
        if (! method_exists($notification, 'toSms')) {
>>>>>>> b19cd40 (.)
            throw new Exception('Notification does not have toSms method');
        }

        $smsData = $notification->toSms($notifiable);

<<<<<<< HEAD
        if (!($smsData instanceof SmsData)) {
=======

        if (! $smsData instanceof SmsData) {
>>>>>>> b19cd40 (.)
            throw new Exception('toSms method must return an instance of SmsData');
        }

        $action = $this->factory->create();
<<<<<<< HEAD
=======
        

>>>>>>> b19cd40 (.)

        return $action->execute($smsData);
    }
}
