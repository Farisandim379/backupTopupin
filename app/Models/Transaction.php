<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    /**
     * DIUBAH: Atribut yang dapat diisi disesuaikan dengan semua kolom
     * yang dikirim oleh PayoutController.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'transaction_code',
        'game_name',
        'game_user_id',
        'game_server',
        'nominal_amount',
        'price',
        'payment_method',
        'whatsapp_number',
        'status',
    ];

    /**
     * Sebuah Transaction dimiliki oleh satu User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
