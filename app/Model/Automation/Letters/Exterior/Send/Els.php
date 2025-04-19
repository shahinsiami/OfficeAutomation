<?php

namespace App\Model\Automation\Letters\Exterior\Send;

use App\User;
use App\Model\Automation\Secretary\Document;
use Illuminate\Database\Eloquent\Model;

class Els extends Model
{
    protected $fillable = [
        'id',
        'receiver',
        'date_of_letter',
        'security',
        'type_of_letter',
        'letter_priority',
        'indicator',
        'registrar',
    ];
    public function context(){
        return $this->hasOne(ElsContext::class,'els_id');
    }
    public function summary(){
        return $this->hasOne(ElsSummary::class,'els_id');
    }
    public function attachment(){
        return $this->hasMany(ElsAttachment::class,'els_id');
    }
    public function document(){
        return $this->belongsToMany(Document::class,'els_documents','els_id','document_id');
    }
    public function sender(){
        return $this->belongsToMany(User::class,'els_senders','els_id','user_id');
    }
}
