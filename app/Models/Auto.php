<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    use HasFactory;
    /**
     * Таблица БД, ассоциированная с моделью
     *
     * @var string
     */
    protected $table = 'autos';

    protected $fillable = [
        'mark', 'cost',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class, 'auto_id');
    }
}