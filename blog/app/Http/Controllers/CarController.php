<?php

namespace App\Http\Controllers;

use App\Models\Car;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::getAllCars();
        return view('cars.index', ['cars' => $cars]);
    }

    public function listCars()
    {
        $cars = Car::getAllCars();
        return view('cars.list', ['cars' => $cars]);
    }

    public function show($id)
    {
        $car = Car::getCarById($id);
        return view('cars.show', ['car' => $car]);
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'model' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image'
        ]);

        $imagePath = $request->file('image')->store('public/images');
        $imagePath = str_replace('public/', '', $imagePath);
        $data['image'] = $imagePath;

        $car = Car::Create($data);
        return redirect()->route('cars.list');
    }

    public function edit($id)
    {
        $car = Car::getCarById($id);
        return view('cars.edit', ['car' => $car]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'model' => 'required',
            'year' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/img');
            $imagePath = str_replace('public/', '', $imagePath);
            $data['image'] = $imagePath;
        }

        $car = Car::updateCar($id, $data);
        return redirect()->route('cars.list', ['id' => $car->id]);
    }

    public function destroy($id)
    {
        Car::deleteCar($id);
        return redirect()->route('cars.list');
    }
}
