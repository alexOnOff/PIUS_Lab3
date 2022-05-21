<?php

namespace App\Domain\Clients\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    /**
     * Таблица БД, ассоциированная с моделью
     *
     * @var string
     */
    protected $table = 'clients';

    protected $fillable = [
        'name', 'surnamename','email', 'password',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id');
    }
}