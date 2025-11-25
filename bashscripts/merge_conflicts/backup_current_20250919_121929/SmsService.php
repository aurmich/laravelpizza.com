<?php

declare(strict_types=1);

namespace Modules\Notify\Services;

use RuntimeException;
use ReflectionClass;
use ReflectionException;
use Illuminate\Support\Str;
use Webmozart\Assert\Assert;

/**
 * Classe per l'invio di SMS.
 */
class SmsService
{
    // ---------CSS------------
<<<<<<< HEAD
    public null|string $to = null;

    public null|string $from = null;

    public null|string $body = null;
=======
    public ?string $to = null;

    public ?string $from = null;

    public ?string $body = null;
>>>>>>> b19cd40 (.)
    /**
     * Variabili per il template SMS.
     *
     * @var array<string, mixed>
     */
    public array $vars = [];

    /**
     * Driver per l'invio degli SMS.
     */
    public string $driver = 'netfun';

<<<<<<< HEAD
    private static null|self $instance = null;
=======
    private static ?self $instance = null;
>>>>>>> b19cd40 (.)

    /**
     * Ottiene un'istanza singleton della classe.
     */
    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Factory method to create an instance.
     */
    public static function make(): self
    {
        return static::getInstance();
    }

    /**
     * Sets local variables and merges them with the vars array.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> b19cd40 (.)
     * @param array<string, mixed> $vars
     */
    public function setLocalVars(array $vars): self
    {
        foreach ($vars as $k => $v) {
            $this->{$k} = $v;
        }
        $this->vars = array_merge($this->vars, $vars);

        return $this;
    }

    /**
     * Unisce le variabili con quelle esistenti.
     *
     * @param array<string, mixed> $vars
     */
    public function mergeVars(array $vars): self
    {
        $this->vars = array_merge($this->vars, $vars);

        return $this;
    }

    /**
     * Invia l'SMS utilizzando il driver configurato.
     */
    public function send(): self
    {
        $engineClassName = '\\Modules\\Notify\\Services\\SmsEngines\\' . Str::studly($this->driver) . 'Engine';
<<<<<<< HEAD

=======
        
>>>>>>> b19cd40 (.)
        // Verifichiamo che la classe esista
        if (!class_exists($engineClassName)) {
            throw new RuntimeException("La classe del motore SMS {$engineClassName} non esiste");
        }
<<<<<<< HEAD

=======
        
>>>>>>> b19cd40 (.)
        // Verifichiamo che la classe abbia il metodo make
        if (!method_exists($engineClassName, 'make')) {
            throw new RuntimeException("La classe {$engineClassName} non implementa il metodo make()");
        }
<<<<<<< HEAD

        // Creiamo l'istanza in modo sicuro
        $instance = $engineClassName::make();

=======
        
        // Creiamo l'istanza in modo sicuro
        $instance = $engineClassName::make();
        
>>>>>>> b19cd40 (.)
        // Verifichiamo che l'istanza sia un oggetto
        if (!is_object($instance)) {
            throw new RuntimeException("Il metodo make() di {$engineClassName} non ha restituito un oggetto");
        }
<<<<<<< HEAD

=======
        
>>>>>>> b19cd40 (.)
        // Verifichiamo che l'istanza abbia i metodi necessari
        foreach (['setLocalVars', 'send', 'getVars'] as $method) {
            if (!method_exists($instance, $method)) {
                throw new RuntimeException("L'istanza di {$engineClassName} non implementa il metodo {$method}()");
            }
        }
<<<<<<< HEAD

        // Utilizziamo reflection per chiamare i metodi in modo sicuro
        try {
            $reflectionClass = new ReflectionClass($instance);

            // Chiamiamo setLocalVars
            $setLocalVarsMethod = $reflectionClass->getMethod('setLocalVars');
            $setLocalVarsMethod->invoke($instance, $this->vars);

            // Chiamiamo send
            $sendMethod = $reflectionClass->getMethod('send');
            $sendMethod->invoke($instance);

            // Chiamiamo getVars
            $getVarsMethod = $reflectionClass->getMethod('getVars');
            $result = $getVarsMethod->invoke($instance);

=======
        
        // Utilizziamo reflection per chiamare i metodi in modo sicuro
        try {
            $reflectionClass = new ReflectionClass($instance);
            
            // Chiamiamo setLocalVars
            $setLocalVarsMethod = $reflectionClass->getMethod('setLocalVars');
            $setLocalVarsMethod->invoke($instance, $this->vars);
            
            // Chiamiamo send
            $sendMethod = $reflectionClass->getMethod('send');
            $sendMethod->invoke($instance);
            
            // Chiamiamo getVars
            $getVarsMethod = $reflectionClass->getMethod('getVars');
            $result = $getVarsMethod->invoke($instance);
            
>>>>>>> b19cd40 (.)
            // Verifichiamo che il risultato sia un array
            if (!is_array($result)) {
                $result = [];
            }
<<<<<<< HEAD

=======
            
>>>>>>> b19cd40 (.)
            // Convertiamo l'array in array<string, mixed>
            /** @var array<string, mixed> $typedResult */
            $typedResult = [];
            foreach ($result as $key => $value) {
                if (is_string($key)) {
                    $typedResult[$key] = $value;
                }
            }
<<<<<<< HEAD

            $this->mergeVars($typedResult);
        } catch (ReflectionException $e) {
            throw new RuntimeException('Errore durante la chiamata dei metodi: ' . $e->getMessage());
=======
            
            $this->mergeVars($typedResult);
        } catch (ReflectionException $e) {
            throw new RuntimeException("Errore durante la chiamata dei metodi: " . $e->getMessage());
>>>>>>> b19cd40 (.)
        }

        return $this;
    }
}
