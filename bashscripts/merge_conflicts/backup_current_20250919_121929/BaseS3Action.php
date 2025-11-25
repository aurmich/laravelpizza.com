<?php

declare(strict_types=1);

namespace Modules\Media\Actions\S3;

use Aws\S3\S3Client;
use Psr\Log\LoggerInterface;
use Spatie\QueueableAction\QueueableAction;

abstract class BaseS3Action
{
    use QueueableAction;

    protected S3Client $s3Client;
    protected string $bucketName;
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->bucketName = $this->getStringConfig('media.aws.bucket_name', 'AWS_BUCKET_NAME', '');
<<<<<<< HEAD

=======
        
>>>>>>> 0a466ed (.)
        $this->s3Client = new S3Client([
            'region' => $this->getStringConfig('media.aws.region', 'AWS_REGION', 'us-east-1'),
            'version' => '2006-03-01',
            'credentials' => [
<<<<<<< HEAD
                'key' => $this->getStringConfig('media.aws.access_key_id', 'AWS_ACCESS_KEY_ID', ''),
                'secret' => $this->getStringConfig('media.aws.secret_access_key', 'AWS_SECRET_ACCESS_KEY', ''),
            ],
=======
                'key'    => $this->getStringConfig('media.aws.access_key_id', 'AWS_ACCESS_KEY_ID', ''),
                'secret' => $this->getStringConfig('media.aws.secret_access_key', 'AWS_SECRET_ACCESS_KEY', '')
            ]
>>>>>>> 0a466ed (.)
        ]);
    }

    /**
     * Get string configuration value with type safety.
<<<<<<< HEAD
     *
=======
     * 
>>>>>>> 0a466ed (.)
     * @param string $configKey Config key to check first
     * @param string $envKey Environment variable key as fallback
     * @param string $default Default value if neither config nor env is valid
     * @return string Type-safe string value
     */
    protected function getStringConfig(string $configKey, string $envKey, string $default): string
    {
        // Check config first
        $configValue = config($configKey);
        if (is_string($configValue) && trim($configValue) !== '') {
            return $configValue;
        }
<<<<<<< HEAD

=======
        
>>>>>>> 0a466ed (.)
        // Fallback to environment
        $envValue = env($envKey);
        if (is_string($envValue) && trim($envValue) !== '') {
            return $envValue;
        }
<<<<<<< HEAD

        // Return default
        return $default;
    }
}
=======
        
        // Return default
        return $default;
    }
}
>>>>>>> 0a466ed (.)
