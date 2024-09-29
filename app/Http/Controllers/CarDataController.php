<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Car;
use Illuminate\Http\Request;

class CarDataController extends Controller
{
   
	
	
	public function car()
{
    $cars = Car::with('role')->orderBy('id', 'desc')->get(); 
    return view('admin.car', compact('cars'));
}
	


 
public function carstore(Request $request)
{
    $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email',
    'phone' => ['required', 'regex:/^[6-9]\d{9}$/'],
    'description' => 'required|string',
    'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    'role_id' => 'required|integer',
]);

  
    $data = $request->except('profile_image');

    
    if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/profiles'), $filename);
        $data['profile_image'] = $filename;
    }

   
    Car::create($data);

    if ($request->ajax()) {
        return response()->json(['message' => 'Car created successfully!'], 200);
    } else {
        return redirect()->back()->with('success', 'Car created successfully!');
    }
}


	
}

