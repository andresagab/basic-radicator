<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use HasFactory;

    // properties

    protected $fillable = ['nuip', 'names', 'surnames', 'contact', 'email'];

    // eloquent

    /**
     * load and return all documents model data associated to this model
     * @return HasMany
     */
    public function documents() : HasMany
    {
        return $this->hasMany(Document::class, 'person_id', 'id');
    }

    // methods

}
