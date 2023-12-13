<?php

namespace App\Models;
use \Illuminate\Notifications\DatabaseNotification as LaravelDatabaseNotification;
/**
 * App\Models\DatabaseNotification
 *
 * @property string $id
 * @property string $type
 * @property string $notifiable_type
 * @property string $notifiable_id
 * @property array $data
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $notifiable
 * @method static \Illuminate\Notifications\DatabaseNotificationCollection<int, static> all($columns = ['*'])
 * @method static \Illuminate\Notifications\DatabaseNotificationCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification query()
 * @method static Builder|DatabaseNotification read()
 * @method static Builder|DatabaseNotification unread()
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification whereNotifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification whereNotifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DatabaseNotification whereUpdatedAt($value)
 * @method static \Illuminate\Notifications\DatabaseNotificationCollection<int, static> all($columns = ['*'])
 * @method static \Illuminate\Notifications\DatabaseNotificationCollection<int, static> get($columns = ['*'])
 * @mixin \Eloquent
 */
class DatabaseNotification extends LaravelDatabaseNotification
{

    protected $dateFormat = 'U';
}
