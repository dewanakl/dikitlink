<?php

namespace Models;

use Core\Model;

final class Stat extends Model
{
    protected $table = 'stats';

    protected $primaryKey = 'id';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
