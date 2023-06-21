<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;
    protected $table = 'contact_messages';
    protected $fillable = [
        'full_name',
        'email',
        'objet',
        'message'
    ];

    public function scopeFilter($query, array $filters) {
        if ($filters['search'] ?? false) {
            $query->where('objet', 'like', '%' . request('search') . '%')
                ->orWhere('full_name', 'like', '%' . request('search') . '%');
        }
    }
}
