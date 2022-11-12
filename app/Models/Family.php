<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $table = 'family_tree';
    protected $fillable = [
        'name', 'gender', 'parent_id'
    ];

    public function childs()
    {
        return $this->hasMany(Family::class, 'parent_id');
    }
}
