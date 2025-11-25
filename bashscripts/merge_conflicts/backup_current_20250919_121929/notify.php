<?php

declare(strict_types=1);

return [
    /*
<<<<<<< HEAD
     * |--------------------------------------------------------------------------
     * | Company Configuration
     * |--------------------------------------------------------------------------
     * |
     * | Configuration for company-specific information that can be customized
     * | per project without modifying the module code.
     * |
     */
=======
    |--------------------------------------------------------------------------
    | Company Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for company-specific information that can be customized
    | per project without modifying the module code.
    |
    */
>>>>>>> b19cd40 (.)
    'company' => [
        'name' => env('COMPANY_NAME', 'Default Company'),
        'team' => env('COMPANY_TEAM', 'Default Team'),
        'webhook_base' => env('WEBHOOK_BASE_URL', 'https://api.example.com'),
        'clinic_name' => env('CLINIC_NAME', 'Default Clinic'),
        'repository_url' => env('REPOSITORY_URL', 'https://github.com/example/repo'),
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Default Test Data
     * |--------------------------------------------------------------------------
     * |
     * | Default values for test data that should be generic and reusable
     * | across different projects.
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Default Test Data
    |--------------------------------------------------------------------------
    |
    | Default values for test data that should be generic and reusable
    | across different projects.
    |
    */
>>>>>>> b19cd40 (.)
    'test_data' => [
        'default_subject' => 'Benvenuto su {{company_name}}',
        'default_content' => 'Grazie per esserti registrato al nostro servizio.',
        'default_welcome_content' => 'Ciao {{user_name}}, benvenuto su {{company_name}}!',
        'default_clinic_name' => '{{clinic_name}}',
        'default_team_name' => '{{team_name}}',
        'default_theme_name' => '{{company_name}} Professional',
        'default_theme_description' => 'Tema professionale per {{company_name}}',
        'default_author' => '{{team_name}}',
        'default_repository' => '{{repository_url}}',
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Webhook Configuration
     * |--------------------------------------------------------------------------
     * |
     * | Default webhook endpoints that can be customized per project.
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Webhook Configuration
    |--------------------------------------------------------------------------
    |
    | Default webhook endpoints that can be customized per project.
    |
    */
>>>>>>> b19cd40 (.)
    'webhooks' => [
        'notification_delivered' => '{{webhook_base}}/webhooks/notification-delivered',
        'notification_bounced' => '{{webhook_base}}/webhooks/notification-bounced',
        'notification_clicked' => '{{webhook_base}}/webhooks/notification-clicked',
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Email Configuration
     * |--------------------------------------------------------------------------
     * |
     * | Default email settings that can be customized per project.
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Email Configuration
    |--------------------------------------------------------------------------
    |
    | Default email settings that can be customized per project.
    |
    */
>>>>>>> b19cd40 (.)
    'email' => [
        'default_from_address' => env('MAIL_FROM_ADDRESS', 'noreply@example.com'),
        'default_from_name' => env('MAIL_FROM_NAME', '{{company_name}}'),
        'default_admin_email' => env('ADMIN_EMAIL', 'admin@{{company_name}}.com'),
        'default_developer_email' => env('DEVELOPER_EMAIL', 'developer@{{company_name}}.com'),
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Path Configuration
     * |--------------------------------------------------------------------------
     * |
     * | Default paths that can be customized per project.
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Path Configuration
    |--------------------------------------------------------------------------
    |
    | Default paths that can be customized per project.
    |
    */
>>>>>>> b19cd40 (.)
    'paths' => [
        'default_avatar_path' => env('DEFAULT_AVATAR_PATH', '/images/avatars/default.svg'),
        'default_image_path' => env('DEFAULT_IMAGE_PATH', '/images/default.jpg'),
    ],
<<<<<<< HEAD
    /*
     * |--------------------------------------------------------------------------
     * | Template Variables
     * |--------------------------------------------------------------------------
     * |
     * | Available template variables that can be used in notification templates.
     * |
     */
=======

    /*
    |--------------------------------------------------------------------------
    | Template Variables
    |--------------------------------------------------------------------------
    |
    | Available template variables that can be used in notification templates.
    |
    */
>>>>>>> b19cd40 (.)
    'template_variables' => [
        'company_name' => '{{company_name}}',
        'team_name' => '{{team_name}}',
        'clinic_name' => '{{clinic_name}}',
        'webhook_base' => '{{webhook_base}}',
        'repository_url' => '{{repository_url}}',
        'user_name' => '{{user_name}}',
        'appointment_date' => '{{appointment_date}}',
        'appointment_time' => '{{appointment_time}}',
    ],
<<<<<<< HEAD
];
=======
]; 
>>>>>>> b19cd40 (.)
