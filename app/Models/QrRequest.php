<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrRequest extends Model
{
    use HasFactory;
    protected $table = "qr_requests";

    protected $fillable = [
        'title',
        'resource',
        'type',
        'is_locked',
        'owner',
        'access_count',
    ];

    /**
     * This function is required for Model.
     */
    public function qr_requests()
    {
        return $this->belongsTo(QrRequest::class);
    }
}
