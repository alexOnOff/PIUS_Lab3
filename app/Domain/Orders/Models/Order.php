<?php

namespace App\Domain\Orders\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    /**
     * Таблица БД, ассоциированная с моделью
     *
     * @var string
     */
    protected $table = 'orders';

    protected $fillable = [
        'type', 'startPoint', 'finishPoint', 'distance', 'time',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class, 'buyer_id', 'id');
    }
    public function auto()
    {
        return $this->belongsTo(Auto::class, 'auto_id', 'id');
    }
}