<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestData extends Model
{
    use HasFactory;

    protected $table = 'request_data';
    protected $fillable = ['latitude', 'longitude', 'address', 'regions_cities_id'];

    public function RegionsCities()
    {
        return $this->belongsTo(RegionsCities::class, 'regions_cities_id');
    }

    // Добавление геоданных с последующим обновлением значения внешнего ключа на значение id
    // связанной модели в родительской таблице

    public function addGeolocData($insertData)
    {
        self::create($insertData);
        $modelRC = new RegionsCities();
        if ($insertData['regions_cities_id'] !== 'none') {
            // RC - RegionsCities
            $dataRC = $modelRC->addName($insertData['regions_cities_id']);
            foreach ($dataRC as $objDataRC) {
                $id = $objDataRC->id;
                break;
            }
            self::where('address', $insertData['address'])->update(['regions_cities_id' => $id]);
        }
    }


}
