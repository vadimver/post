<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Package;
use App\Consignee;
use App\Region;
use App\City;

class PackageController extends Controller
{
    public function status_update(Request $request, $id)
    {   
        
        $role = auth()->user()->role;
 
        if ($role == 1 || $role == 2) {
            
            $package = Package::findOrFail($id);
            
            
            
            if (!$package) {
                return response()->json([
                    'success' => false,
                    'message' => 'User with id ' . $id . ' not found'
                ], 400);
            } 
            
            $updated = $package->update(['status' => $request->new_status]); 
            
            if ($updated) {
                return response()->json([
                    'success' => true
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Package could not be updated'
                ], 500);
            }
        }
    }
    
    public function show($id)
    {   
        
        $role = auth()->user()->role;
        
        $package = Package::find($id);
        $consignee = Package::find($id)->consign;
        $user = Package::find($id)->user;
        
        $start_office = Package::find($id)->start_office;
        $finish_office = Package::find($id)->finish_office;
        
        $start_region = Region::where('id', $start_office->region_id)->get();
        $start_city = City::where('id', $start_office->city_id)->get();
        
        $finish_region = Region::where('id', $finish_office->region_id)->get();
        $finish_city = City::where('id', $finish_office->city_id)->get();
        
        if (!$package) {
            return response()->json([
                'success' => false,
                'message' => 'Package with id ' . $id . ' not found'
            ], 400);
        }
        
        if ( $role == 1 || $role == 2 || $role == 3) {
           
            return response()->json([
                'success' => true,
                'package' => $package->toArray(),
                'users' => $user->toArray(),
                'start_office' => $start_office->toArray(), 
                'finish_office' => $finish_office->toArray(),
                'start_region' => $start_region->toArray(),
                'start_city' => $start_city->toArray(),
                'finish_region' => $finish_region->toArray(),
                'finish_city' => $finish_city->toArray(),
                'consignees' => $consignee->toArray()
            ], 400);
        
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You don\'t have permission to perform this action.'
            ], 400);
        }

    }
}
