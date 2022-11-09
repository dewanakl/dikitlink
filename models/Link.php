<?php

namespace Models;

use Core\Database\Model;

final class Link extends Model
{
    protected $table = 'links';

    protected $primaryKey = 'id';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
