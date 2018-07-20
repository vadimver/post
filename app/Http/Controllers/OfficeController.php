<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Office;
use App\User;

class OfficeController extends Controller
{
    public function show($id)
    {

        $office = Office::select('offices.number','offices.created_at', 'regions.name as region_name', 'cities.name as city_name')
                ->where('offices.id', $id)
                ->join('regions', 'offices.region_id', '=', 'regions.id')
                ->join('cities', 'offices.city_id', '=', 'cities.id')
                ->get();
        
        if (!$office) {
            return response()->json([
                'success' => false,
                'message' => 'Office with id ' . $id . ' not found'
            ], 400);
        }
           
        return response()->json([
            'success' => true,
            'office' => $office,
        ], 200);
    }
    
    public function delete($id)
    {
        $role = auth()->user()->role;
        
        if ($role == 1) {
            if (Office::where('id', '=', $id)->delete()) {
                return response()->json([
                    'success' => true
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Office could not be deleted'
                ], 500);
            }
        }
    }
    
    public function create(Request $request)
    {   
        $role = auth()->user()->role;
        
        $request->validate([
            'number' => ['required', 'unique:offices'],
        ]);
        
        if ($role == 1) {
            $office = new Office;

            $office->region_id = $request->region_id;
            $office->city_id = $request->city_id;
            $office->number = $request->number;

            $office->save();
            
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You don\'t have permission to perform this action.'
            ], 400);
        }
    }
}
