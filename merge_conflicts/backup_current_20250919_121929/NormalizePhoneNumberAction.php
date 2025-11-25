<?php

declare(strict_types=1);

namespace Modules\Notify\Actions\SMS;

use Illuminate\Support\Facades\Http;
use Modules\Notify\Contracts\SMS\SmsActionContract;
use Modules\Notify\Datas\SmsData;
<<<<<<< HEAD

use function Safe\preg_match;
use function Safe\preg_replace;
=======
use function Safe\preg_replace;
use function Safe\preg_match;
>>>>>>> b19cd40 (.)

/**
 * Azione per l'invio di SMS tramite Agile Telecom.
 */
<<<<<<< HEAD
class NormalizePhoneNumberAction
=======
class NormalizePhoneNumberAction 
>>>>>>> b19cd40 (.)
{
    public function execute(string $phoneNumber): string
    {
        // Rimuove parentesi e il loro contenuto
<<<<<<< HEAD
        $phoneNumber = preg_replace("/\([0-9]+?\)/", '', $phoneNumber);

        // Rimuove spazi e caratteri non numerici
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Rimuove gli zeri iniziali
        $phoneNumber = ltrim($phoneNumber, '0');

        // Prefisso italiano
        $prefix = '39';

=======
        $phoneNumber = preg_replace("/\([0-9]+?\)/", "", $phoneNumber);
        
        // Rimuove spazi e caratteri non numerici
        $phoneNumber = preg_replace("/[^0-9]/", "", $phoneNumber);
        
        // Rimuove gli zeri iniziali
        $phoneNumber = ltrim($phoneNumber, '0');
        
        // Prefisso italiano
        $prefix = "39";
        
>>>>>>> b19cd40 (.)
        // Verifica se il numero non inizia già con il prefisso corretto
        if (!preg_match('/^' . $prefix . '/', $phoneNumber)) {
            $phoneNumber = $prefix . $phoneNumber;
        }
<<<<<<< HEAD

        return "+{$phoneNumber}";
=======
        
        return "+$phoneNumber";
        
>>>>>>> b19cd40 (.)
    }
}
