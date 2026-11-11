<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'loan_date'=> 'date',
        'due_date'=> 'date',
        'return_at'=> 'date',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }
}
