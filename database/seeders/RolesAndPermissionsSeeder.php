<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Creacion de Permisos
        // Usuarios
        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);
        // Escuelas
        Permission::create(['name' => 'ver escuelas']);
        Permission::create(['name' => 'crear escuelas']);
        Permission::create(['name' => 'editar escuelas']);
        Permission::create(['name' => 'eliminar escuelas']);        
        // Estudiantes
        Permission::create(['name' => 'ver estudiantes']);
        Permission::create(['name' => 'crear estudiantes']);
        Permission::create(['name' => 'editar estudiantes']);
        Permission::create(['name' => 'eliminar estudiantes']);
        // Asignaturas
        Permission::create(['name' => 'ver asignaturas']);
        Permission::create(['name' => 'crear asignaturas']);
        Permission::create(['name' => 'editar asignaturas']);
        Permission::create(['name' => 'eliminar asignaturas']);
        // Años Escolares
        Permission::create(['name' => 'ver años escolares']);
        Permission::create(['name' => 'crear años escolares']);
        Permission::create(['name' => 'editar años escolares']);
        Permission::create(['name' => 'eliminar años escolares']);
        // Grados
        Permission::create(['name' => 'ver grados']);
        Permission::create(['name' => 'crear grados']);
        Permission::create(['name' => 'editar grados']);
        Permission::create(['name' => 'eliminar grados']);
        // Secciones
        Permission::create(['name' => 'ver secciones']);
        Permission::create(['name' => 'crear secciones']);
        Permission::create(['name' => 'editar secciones']);
        Permission::create(['name' => 'eliminar secciones']);
        // Boletas
        Permission::create(['name' => 'ver boletas']);
        Permission::create(['name' => 'crear boletas']);
        Permission::create(['name' => 'editar boletas']);
        Permission::create(['name' => 'eliminar boletas']);

        // create roles and assign created permissions
        $role = Role::create(['name' => 'Administrador'])
            ->givePermissionTo(Permission::all());
        
        $role = Role::create(['name' => 'Gestión Administrativa'])
            ->givePermissionTo(['ver usuarios', 'ver escuelas',
            'ver estudiantes', 'crear estudiantes', 'editar estudiantes', 'eliminar estudiantes','ver boletas'
        ]);

        $role = Role::create(['name' => 'Docente'])
            ->givePermissionTo(['ver usuarios', 'ver escuelas',
            'ver estudiantes', 'crear estudiantes', 'editar estudiantes', 'eliminar estudiantes',
            'ver boletas','crear boletas', 'editar boletas', 'eliminar boletas',
        ]);

        
    }
}