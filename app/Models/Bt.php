<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bt extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'branch_id',
        'date',
        'total_vouchers',
        'amount',
        'entry_type',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }


    public function scopeStartsBefore(Builder $query, $date): Builder
    {
        if (!empty($date)) {
            $datetime1 = null;
            $datetime2 = null;

            if (isset($date) && !empty($date)) {
                $dates = explode(' – ', $date);
                $fdate = @$dates[0];
                $tdate = @$dates[1];
                if (!empty($fdate) && !empty($tdate)) {
                    $datetime1 = new \DateTime($fdate);
                    $datetime2 = new \DateTime($tdate);
                }
            }

            $date_from = null;
            $date_to = null;

            if (!empty($date)) {
                $date_from = $datetime1->format('Y-m-d');
                $date_to = $datetime2->format('Y-m-d');
            }


        }
    }
}
