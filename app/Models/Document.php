<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender',
        'receiver',
        'objet',
        'keywords',
        'path',
        'date_transmission',
        'user_id',
        'department_id'
    ];

    public function scopeFilterBySender($query, array $filters)
    {
        if ($filters['sender'] ?? false) {
            $query->where('sender', 'like', '%' . request('sender') . '%');
        }
    }

    public function scopeFilterByReceiver($query, array $filters)
    {
        if ($filters['receiver'] ?? false) {
            $query->where('receiver', 'like', '%' . request('receiver') . '%');
        }
    }

    public function scopeFilterByObjet($query, array $filters)
    {
        if ($filters['objet'] ?? false) {
            $query->where('objet', 'like', '%' . request('objet') . '%');
        }
    }

    public function scopeFilterByKeywords($query, array $filters)
    {
        if ($filters['keywords'] ?? false) {
            $query->where('keywords', 'like', '%' . request('keywords') . '%');
        }
    }

    public function scopeFilterByDepartment($query, array $filters)
    {
        if ($filters['department'] ?? false) {
            $departments = DB::table('departments')->where('name', 'like', '%' . request('department') . '%')->get();
            $departmentIds = [];

            foreach ($departments as $department) {
                array_push($departmentIds, $department->id);
            }

            $query->whereIn('department_id', $departmentIds);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
