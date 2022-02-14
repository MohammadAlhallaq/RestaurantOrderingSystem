<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PermissionController extends Controller
{

    public function showPermissions(): View{

        $permissions = Permission::all();
        return View('layout.roles-and-permissions.show-permissions', compact('permissions'));
    }

//    public function addPermission(Request $request)
//    {
//        if ($request->isMethod('post')){
//
//            $rules = [
//                'name' => 'required|min:5|max:30|regex:/^[\pL\s]+$/u|unique:permissions,name'
//            ];
//            $validator = Validator::make($request->all(), $rules);
//
//            if ($validator->fails()){
//                return response()->json(
//                    [
//                        'status'=> false,
//                        'errors'=> $validator->errors()
//                    ]
//                );
//            }
//
//            $permission = new Permission();
//            $permission->name = $request->name;
//            $permission->save();
//
//            return response()->json(
//                [
//                    'status'=> true,
//                ]
//            );
//        }
//        return View('layout.roles-and-permissions.add-permission');
//    }

//    public function editPermission(Request $request, Permission $permission)
//    {
//        if ($request->isMethod('post')){
//
//            $rules = [
//                'name' => 'required|min:5|max:30|regex:/^[\pL\s]+$/u|unique:permissions,name,' . $permission->id,
//            ];
//            $validator = Validator::make($request->all(), $rules);
//
//            if ($validator->fails()){
//                return response()->json(
//                    [
//                        'status'=> false,
//                        'errors'=> $validator->errors()
//                    ]
//                );
//            }
//
//            $permission->name = $request->name;
//            $permission->save();
//
//            return response()->json(
//                [
//                    'status'=> true,
//                ]
//            );
//        }
//        return View('layout.roles-and-permissions.edit-permission', compact('permission'));
//    }

//    public function destroy(Permission $permission): JsonResponse
//    {
//        $permission->delete();
//
//        return response()->json([
//            'status' => true,
//            'message' => 'Permission has been deleted'
//        ]);
//    }


}
