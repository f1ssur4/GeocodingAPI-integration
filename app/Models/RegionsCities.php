<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionsCities extends Model
{
    use HasFactory;
    protected $table = 'regions_cities';
    protected $fillable = ['name'];

    public function RequestData()
    {
        return $this->hasMany(RequestData::class, 'regions_cities_id');
    }

    // Добавление назавания города

    public function addName($cityName)
    {
        if ($this->check($cityName) === 'true') {
            self::create(['name' => $cityName]);
        }
        return $this->getModel($cityName);
    }

    // Проверка на идентичность моделей

    public function check($cityName)
    {
        foreach (self::all() as $obj) {
            if ($obj->name === $cityName) {
                return 'false';
            }
        }
        return 'true';
    }

    // Возврат последней добавленой модели

    public function getModel($cityName)
    {
       return self::where('name', $cityName)->get();
    }
}
