<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class RoleUserTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cria usuários admins (dados controlados)
        $this->createAdmins();

        // Vincula usuários aos papéis
        $this->sync();    
    }

    private function createAdmins()
    {
        User::create([
            'email' => 'paul.okwuchi@viezu.com', 
            'name'  => 'Developer',
            'password' => bcrypt('viezu@123'),
            'avatar'  => 'img/config/nopic.png',
            'active'  => true
        ]);
        
        $this->command->info('User dev created');

        User::create([
            'email' => 'admin@admin.com', 
            'name'  => 'Administrator',
            'password' => bcrypt('viezu@123'),
            'avatar'  => 'img/config/nopic.png',
            'active'  => true
        ]);

        $this->command->info('Users dev and admin created');
    }

    private function sync()
    {       
        $role = User::find(1);
        $role->roles()->sync([1]);

        $role = User::find(2);
        $role->roles()->sync([2]);        

        $this->command->info('Users linked to roles!');
    }
}
