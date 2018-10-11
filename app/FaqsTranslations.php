<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqsTranslations extends Model
{
    protected $fillable = [
        'title', 'description','localId','faqsId',
    ];

    protected $table = 'faqstranslations';
}
