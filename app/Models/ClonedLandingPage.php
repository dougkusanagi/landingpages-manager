<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ClonedLandingPage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'date:d/m/Y H\hi',
        'updated_at' => 'date:d/m/Y H\hi',
    ];

    // protected function createdAt(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn () => $this->created_at->format('d/m/Y'),
    //     );
    // }
}
