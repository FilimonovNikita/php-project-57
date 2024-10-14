<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    protected function formattedDate(): Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::parse($this->created_at)->format('d.m.Y'),
        );
    }
    public function task(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'label_task', 'label_id', 'task_id');
    }
}
