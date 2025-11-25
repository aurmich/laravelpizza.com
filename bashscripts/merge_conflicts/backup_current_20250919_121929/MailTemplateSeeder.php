<?php

declare(strict_types=1);

namespace Modules\Notify\Database\Seeders;

use Modules\Notify\Emails\SpatieEmail;
use Illuminate\Database\Seeder;
use Modules\Notify\Models\MailTemplate;

class MailTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'mailable' => SpatieEmail::class,
                'slug' => 'registration_moderated',
                'subject' => [
                    'it' => 'Registrazione moderata, {{ first_name }}',
<<<<<<< HEAD
                    'en' => 'Registration moderated, {{ first_name }}',
                ],
                'html_template' => [
                    'it' => '<p>Ciao {{ first_name }},</p><p>La tua registrazione è stata moderata.</p>',
                    'en' => '<p>Hello {{ first_name }},</p><p>Your registration has been moderated.</p>',
                ],
                'text_template' => [
                    'it' => 'Ciao {{ first_name }}, La tua registrazione è stata moderata.',
                    'en' => 'Hello {{ first_name }}, Your registration has been moderated.',
                ],
=======
                    'en' => 'Registration moderated, {{ first_name }}'
                ],
                'html_template' => [
                    'it' => '<p>Ciao {{ first_name }},</p><p>La tua registrazione è stata moderata.</p>',
                    'en' => '<p>Hello {{ first_name }},</p><p>Your registration has been moderated.</p>'
                ],
                'text_template' => [
                    'it' => 'Ciao {{ first_name }}, La tua registrazione è stata moderata.',
                    'en' => 'Hello {{ first_name }}, Your registration has been moderated.'
                ]
>>>>>>> b19cd40 (.)
            ],
            [
                'mailable' => SpatieEmail::class,
                'slug' => 'registration_completed',
                'subject' => [
                    'it' => 'Registrazione completata, {{ first_name }}',
<<<<<<< HEAD
                    'en' => 'Registration completed, {{ first_name }}',
                ],
                'html_template' => [
                    'it' => '<p>Ciao {{ first_name }},</p><p>La tua registrazione è stata completata con successo.</p>',
                    'en' => '<p>Hello {{ first_name }},</p><p>Your registration has been completed successfully.</p>',
                ],
                'text_template' => [
                    'it' => 'Ciao {{ first_name }}, La tua registrazione è stata completata con successo.',
                    'en' => 'Hello {{ first_name }}, Your registration has been completed successfully.',
                ],
=======
                    'en' => 'Registration completed, {{ first_name }}'
                ],
                'html_template' => [
                    'it' => '<p>Ciao {{ first_name }},</p><p>La tua registrazione è stata completata con successo.</p>',
                    'en' => '<p>Hello {{ first_name }},</p><p>Your registration has been completed successfully.</p>'
                ],
                'text_template' => [
                    'it' => 'Ciao {{ first_name }}, La tua registrazione è stata completata con successo.',
                    'en' => 'Hello {{ first_name }}, Your registration has been completed successfully.'
                ]
>>>>>>> b19cd40 (.)
            ],
            [
                'mailable' => SpatieEmail::class,
                'slug' => 'registration_rejected',
                'subject' => [
                    'it' => 'Registrazione rifiutata, {{ first_name }}',
<<<<<<< HEAD
                    'en' => 'Registration rejected, {{ first_name }}',
                ],
                'html_template' => [
                    'it' => '<p>Ciao {{ first_name }},</p><p>La tua registrazione è stata rifiutata.</p>',
                    'en' => '<p>Hello {{ first_name }},</p><p>Your registration has been rejected.</p>',
                ],
                'text_template' => [
                    'it' => 'Ciao {{ first_name }}, La tua registrazione è stata rifiutata.',
                    'en' => 'Hello {{ first_name }}, Your registration has been rejected.',
                ],
            ],
=======
                    'en' => 'Registration rejected, {{ first_name }}'
                ],
                'html_template' => [
                    'it' => '<p>Ciao {{ first_name }},</p><p>La tua registrazione è stata rifiutata.</p>',
                    'en' => '<p>Hello {{ first_name }},</p><p>Your registration has been rejected.</p>'
                ],
                'text_template' => [
                    'it' => 'Ciao {{ first_name }}, La tua registrazione è stata rifiutata.',
                    'en' => 'Hello {{ first_name }}, Your registration has been rejected.'
                ]
            ]
>>>>>>> b19cd40 (.)
        ];

        foreach ($templates as $template) {
            $uniqueAttributes = [
                'mailable' => $template['mailable'],
<<<<<<< HEAD
                'slug' => $template['slug'],
=======
                'slug' => $template['slug']
>>>>>>> b19cd40 (.)
            ];

            $data = [
                'subject' => $template['subject'],
                'html_template' => $template['html_template'],
<<<<<<< HEAD
                'text_template' => $template['text_template'],
=======
                'text_template' => $template['text_template']
>>>>>>> b19cd40 (.)
            ];

            MailTemplate::firstOrCreate($uniqueAttributes, $data);
        }
    }
}
