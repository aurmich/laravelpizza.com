<?php

declare(strict_types=1);

namespace Modules\Xot\Actions;

use RuntimeException;
use Throwable;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Process;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

/**
 * Classe per eseguire comandi Artisan in modo sicuro.
 */
class ExecuteArtisanCommandAction
{
    use QueueableAction;

    /**
     * Lista dei comandi consentiti per motivi di sicurezza.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> f1d4085 (.)
     * @var array<int, string>
     */
    private array $allowedCommands = [
        'migrate',
        'filament:upgrade',
        'filament:optimize',
        'view:cache',
        'config:cache',
        'route:cache',
        'event:cache',
        'queue:restart',
    ];

    /**
     * Esegue un comando Artisan e restituisce i risultati.
     *
     * @param string $command Il comando Artisan da eseguire (senza "php artisan")
     *
     * @throws RuntimeException Se il comando non è consentito o si verifica un errore
     *
     * @return array{
     *     command: string,
     *     output: array<int, string>,
     *     status: 'completed'|'failed',
     *     exitCode: int
     * } Array con informazioni sull'esecuzione del comando
     */
    public function execute(string $command): array
    {
        Assert::stringNotEmpty($command, 'Il comando non può essere vuoto');
<<<<<<< HEAD

        if (!$this->isCommandAllowed($command)) {
=======
        
        if (! $this->isCommandAllowed($command)) {
>>>>>>> f1d4085 (.)
            throw new RuntimeException("Comando non consentito: {$command}");
        }

        /** @var array<int, string> $output */
        $output = [];
        $status = 'running';

        Event::dispatch('artisan-command.started', [$command]);

        try {
            $process = Process::path(base_path())
                ->command("php artisan {$command}")
                ->timeout(300)
                ->start();

            // Cattura l'output in tempo reale
            while ($process->running()) {
                $data = $process->latestOutput();
<<<<<<< HEAD
                if (!empty($data)) {
                    $formattedData = trim($data);
                    if (!empty($formattedData)) {
=======
                if (! empty($data)) {
                    $formattedData = trim($data);
                    if (! empty($formattedData)) {
>>>>>>> f1d4085 (.)
                        $output[] = $formattedData;
                        Event::dispatch('artisan-command.output', [$command, $formattedData]);
                    }
                }

                $errorData = $process->latestErrorOutput();
<<<<<<< HEAD
                if (!empty($errorData)) {
                    $formattedError = trim($errorData);
                    if (!empty($formattedError)) {
                        $output[] = '[ERROR] ' . $formattedError;
                        Event::dispatch('artisan-command.output', [$command, '[ERROR] ' . $formattedError]);
=======
                if (! empty($errorData)) {
                    $formattedError = trim($errorData);
                    if (! empty($formattedError)) {
                        $output[] = '[ERROR] '.$formattedError;
                        Event::dispatch('artisan-command.output', [$command, '[ERROR] '.$formattedError]);
>>>>>>> f1d4085 (.)
                    }
                }

                usleep(50000); // 50ms di pausa per evitare sovraccarico della CPU
            }

            $result = $process->wait();

            // Cattura qualsiasi output residuo
            $finalOutput = trim($result->output());
<<<<<<< HEAD
            if (!empty($finalOutput)) {
=======
            if (! empty($finalOutput)) {
>>>>>>> f1d4085 (.)
                $output[] = $finalOutput;
                Event::dispatch('artisan-command.output', [$command, $finalOutput]);
            }

            $finalErrorOutput = trim($result->errorOutput());
<<<<<<< HEAD
            if (!empty($finalErrorOutput)) {
                $output[] = '[ERROR] ' . $finalErrorOutput;
                Event::dispatch('artisan-command.output', [$command, '[ERROR] ' . $finalErrorOutput]);
=======
            if (! empty($finalErrorOutput)) {
                $output[] = '[ERROR] '.$finalErrorOutput;
                Event::dispatch('artisan-command.output', [$command, '[ERROR] '.$finalErrorOutput]);
>>>>>>> f1d4085 (.)
            }

            if ($result->successful()) {
                $status = 'completed';
                Event::dispatch('artisan-command.completed', [$command]);
            } else {
                $status = 'failed';
                Event::dispatch('artisan-command.failed', [$command, $finalErrorOutput]);
            }

            return [
                'command' => $command,
                'output' => $output,
                'status' => $status,
                'exitCode' => $result->exitCode() ?? 0,
            ];
        } catch (Throwable $e) {
            Event::dispatch('artisan-command.error', [$command, $e->getMessage()]);
            throw new RuntimeException(
<<<<<<< HEAD
                "Errore durante l'esecuzione del comando {$command}: {$e->getMessage()}",
                (int) $e->getCode(),
                $e,
=======
                "Errore durante l'esecuzione del comando {$command}: {$e->getMessage()}", 
                (int) $e->getCode(), 
                $e
>>>>>>> f1d4085 (.)
            );
        }
    }

    /**
     * Verifica se un comando è presente nella lista dei comandi consentiti.
     *
     * @param string $command Il comando da verificare
     * @return bool True se il comando è consentito, false altrimenti
     */
    private function isCommandAllowed(string $command): bool
    {
        Assert::stringNotEmpty($command, 'Il comando non può essere vuoto');
        return in_array($command, $this->allowedCommands, true);
    }
}
