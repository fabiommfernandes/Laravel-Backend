<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsTranslations extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'description','thumbnail','localId','newsId',
    ];

    protected $table = 'newstranslations';
}
