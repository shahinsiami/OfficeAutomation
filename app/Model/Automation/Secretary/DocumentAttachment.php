<?php

namespace App\Model\Automation\Secretary;

use Illuminate\Database\Eloquent\Model;

class DocumentAttachment extends Model
{
    protected $fillable = [
        'id',
        'file',
        'extension',
        'document_id',
    ];
    public function document(){
        return $this->belongsTo(Document::class, 'document_id');
    }
}




