<?php

namespace Models;

use Core\Database\Model;

final class Log extends Model
{
    protected $table = 'logs';

    protected $primaryKey = 'id';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
