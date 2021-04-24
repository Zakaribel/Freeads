<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Annonce extends Model
{
    use HasFactory;    

    protected $table = 'Annonces';

    protected $primaryKey = 'id';

    protected $fillable = ['title','description','price','photo','user_id'];

 

    public function user(){
        
        return $this->belongsTo(User::class);
    }

}
