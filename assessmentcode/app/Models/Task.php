<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $table = 'tasks';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public $incremeting = true;
    protected $fillable = [
        'title',
        'status',
        'user_id',
        'created_at',
        'updated_at'
    ];
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
