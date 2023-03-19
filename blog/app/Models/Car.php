<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['name','description','model','price','image'];

    public static function getAllCars(){
        return Car::all();
    }

    public static function getCarById($id)
    {
        return Car::find($id);
    }

    public static function createCar($data)
    {
        return Car::create($data);
    }

    public static function updateCar($id, $data)
    {
        $product = Car::find($id);
        $product->update($data);
        return $product;
    }

    public static function deleteCar($id)
    {
        $product = Car::find($id);
        $product->delete();
    }
}
