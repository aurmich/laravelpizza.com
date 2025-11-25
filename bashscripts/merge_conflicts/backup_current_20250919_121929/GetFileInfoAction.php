<?php

declare(strict_types=1);

namespace Modules\Media\Actions\S3;

use Aws\S3\Exception\S3Exception;

class GetFileInfoAction extends BaseS3Action
{
    /**
     * Get detailed file information from S3
     *
     * @return array<string, mixed>
     */
    public function execute(string $key): array
    {
        try {
            $result = $this->s3Client->headObject([
                'Bucket' => $this->bucketName,
<<<<<<< HEAD
                'Key' => $key,
            ]);

            $metadata = $result['@metadata'] ?? [];
            $effectiveUri = is_array($metadata) && isset($metadata['effectiveUri'])
                ? ((string) $metadata['effectiveUri'])
                : null;
=======
                'Key'    => $key,
            ]);

            $metadata = $result['@metadata'] ?? [];
            $effectiveUri = is_array($metadata) && isset($metadata['effectiveUri']) ? (string) $metadata['effectiveUri'] : null;
>>>>>>> 0a466ed (.)

            $fileInfo = [
                'exists' => true,
                'key' => $key,
                'effectiveUri' => $effectiveUri,
                'contentLength' => $result['ContentLength'] ?? null,
                'contentType' => $result['ContentType'] ?? null,
                'lastModified' => $result['LastModified'] ?? null,
                'etag' => $result['ETag'] ?? null,
<<<<<<< HEAD
                'metadata' => $result['Metadata'] ?? [],
=======
                'metadata' => $result['Metadata'] ?? []
>>>>>>> 0a466ed (.)
            ];

            $this->logger->info('File info retrieved successfully', [
                'key' => $key,
<<<<<<< HEAD
                'size' => $fileInfo['contentLength'],
            ]);

            return $fileInfo;
=======
                'size' => $fileInfo['contentLength']
            ]);

            return $fileInfo;

>>>>>>> 0a466ed (.)
        } catch (S3Exception $exception) {
            $this->logger->error('Error getting file info from S3', [
                'key' => $key,
                'error' => $exception->getMessage(),
<<<<<<< HEAD
                'statusCode' => $exception->getStatusCode(),
=======
                'statusCode' => $exception->getStatusCode()
>>>>>>> 0a466ed (.)
            ]);

            return [
                'exists' => false,
                'key' => $key,
                'error' => $exception->getMessage(),
<<<<<<< HEAD
                'errorCode' => $exception->getStatusCode(),
            ];
        }
    }
}
=======
                'errorCode' => $exception->getStatusCode()
            ];
        }
    }
}
>>>>>>> 0a466ed (.)
