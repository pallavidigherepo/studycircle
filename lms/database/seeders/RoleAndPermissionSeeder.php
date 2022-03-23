<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // We have to follow strict protocol for adding permissions.
        // It must always be moduleName_actionName !!!VERY IMPORTANT
        // create permissions for roles
        Permission::create(['name' => 'index roles']);
        Permission::create(['name' => 'show roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'destroy roles']);

        // User's permissions 
        Permission::create(['name' => 'index users']);
        Permission::create(['name' => 'show users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'destroy users']);
        Permission::create(['name' => 'editRole users']);
        Permission::create(['name' => 'changePassword users']);

        // Course's permissions 
        Permission::create(['name' => 'index courses']);
        Permission::create(['name' => 'show courses']);
        Permission::create(['name' => 'create courses']);
        Permission::create(['name' => 'update courses']);
        Permission::create(['name' => 'destroy courses']);
        
        // Course types permissions 
        Permission::create(['name' => 'index coursesTypes']);
        Permission::create(['name' => 'show coursesTypes']);
        Permission::create(['name' => 'create coursesTypes']);
        Permission::create(['name' => 'update coursesTypes']);
        Permission::create(['name' => 'destroy coursesTypes']);
        
        // Subjects types permissions 
        Permission::create(['name' => 'index subjects']);
        Permission::create(['name' => 'show subjects']);
        Permission::create(['name' => 'create subjects']);
        Permission::create(['name' => 'update subjects']);
        Permission::create(['name' => 'destroy subjects']);
        
        // Questions types permissions 
        Permission::create(['name' => 'index questions']);
        Permission::create(['name' => 'show questions']);
        Permission::create(['name' => 'create questions']);
        Permission::create(['name' => 'update questions']);
        Permission::create(['name' => 'destroy questions']);
        
        // Students permission
        Permission::create(['name' => 'index students']);
        Permission::create(['name' => 'show students']);
        Permission::create(['name' => 'create students']);
        Permission::create(['name' => 'update students']);
        Permission::create(['name' => 'destroy students']);
        Permission::create(['name' => 'index own students']);
        Permission::create(['name' => 'show own students']);
        Permission::create(['name' => 'create own students']);
        Permission::create(['name' => 'update own students']);
        Permission::create(['name' => 'destroy own students']);

        // Now that we have created all the permissions, we will now create roles and start assigning permissions to it.
        // Let's GO
        $owner = Role::create(['name' => 'Owner']);
        // all admins have all permissions
        $permissions = Permission::all();
        // Assign permissions
        $owner->syncPermissions($permissions);

        $ownerInput = [
            'name'=> 'Institute Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make(123456789),
            'mobile_no' => 1234567890,
            'designation' => 'Owner',
        ];
        $ownerUser = User::create($ownerInput);
        $ownerUser->assignRole($owner);

        $superAdmin = Role::create(['name' => 'Super Admin']);
        // Assign permissions
        $superAdmin->syncPermissions($permissions);

        $superAdminInput = [
            'name'=> 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make(123456789),
            'mobile_no' => 1234567890,
            'designation' => 'Super Admin',
        ];
        $superAdminUser = User::create($superAdminInput);
        
        $superAdminUser->assignRole($superAdmin);

        $admin = Role::create(['name' => 'Administrator']);
        // Assign permissions
        $admin->syncPermissions($permissions);

        $adminInput = [
            'name'=> 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(123456789),
            'mobile_no' => 1234567890,
            'designation' => 'Administrator',
        ];
        $adminUser = User::create($adminInput);
        
        $adminUser->assignRole($admin);

        $teacher = Role::create(['name' => 'Teacher']);
        // Assign permissions
        $teacherPermissions = [
            'index students',
            'show students',
            'create students',
            'update students',
            'index own students',
            'show own students',
            'create own students',
            'update own students',
            'destroy own students',
            'index questions',
            'show questions',
            'create questions',
            'update questions',
            'destroy questions',
        ];
        $teacher->syncPermissions($teacherPermissions);

        $teacherInput1 = [
            'name'=> 'Teacher 1',
            'email' => 'teacher1@gmail.com',
            'password' => Hash::make(123456789),
            'mobile_no' => 1234567890,
            'designation' => 'Teacher',
        ];
        $teacher1 = User::create($teacherInput1);
        
        $teacher1->assignRole($teacher);

        $teacherInput2 = [
            'name'=> 'Teacher 2',
            'email' => 'teacher2@gmail.com',
            'password' => Hash::make(123456789),
            'mobile_no' => 1234567890,
            'designation' => 'Teacher',
        ];
        $teacher2 = User::create($teacherInput2);
        
        $teacher2->assignRole($teacher);

        $assistantTeacher = Role::create(['name' => 'Assistant Teacher']);

        $assistantTeacherPermissions = [
            'index students',
            'show students',
            'index own students',
            'show own students',
            'index questions',
            'show questions',
            'create questions',
            'update questions',
            'destroy questions',
        ];
        $assistantTeacher->syncPermissions($assistantTeacherPermissions);

        $assistantTeacherInput = [
            'name'=> 'Assistant Teacher',
            'email' => 'assistantteacher@gmail.com',
            'password' => Hash::make(123456789),
            'mobile_no' => 1234567890,
            'designation' => 'Assistant Teacher',
        ];
        $assistantTeacherUser = User::create($assistantTeacherInput);
        
        $assistantTeacherUser->assignRole($assistantTeacher);
    }
}
