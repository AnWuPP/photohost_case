<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DateTimeInterface;

class Photo extends Model
{
    use HasFactory;
    protected $dates = ['created_at','updated_at'];
    
    protected function serializeDate(DateTimeInterface $dates)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $dates)->toDateTimeString();
    }

    protected $fillable = [
        'name',
    ];

    protected $appends = [
        'path',
    ];

    protected function path(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::url('photos/' . $this->name),
        );
    }
}
