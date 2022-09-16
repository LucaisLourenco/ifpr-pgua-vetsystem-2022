<?php

namespace App\Facades;

use App\Models\Permission;

class UserPermissions {
    
    public static function loadPermissions($user_type) { 
        
        $sess = Array();    
        $perm = Permission::with('role')->where('type_id', $user_type)->get();

        foreach($perm as $item) {
            $sess[$item->role->nome] = (boolean) $item->permissao;
        }

        session(['user_permissions' => $sess]);

    }

    public static function isAuthorized($rule) { 
        
        $permissions = session('user_permissions');

        if(array_key_exists($rule, $permissions)) {
            return $permissions[$rule];
        }

        return false;
    }

    public static function lista() { 
        return $permissions = session('user_permissions');
    }
}