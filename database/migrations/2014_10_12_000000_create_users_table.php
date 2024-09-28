<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // To hash the password
use Illuminate\Support\Facades\Schema;
use App\Models\User; // Assuming you have a User model
use Spatie\Permission\Models\Role; // Assuming you use Spatie's role package

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('user_type')->default('user');
            $table->string('region_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert initial data into the users table
        $superAdminId = DB::table('users')->insertGetId([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'), // Hashing the password
            'user_type' => 'Super Admin',
            'region_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Assign "Super Admin" role if the Role model exists
        if (Role::where('name', 'Super Admin')->exists()) {
            $superAdmin = User::find($superAdminId);
            $superAdmin->assignRole('Super Admin');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the users table
        Schema::dropIfExists('users');
    }
};
