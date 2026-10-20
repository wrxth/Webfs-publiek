<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HelpRequest extends Model
{
    protected $fillable = ['table_session_id', 'message', 'status', 'handled_at'];
    protected $casts = ['handled_at' => 'datetime'];
    public function tableSession(): BelongsTo { return $this->belongsTo(TableSession::class); }
}
