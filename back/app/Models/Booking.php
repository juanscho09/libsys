<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Booking extends Model
{
    use HasFactory, SoftDeletes;


    protected $appends = [
        'user_name',
        'book_name'
    ];

    protected $casts = [
        'returned_book_at' => 'datetime:d/m/Y H:i:s',
        'borrowed_book_at' => 'datetime:d/m/Y H:i:s',
        'reservation_date' => 'datetime:d/m/Y H:i:s'
    ];

    public function getUserNameAttribute(){
        return $this->user->name ?? "USUARIO ELIMINADO";
    }

    public function getBookNameAttribute(){
        return $this->book->title ?? "LIBRO ELIMINADO";
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }
}
