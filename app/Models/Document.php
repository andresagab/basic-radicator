<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    // properties

    protected $fillable = ['person_id', 'path', 'to'];

    // eloquent

    /**
     * load and return person model data associated to this model
     * @return BelongsTo
     */
    public function person() : BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id', 'id');
    }

    // methods
    
}
