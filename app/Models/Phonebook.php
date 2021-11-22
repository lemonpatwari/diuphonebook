<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phonebook extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'phone_number', 'email', 'image_url'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */

    protected $appends = ['full_name'];

    /**
     * Get the user's full name.
     *
     * @return string
     */

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
