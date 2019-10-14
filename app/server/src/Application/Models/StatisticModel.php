<?php

namespace App\Application\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class StatisticModel extends Eloquent
{
    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'statistics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['time', 'visits', 'worldId'];

    /**
     * Определяет необходимость отметок времени для модели.
     *
     * @var bool
     */
    public $timestamps = false;

}