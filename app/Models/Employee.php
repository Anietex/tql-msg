<?php

namespace App\Models;

use App\Traits\UuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, UuidModel;

    protected $fillable = ['first_name','last_name', 'email','phone_no', 'user_id', 'company_id'];


    public function company(){
        return $this->belongsTo(Company::class);
    }
}
