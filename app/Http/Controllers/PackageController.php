<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Package;

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
}
