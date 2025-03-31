<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    use HasFactory; 
    
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    // Define the relationship: A task belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
