<?php

namespace App\Http\Controllers;

use App\Models\StaffRole;
use Illuminate\Http\Request;

class StaffRoleController extends Controller
{
    public function addRoleToStaff(int $staff_id, int $role_id)
    {
        StaffRole::create(['staff_id' => $staff_id, 'role_id' => $role_id]);
    }

    public function removeRoleFromStaff(int $staff_id, int $role_id)
    {
        $staffrole = StaffRole::where('staff_id', $staff_id)
            ->where('role_id', $role_id);

        if ($staffrole) {
            $staffrole->delete();
            return true;
        }
        return false;
    }
}
