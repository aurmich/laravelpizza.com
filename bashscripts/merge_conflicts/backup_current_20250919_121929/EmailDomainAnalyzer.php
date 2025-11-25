<?php

declare(strict_types=1);

namespace Modules\User\Actions\Socialite\Utils;

use InvalidArgumentException;
use RuntimeException;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User;
use Webmozart\Assert\Assert;

final class EmailDomainAnalyzer
{
    private User $ssoUser;

    public function __construct(
        private readonly string $ssoProvider,
    ) {
        if (empty($ssoProvider)) {
            throw new InvalidArgumentException('Il provider SSO non può essere vuoto');
        }
    }

    public function setUser(User $ssoUser): self
    {
        //if ($ssoUser === null) {
        //    throw new \InvalidArgumentException('L\'utente SSO non può essere null');
        //}
        $this->ssoUser = $ssoUser;
        return $this;
    }

    public function hasUnrecognizedDomain(): bool
    {
<<<<<<< HEAD
        return !$this->hasFirstPartyDomain() && !$this->hasClientDomain();
=======
        return ! $this->hasFirstPartyDomain() && ! $this->hasClientDomain();
>>>>>>> fbc8f8e (.)
    }

    public function hasFirstPartyDomain(): bool
    {
        if (!isset($this->ssoUser)) {
<<<<<<< HEAD
            throw new RuntimeException(
                'L\'utente SSO non è stato impostato. Utilizzare setUser() prima di chiamare questo metodo.',
            );
=======
            throw new RuntimeException('L\'utente SSO non è stato impostato. Utilizzare setUser() prima di chiamare questo metodo.');
>>>>>>> fbc8f8e (.)
        }

        $email = $this->ssoUser->getEmail();
        if (!is_string($email) || empty($email)) {
            return false;
        }

        $domain = $this->firstPartyDomain();
        if ($domain === null || empty($domain)) {
            return false;
        }

        $emailDomain = Str::of($email)->after('@')->toString();
        $configDomain = Str::of($domain)->after('@')->toString();

        return $emailDomain === $configDomain;
    }

    public function hasClientDomain(): bool
    {
        if (!isset($this->ssoUser)) {
<<<<<<< HEAD
            throw new RuntimeException(
                'L\'utente SSO non è stato impostato. Utilizzare setUser() prima di chiamare questo metodo.',
            );
=======
            throw new RuntimeException('L\'utente SSO non è stato impostato. Utilizzare setUser() prima di chiamare questo metodo.');
>>>>>>> fbc8f8e (.)
        }

        $email = $this->ssoUser->getEmail();
        if (!is_string($email) || empty($email)) {
            return false;
        }

        $clientEmailDomain = $this->clientDomain();
        if ($clientEmailDomain === null || empty($clientEmailDomain)) {
            return false;
        }

        $emailDomain = Str::of($email)->after('@')->toString();
        $configDomain = Str::of($clientEmailDomain)->after('@')->toString();

        return $emailDomain === $configDomain;
    }

<<<<<<< HEAD
    private function firstPartyDomain(): null|string
=======
    private function firstPartyDomain(): ?string
>>>>>>> fbc8f8e (.)
    {
        $res = config(sprintf('services.%s.email_domains.first_party.tld', $this->ssoProvider));
        if (!is_string($res) && $res !== null) {
            return null;
        }
        return $res;
    }

<<<<<<< HEAD
    private function clientDomain(): null|string
=======
    private function clientDomain(): ?string
>>>>>>> fbc8f8e (.)
    {
        $domain = config(sprintf('services.%s.email_domains.client.tld', $this->ssoProvider));
        if (!is_string($domain) && $domain !== null) {
            return null;
        }
        return $domain;
    }
}
