<?php

namespace App\Model\Automation\Secretary;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'id',
        'name',
        'description',
        'registration_number',
    ];
    public function documentAttachment(){
        return $this->hasMany(DocumentAttachment::class, 'document_id');
    }
}



