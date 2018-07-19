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
    
    public function create(Request $request)
    {   
        $role = auth()->user()->role;
        
        if ($role) {
            
            $request->validate([
                'name' => 'min:3|regex:/^[a-zA-Z\-\s]+$/',
                'last_name' => 'min:2|regex:/^[a-zA-Z\-\s]+$/',
                'phone' => 'required|numeric',
            ]);
            
            $consignee = new Consignee;

            $consignee->name = $request->name;
            $consignee->last_name = $request->last_name;
            $consignee->phone = $request->phone;
            $consignee->office_id = $request->finish_office;

            $consignee->save();

            $start_map = $request->start_map;
            $finish_map = $request->finish_map;
            $result_map = abs($start_map - $finish_map);
            
            if ($result_map == 2) {
                  $delivery = 3;
            } elseif ($result_map == 1) {
                  $delivery = 2;
            } else {
                  $delivery = 1;
            }
            
            $consign_id = Consignee::latest()->first();
            
            $package = new Package;
            
            $package->user_id = $request->user_id;
            $package->consign_id = $consign_id->id;
            $package->start_office_id = $request->start_office;      
            $package->finish_office_id = $request->finish_office;      
            $package->delivery = $delivery;
            $package->tracking = time();
            $package->status = 1;
            
            $package->save();
            
            return response()->json([
                'success' => true
            ], 400);
                   
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You don\'t have permission to perform this action.'
            ], 400);
        }
    }
    
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
    
    public function show_tracking(Request $request)
    {   
        $get_package = Package::where('tracking', $request->tracking )->pluck('id');
        $id = $get_package[0];
                
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
        
        
    }
}
