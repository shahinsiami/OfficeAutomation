<?php

namespace App\Model\Automation\Letters\Exterior\Receive;

use App\User;
use App\Model\Automation\Secretary\Document;
use Illuminate\Database\Eloquent\Model;

class Elr extends Model
{
    protected $fillable = [
        'id',
        'sender',
        'date_of_entry',
        'date_of_letter',
        'security',
        'type_of_letter',
        'letter_priority',
        'number_of_letter',
        'registrar',
    ];
    public function context(){
        return $this->hasOne(ElrContext::class,'elr_id');
    }
    public function summary(){
        return $this->hasOne(ElrSummary::class,'elr_id');
    }
    public function attachment(){
        return $this->hasMany(ElrAttachment::class,'elr_id');
    }
    public function document(){
        return $this->belongsToMany(Document::class,'elr_documents','elr_id','document_id');
    }
    public function receiver(){
        return $this->belongsToMany(User::class,'elr_receivers','elr_id','user_id');
    }
}
