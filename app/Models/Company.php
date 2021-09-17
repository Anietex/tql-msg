<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, UuidModel, SoftDeletes;

    protected $fillable = ['name','email','logo','created_by', 'user_id', 'website'];

    public function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }
}
