<?php

namespace App\Models;

use App\Casts\Base64Serialized;
use App\Casts\DatetimeTz;
use App\Casts\DiffForHumans;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Session extends Model
{
    use HasFactory;

    protected $dateFormat = 'd-m-Y H:i:s';

    protected function casts()
    {
        return [
            'payload' =>  Base64Serialized::class,
            'last_activity' => DiffForHumans::class,
        ];
    }

    public function getDateFormat()
    {
        return $this->dateFormat;
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }




}
