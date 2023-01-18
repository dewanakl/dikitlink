<?php

namespace Core\Model;

use Core\Facades\App;

/**
 * Representasi model Model
 * 
 * @method static \Core\Model\BaseModel where(string $column, mixed $value, string $statment = '=', string $agr = 'AND')
 * @method static \Core\Model\BaseModel join(string $table, string $column, string $refers, string $param = '=', string $type = 'INNER')
 * @method static \Core\Model\BaseModel leftJoin(string $table, string $column, string $refers, string $param = '=')
 * @method static \Core\Model\BaseModel rightJoin(string $table, string $column, string $refers, string $param = '=')
 * @method static \Core\Model\BaseModel fullJoin(string $table, string $column, string $refers, string $param = '=')
 * @method static \Core\Model\BaseModel orderBy(string $name, string $order = 'ASC')
 * @method static \Core\Model\BaseModel groupBy(string|array $param)
 * @method static \Core\Model\BaseModel limit(int $param)
 * @method static \Core\Model\BaseModel offset(int $param)
 * @method static \Core\Model\BaseModel select(string|array $param)
 * @method static \Core\Model\BaseModel count(string $name = '*')
 * @method static \Core\Model\BaseModel max(string $name)
 * @method static \Core\Model\BaseModel min(string $name)
 * @method static \Core\Model\BaseModel avg(string $name)
 * @method static \Core\Model\BaseModel sum(string $name)
 * @method static \Core\Model\BaseModel get()
 * @method static \Core\Model\BaseModel first()
 * @method static \Core\Model\BaseModel id(mixed $id, mixed $where = null)
 * @method static \Core\Model\BaseModel find(mixed $id, mixed $where = null)
 * @method static mixed findOrFail(mixed $id, mixed $where = null)
 * @method static bool destroy(int $id)
 * @method static \Core\Model\BaseModel create(array $data)
 * @method static bool update(array $data)
 * @method static bool delete()
 * 
 * @see \Core\Model\BaseModel
 *
 * @class Model
 * @package \Core\Model
 */
abstract class Model
{
    protected $table;

    protected string $primaryKey = 'id';

    protected array $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Panggil method secara static
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public static function __callStatic(string $method, array $parameters): mixed
    {
        return App::get()->singleton(get_called_class())->__call($method, $parameters);
    }

    /**
     * Panggil method secara object
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call(string $method, array $parameters): mixed
    {
        $base = new BaseModel();
        $base->table($this->table);
        $base->dates($this->dates);
        $base->primaryKey($this->primaryKey);

        return $base->{$method}(...$parameters);
    }
}
