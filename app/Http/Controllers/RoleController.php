<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function showRoles(): View
    {

        $roles = Role::all();
        return View('layout.roles-and-permissions.show-roles', compact('roles'));
    }

    public function addRole(Request $request)
    {
        if ($request->isMethod('post')) {

            $rules = [
                'name' => 'required|min:5|max:30|regex:/^[\pL\s]+$/u|unique:roles,name',
                'permissions' => 'required'

            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => false,
                        'errors' => $validator->errors()
                    ]
                );
            }

            $role = new Role();
            $role->name = $request->name;
            $role->save();
            $role->permissions()->attach($request->permissions);

            return response()->json(
                [
                    'status' => true,
                ]
            );
        }
        return View('layout.roles-and-permissions.add-role');
    }

    public function editRole(Request $request, Role $role)
    {
        if ($role->id == Role::MASTER_ADMIN) {
            abort(Response::HTTP_NOT_FOUND);
        }

        if ($request->isMethod('post')) {

            $rules = [
                'name' => 'required|min:5|max:30|regex:/^[\pL\s]+$/u|unique:roles,name,' . $role->id,
                'permissions' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);


            if ($validator->fails()) {
                return response()->json(
                    [
                        'status' => false,
                        'errors' => $validator->errors()
                    ]
                );
            }

            $role->name = $request->name;
            $role->save();
            $role->permissions()->sync($request->permissions);

            return response()->json(
                [
                    'status' => true,
                ]
            );
        }

        return View('layout.roles-and-permissions.edit-role', compact('role'));
    }

    public function destroy(Role $role): JsonResponse
    {
        $role->delete();

        return response()->json([
            'status' => true,
            'message' => 'Permission has been deleted'
        ]);
    }

}
