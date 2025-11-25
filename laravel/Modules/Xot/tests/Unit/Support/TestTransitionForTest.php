<?php

declare(strict_types=1);

namespace Modules\Xot\Tests\Unit\Support;

use Modules\Notify\Datas\RecordNotificationData;
use Modules\Xot\States\Transitions\XotBaseTransition;

/**
 * Concrete test transition class.
 *
 * @internal
 *
 * @coversNothing
 */
class TestTransitionForTest extends XotBaseTransition
{
    public static string $name = 'test_transition';

    public function getNotificationRecipients(): array
    {
        return [
            /** @phpstan-ignore-next-line property.notFound */
            'test_user' => RecordNotificationData::from(['record' => $this->record, 'channel' => 'mail']),
        ];
    }

    public function sendRecipientNotification(RecordNotificationData $recipient, array $data): void
    {
        // Mock implementation for testing
    }
}
