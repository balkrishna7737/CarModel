<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
	protected $table = 'cars';
	 protected $fillable = [
        'name',
        'email',
        'phone',
        'description',
		'profile_image',
		'role_id',
		
    ];
	
	 public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
	
}
