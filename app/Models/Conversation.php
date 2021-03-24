<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\NewMessage;

class Conversation extends Model
{
    use HasFactory;
    protected $dispatchesEvents = [
        'created' => NewMessage::class
    ];
    protected $fillable = [
        'id','message','user_id' ,'group_id','repeats'
    ];
    public function users(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function group(){
        return $this->belongsTo('App\Models\Group','group_id');
    }
}
