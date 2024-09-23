<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class TaskLabel extends Model
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
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, "label_id");
    }
}
