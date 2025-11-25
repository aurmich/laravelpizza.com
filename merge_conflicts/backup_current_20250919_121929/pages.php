<?php

declare(strict_types=1);

return [
    's3test' => [
        'heading' => 'Test',
        'description' => 'Pagina di test ',
        'info' => [
            'title' => 'Informazioni Test',
            'description' => 'Questa pagina permette di testare l\'invio di email tramite il sistema S3. Inserisci i dati richiesti e clicca su "Invia Email" per procedere con il test.',
        ],
        'fields' => [
            'to' => [
                'label' => 'Destinatario',
                'placeholder' => 'Inserisci l\'indirizzo email del destinatario',
                'helper_text' => 'L\'email verrà inviata a questo indirizzo',
<<<<<<< HEAD
                'description' => 'Indirizzo email del destinatario',
=======
                'description' => 'Indirizzo email del destinatario'
>>>>>>> 727968c (.)
            ],
            'subject' => [
                'label' => 'Oggetto',
                'placeholder' => 'Inserisci l\'oggetto dell\'email',
                'helper_text' => 'L\'oggetto apparirà nella casella di posta del destinatario',
<<<<<<< HEAD
                'description' => 'Oggetto dell\'email',
=======
                'description' => 'Oggetto dell\'email'
>>>>>>> 727968c (.)
            ],
            'body_html' => [
                'label' => 'Contenuto',
                'placeholder' => 'Inserisci il contenuto dell\'email',
                'helper_text' => 'Il contenuto può includere formattazione HTML',
<<<<<<< HEAD
                'description' => 'Contenuto dell\'email',
=======
                'description' => 'Contenuto dell\'email'
>>>>>>> 727968c (.)
            ],
        ],
        'actions' => [
            'send_email' => [
                'label' => 'Invia Email',
                'success' => 'Email inviata con successo',
                'error' => 'Errore durante l\'invio dell\'email',
            ],
            'sendEmail' => [
                'label' => 'Invia Email',
                'success' => 'Email inviata con successo',
                'error' => 'Errore durante l\'invio dell\'email',
            ],
        ],
        'notifications' => [
            'check_email_client' => 'Controlla il tuo client email',
            'email_sent_success' => 'Email inviata con successo',
            'email_sent_error' => 'Errore durante l\'invio dell\'email',
        ],
    ],
<<<<<<< HEAD
];
=======
]; 
>>>>>>> 727968c (.)
