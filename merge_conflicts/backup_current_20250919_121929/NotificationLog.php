<?php

declare(strict_types=1);

namespace Modules\Notify\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Notify\Enums\NotificationLogStatusEnum;

/**
 * Modello per il logging delle notifiche.
 *
 * @property int $id
 * @property int|null $template_id
 * @property string $recipient_type
 * @property int $recipient_id
 * @property string $content
 * @property array $data
 * @property array $channels
 * @property NotificationLogStatusEnum $status
 * @property Carbon|null $sent_at
 * @property Carbon|null $delivered_at
 * @property Carbon|null $opened_at
 * @property Carbon|null $clicked_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read NotificationTemplate|null $template
 */
final class NotificationLog extends BaseModel
{
    protected $fillable = [
        'template_id',
        'recipient_id',
        'recipient_type',
        'content',
        'data',
        'channels',
        'status',
        'sent_at',
        'delivered_at',
        'opened_at',
        'clicked_at',
    ];

    protected $casts = [
        'data' => 'array',
        'channels' => 'array',
        'sent_at' => 'datetime',
        'delivered_at' => 'datetime',
        'opened_at' => 'datetime',
        'clicked_at' => 'datetime',
        'status' => NotificationLogStatusEnum::class,
    ];

    /**
     * Ottiene il template associato a questo log.
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(NotificationTemplate::class);
    }

    /**
     * Ottiene il notifiable associato a questo log.
=======
use Illuminate\Support\Carbon;
use Modules\Predict\Models\Profile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Closure;
use Illuminate\Contracts\Database\Query\Expression;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\User\Models\Traits\HasTenants;
use Modules\Xot\Traits\Updater;

/**
 * NotificationLog model for logging sent notifications.
 *
 * @property int $id
 * @property int|null $template_id
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property string $channel
 * @property string $status
 * @property string|null $status_message
 * @property array<string, mixed>|null $data
 * @property array<string, mixed>|null $metadata
 * @property Carbon|null $sent_at
 * @property Carbon|null $delivered_at
 * @property Carbon|null $failed_at
 * @property Carbon|null $opened_at
 * @property Carbon|null $clicked_at
 * @property int|null $tenant_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read NotificationTemplate|null $template
 * @property-read Model $notifiable
 * @property string $title
 * @property string $content
 * @property string $channels
 * @property string|null $error
 * @property-read Profile|null $creator
 * @property-read string $channel_label
 * @property-read string $status_label
 * @property-read Profile|null $updater
 *
 * @method static Builder<static>|NotificationLog forChannel(string $channel)
 * @method static Builder<static>|NotificationLog forNotifiable(Model $notifiable)
 * @method static Builder<static>|NotificationLog newModelQuery()
 * @method static Builder<static>|NotificationLog newQuery()
 * @method static Builder<static>|NotificationLog query()
 * @method static Builder<static>|NotificationLog whereChannels($value)
 * @method static Builder<static>|NotificationLog whereContent($value)
 * @method static Builder<static>|NotificationLog whereCreatedAt($value)
 * @method static Builder<static>|NotificationLog whereData($value)
 * @method static Builder<static>|NotificationLog whereError($value)
 * @method static Builder<static>|NotificationLog whereId($value)
 * @method static Builder<static>|NotificationLog whereNotifiableId($value)
 * @method static Builder<static>|NotificationLog whereNotifiableType($value)
 * @method static Builder<static>|NotificationLog whereSentAt($value)
 * @method static Builder<static>|NotificationLog whereStatus($value)
 * @method static Builder<static>|NotificationLog whereTitle($value)
 * @method static Builder<static>|NotificationLog whereUpdatedAt($value)
 * @method static Builder<static>|NotificationLog withStatus(string $status)
 * @method static NotificationLog|null first()
 * @method static Collection<int, NotificationLog> get()
 * @method static NotificationLog create(array $attributes = [])
 * @method static NotificationLog firstOrCreate(array $attributes = [], array $values = [])
 * @method static Builder<static>|NotificationLog where((string|Closure) $column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 * @method static Builder<static>|NotificationLog whereNotNull((string|Expression) $columns)
 * @method static int count(string $columns = '*')
 *
 * @mixin \Eloquent
 */
class NotificationLog extends Model
{
    use HasFactory;
    use HasTenants;
    use Updater;

    public const STATUS_PENDING = 'pending';

    public const STATUS_PROCESSING = 'processing';

    public const STATUS_SENT = 'sent';

    public const STATUS_DELIVERED = 'delivered';

    public const STATUS_FAILED = 'failed';

    public const STATUS_SKIPPED = 'skipped';

    public const STATUS_OPENED = 'opened';

    public const STATUS_CLICKED = 'clicked';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notification_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'template_id',
        'notifiable_type',
        'notifiable_id',
        'channel',
        'status',
        'status_message',
        'data',
        'metadata',
        'sent_at',
        'delivered_at',
        'failed_at',
        'opened_at',
        'clicked_at',
        'tenant_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'data' => 'array',
            'metadata' => 'array',
            'sent_at' => 'datetime',
            'delivered_at' => 'datetime',
            'failed_at' => 'datetime',
            'opened_at' => 'datetime',
            'clicked_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the notifiable entity.
>>>>>>> b19cd40 (.)
     */
    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
<<<<<<< HEAD
     * Scope per filtrare i log per notifiable.
     */
    public function scopeForNotifiable(
        Builder $query,
        Model $notifiable,
    ): Builder {
        return $query->where('recipient_type', $notifiable->getMorphClass())->where(
            'recipient_id',
            $notifiable->getKey(),
        );
    }

    /**
     * Scope per filtrare i log per stato.
     */
    public function scopeWithStatus(
        Builder $query,
        NotificationLogStatusEnum $status,
    ): Builder {
=======
     * Get the notification template.
     *
     * @return BelongsTo<NotificationTemplate, \Modules\Notify\Models\NotificationLog>
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(NotificationTemplate::class, 'template_id');
    }

    /**
     * Scope to filter by status.
     *
     * @param Builder<static> $query
     * @return Builder<static>
     */
    public function scopeWithStatus($query, string $status)
    {
>>>>>>> b19cd40 (.)
        return $query->where('status', $status);
    }

    /**
<<<<<<< HEAD
     * Scope per filtrare i log per template.
     */
    public function scopeForTemplate(
        Builder $query,
        int $templateId,
    ): Builder {
        return $query->where('template_id', $templateId);
=======
     * Scope to filter by channel.
     *
     * @param Builder<static> $query
     * @return Builder<static>
     */
    public function scopeForChannel($query, string $channel)
    {
        return $query->where('channel', $channel);
    }

    /**
     * Scope to filter by notifiable entity.
     *
     * @param Builder<static> $query
     * @return Builder<static>
     */
    public function scopeForNotifiable($query, Model $notifiable)
    {
        return $query->where('notifiable_type', get_class($notifiable))
            ->where('notifiable_id', $notifiable->getKey());
    }

    /**
     * Mark the notification as sent.
     */
    public function markAsSent(): self
    {
        $this->update([
            'status' => self::STATUS_SENT,
            'sent_at' => now(),
        ]);

        return $this;
    }

    /**
     * Mark the notification as delivered.
     */
    public function markAsDelivered(): self
    {
        $this->update([
            'status' => self::STATUS_DELIVERED,
            'delivered_at' => now(),
        ]);

        return $this;
    }

    /**
     * Mark the notification as failed.
     */
    public function markAsFailed(?string $message = null): self
    {
        $this->update([
            'status' => self::STATUS_FAILED,
            'status_message' => $message,
            'failed_at' => now(),
        ]);

        return $this;
    }

    /**
     * Mark the notification as opened.
     */
    public function markAsOpened(): self
    {
        $this->update([
            'status' => self::STATUS_OPENED,
            'opened_at' => now(),
        ]);

        return $this;
    }

    /**
     * Mark the notification as clicked.
     */
    public function markAsClicked(): self
    {
        $this->update([
            'status' => self::STATUS_CLICKED,
            'clicked_at' => now(),
        ]);

        return $this;
    }

    /**
     * Get the status label attribute.
     */
    public function getStatusLabelAttribute(): string
    {
        return (string) __('notify::notification.fields.status.'.$this->status);
    }

    /**
     * Get the channel label attribute.
     */
    public function getChannelLabelAttribute(): string
    {
        return (string) __('notify::notification.fields.channel.options.'.$this->channel.'.label');
>>>>>>> b19cd40 (.)
    }
}
