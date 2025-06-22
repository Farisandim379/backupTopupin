<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'needs_server_id',
    ];

    public function topupItems(): HasMany
    {
        return $this->hasMany(TopupItem::class);
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}
