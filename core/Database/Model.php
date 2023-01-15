<?php

namespace Core\Database;

use ArrayIterator;
use Closure;
use Core\Facades\App;
use Exception;
use IteratorAggregate;
use JsonSerializable;
use ReflectionClass;
use ReturnTypeWillChange;
use Traversable;

/**
 * Representasi model database
 * 
 * @method static \Core\Database\BaseModel where(string $column, mixed $value, string $statment = '=', string $agr = 'AND')
 * @method static \Core\Database\BaseModel join(string $table, string $column, string $refers, string $param = '=', string $type = 'INNER')
 * @method static \Core\Database\BaseModel leftJoin(string $table, string $column, string $refers, string $param = '=')
 * @method static \Core\Database\BaseModel rightJoin(string $table, string $column, string $refers, string $param = '=')
 * @method static \Core\Database\BaseModel fullJoin(string $table, string $column, string $refers, string $param = '=')
 * @method static \Core\Database\BaseModel orderBy(string $name, string $order = 'ASC')
 * @method static \Core\Database\BaseModel limit(int $param)
 * @method static \Core\Database\BaseModel offset(int $param)
 * @method static \Core\Database\BaseModel select(string|array $param)
 * @method static \Core\Database\BaseModel count(string $name = '*')
 * @method static \Core\Database\BaseModel max(string $name)
 * @method static \Core\Database\BaseModel min(string $name)
 * @method static \Core\Database\BaseModel avg(string $name)
 * @method static \Core\Database\BaseModel sum(string $name)
 * @method static \Core\Database\BaseModel|\Core\Database\Model get()
 * @method static \Core\Database\BaseModel|\Core\Database\Model first()
 * @method static \Core\Database\BaseModel id(mixed $id, mixed $where = null)
 * @method static \Core\Database\BaseModel|\Core\Database\Model find(mixed $id, mixed $where = null)
 * @method static bool destroy(int $id)
 * @method static \Core\Database\BaseModel|\Core\Database\Model create(array $data)
 * @method static bool update(array $data)
 * @method static bool delete()
 * 
 * @see \Core\Database\BaseModel
 *
 * @class Model
 * @package \Core\Database
 */
abstract class Model implements IteratorAggregate, JsonSerializable
{
    /**
     * Attributes hasil query
     * 
     * @var mixed $attributes
     */
    protected $attributes;

    /**
     * Primary key tabelnya
     * 
     * @var string $primaryKey
     */
    protected $primaryKey = 'id';

    /**
     * Waktu bikin dan update
     * 
     * @var array $dates
     */
    protected $dates = [
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
        return App::get()->make(get_called_class())->__call($method, $parameters);
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
        $child = get_called_class();
        $app = App::get();

        $base = $app->singleton(BaseModel::class);
        $base->setAttribute($this->attributes);
        $base->table($this->table);
        $base->primaryKey($this->primaryKey);
        $base->dates($this->dates);

        $data = $app->invoke($base->reflect(new ReflectionClass($child)), $method, $parameters);
        if (!is_object($data)) {
            return $data;
        }

        $app->bind($child, fn () => $data);
        return $app->singleton($child);
    }

    /**
     * Ambil attribute
     *
     * @return array
     */
    public function attribute(): array
    {
        if (is_bool($this->attributes)) {
            return [];
        }

        return $this->attributes ?? [];
    }

    /**
     * Ubah objek agar bisa iterasi
     *
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->attribute());
    }

    /**
     * Ubah objek ke json secara langsung
     *
     * @return array
     */
    #[ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return $this->attribute();
    }

    /**
     * Ubah objek ke array
     *
     * @return array
     */
    public function __serialize(): array
    {
        return $this->attribute();
    }

    /**
     * Kebalikan dari serialize
     *
     * @param array $data
     * @return void
     */
    public function __unserialize(array $data): void
    {
        $this->attributes = $data;
    }

    /**
     * Ambil sebagian dari attribute
     * 
     * @param array $only
     * @return Model
     */
    public function only(array $only): Model
    {
        $temp = [];
        foreach ($only as $ol) {
            $temp[$ol] = $this->__get($ol);
        }

        $this->attributes = $temp;

        return $this;
    }

    /**
     * Ambil kecuali dari attribute
     * 
     * @param array $except
     * @return Model
     */
    public function except(array $except): Model
    {
        $temp = [];
        foreach ($this->attribute() as $key => $value) {
            if (!in_array($key, $except)) {
                $temp[$key] = $value;
            }
        }

        $this->attributes = $temp;

        return $this;
    }

    /**
     * Error dengan fungsi
     *
     * @param Closure $fn
     * @return mixed
     */
    public function fail(Closure $fn): mixed
    {
        if (!$this->attributes) {
            return $fn();
        }

        return $this;
    }

    /**
     * Ambil nilai dari attribute
     * 
     * @param string $name
     * @return mixed
     */
    public function __get(string $name): mixed
    {
        if ($this->__isset($name)) {
            return $this->attributes[$name];
        }

        return null;
    }

    /**
     * Isi nilai ke model ini
     *
     * @param string $name
     * @param mixed $value
     * @return void
     * 
     * @throws Exception
     */
    public function __set(string $name, mixed $value): void
    {
        if ($this->primaryKey == $name) {
            throw new Exception('Nilai primary key tidak bisa di ubah !');
        }

        $this->attributes[$name] = $value;
    }

    /**
     * Cek nilai dari attribute
     * 
     * @param string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->attributes[$name]);
    }
}
