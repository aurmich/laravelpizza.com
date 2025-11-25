<?php

declare(strict_types=1);

namespace Modules\Notify\Datas\SMS;

use Illuminate\Support\Arr;
<<<<<<< HEAD
use Illuminate\Support\Facades\Config;
use Modules\Tenant\Services\TenantService;
use Spatie\LaravelData\Data;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email as MimeEmail;
use Webmozart\Assert\Assert;

class AgiletelecomData extends Data
{
    public null|string $username;
    public null|string $password;
    public null|string $sender;
    public null|string $endpoint;
    public null|string $enable_delivery;
    public null|string $simulation;
    public string $auth_type = 'basic';
    public null|string $api_key;
    public null|string $oauth_token;
    public int $timeout = 30;

    private static null|self $instance = null;

    public static function make(): self
    {
        if (!(self::$instance instanceof AgiletelecomData)) {
            /*
             * $data = TenantService::getConfig('sms');
             * $data = Arr::get($data, 'drivers.agiletelecom', []);
             */
=======
use Spatie\LaravelData\Data;
use Webmozart\Assert\Assert;
use Symfony\Component\Mime\Address;
use Illuminate\Support\Facades\Config;
use Modules\Tenant\Services\TenantService;
use Symfony\Component\Mime\Email as MimeEmail;

class AgiletelecomData extends Data
{
    public ?string $username;
    public ?string $password;
    public ?string $sender;
    public ?string $endpoint;
    public ?string $enable_delivery;
    public ?string $simulation;
    public string $auth_type='basic';
    public ?string $api_key;
    public ?string $oauth_token;
    public int $timeout=30;

    private static ?self $instance = null;


    public static function make(): self
    {
        if (! self::$instance instanceof AgiletelecomData) {
            /*
            $data = TenantService::getConfig('sms');
            $data = Arr::get($data, 'drivers.agiletelecom', []);
            */
>>>>>>> b19cd40 (.)
            $data = Config::array('sms.drivers.agiletelecom');
            self::$instance = self::from($data);
        }

        return self::$instance;
    }

<<<<<<< HEAD
    public function getAuthHeaders(): array
    {
=======

    public function getAuthHeaders(): array
    {
                
>>>>>>> b19cd40 (.)
        switch ($this->auth_type) {
            case 'api_key':
                return [
                    'Authorization' => 'Api-Key ' . $this->api_key,
<<<<<<< HEAD
                    'Content-Type' => 'application/json',
                ];

            case 'oauth':
                return [
                    'Authorization' => 'OAuth ' . $this->oauth_token,
                    'Content-Type' => 'application/json',
                ];

=======
                    'Content-Type' => 'application/json'
                ];
            
            case 'oauth':
                return [
                    'Authorization' => 'OAuth ' . $this->oauth_token,
                    'Content-Type' => 'application/json'
                ];
            
>>>>>>> b19cd40 (.)
            case 'basic':
            default:
                return [
                    'Authorization' => 'Basic ' . base64_encode($this->username . ':' . $this->password),
<<<<<<< HEAD
                    'Content-Type' => 'application/json',
                ];
        }
    }
}
=======
                    'Content-Type' => 'application/json'
                ];
        }
    }
    
}
>>>>>>> b19cd40 (.)
