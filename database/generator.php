<?php

use Core\Database\DB;
use Core\Database\Generator;
use App\Models\User;

return new class implements Generator
{
    /**
     * Generate nilai database
     *
     * @return void
     */
    public function run()
    {
        foreach (['admin', 'user'] as $value) {
            DB::table('roles')->create([
                'level' => $value
            ]);
        }

        User::create([
            'nama' => 'admin',
            'email' => 'admin@admin.com',
            'password' => password_hash('admin123', PASSWORD_BCRYPT),
            'role_id' => 1
        ]);
    }
};
