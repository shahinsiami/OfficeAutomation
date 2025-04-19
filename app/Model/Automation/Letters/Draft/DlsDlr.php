<?php

namespace App\Model\Automation\Letters\Draft;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Automation\Secretary\Document;

class DlsDlr extends Model
{
    protected $fillable = [
        'id',
        'sender',
        'security',
        'letter_priority',
        'user_id',

    ];
    public function context(){
        return $this->hasOne(DlsDlrContext::class,'dls_dlr_id');
    }
    public function summary(){
        return $this->hasOne(DlsDlrSummary::class,'dls_dlr_id');
    }
    public function attachment(){
        return $this->hasMany(DlsDlrAttachment::class,'dls_dlr_id');
    }
    public function document(){
        return $this->belongsToMany(document::class,'dls_dlr_documents','dls_dlr_id','document_id');
    }
    public function receiver(){
        return $this->belongsToMany(User::class,'dls_dlr_receivers','dls_dlr_id','user_id');
    }
}
