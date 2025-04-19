<?php

namespace App\Model\Automation\Letters\Interior;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Automation\Secretary\Document;

class IlsIlr extends Model
{
    protected $fillable = [
        'id',
        'sender',
        'security',
        'letter_priority',
        'user_id',

    ];
    public function context(){
        return $this->hasOne(IlsIlrContext::class,'ils_ilr_id');
    }
    public function summary(){
        return $this->hasOne(IlsIlrSummary::class,'ils_ilr_id');
    }
    public function attachment(){
        return $this->hasMany(IlsIlrAttachment::class,'ils_ilr_id');
    }
    public function document(){
        return $this->belongsToMany(document::class,'ils_ilr_documents','ils_ilr_id','document_id');
    }
    public function receiver(){
        return $this->belongsToMany(User::class,'ils_ilr_receivers','ils_ilr_id','user_id');
    }
}
