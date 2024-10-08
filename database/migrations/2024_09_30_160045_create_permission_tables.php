<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $teams = config('permission.teams');
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $pivotRole = $columnNames['role_pivot_key'] ?? 'role_id';
        $pivotPermission = $columnNames['permission_pivot_key'] ?? 'permission_id';

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }
        if ($teams && empty($columnNames['team_foreign_key'] ?? null)) {
            throw new \Exception('Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            //$table->engine('InnoDB');
            $table->bigIncrements('id'); // permission id
            $table->string('name');       // For MyISAM use string('name', 225); // (or 166 for InnoDB with Redundant/Compact row format)
            $table->string('guard_name'); // For MyISAM use string('guard_name', 25);
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        DB::table($tableNames['permissions'])->insert([
            ['id' => 6, 'name' => 'Add Users', 'guard_name' => 'web', 'created_at' => '2024-09-16 23:08:10', 'updated_at' => '2024-09-16 23:08:10'],
            ['id' => 7, 'name' => 'Edit Users', 'guard_name' => 'web', 'created_at' => '2024-09-16 23:08:17', 'updated_at' => '2024-09-16 23:08:17'],
            ['id' => 8, 'name' => 'Delete Users', 'guard_name' => 'web', 'created_at' => '2024-09-16 23:08:24', 'updated_at' => '2024-09-16 23:08:24'],
            ['id' => 9, 'name' => 'View Users', 'guard_name' => 'web', 'created_at' => '2024-09-16 23:08:32', 'updated_at' => '2024-09-16 23:08:41'],
            ['id' => 10, 'name' => 'Add Roles', 'guard_name' => 'web', 'created_at' => '2024-09-16 23:09:02', 'updated_at' => '2024-09-16 23:09:02'],
            ['id' => 11, 'name' => 'View Roles', 'guard_name' => 'web', 'created_at' => '2024-09-16 23:09:07', 'updated_at' => '2024-09-16 23:09:14'],
            ['id' => 12, 'name' => 'Edit Roles', 'guard_name' => 'web', 'created_at' => '2024-09-16 23:09:21', 'updated_at' => '2024-09-16 23:09:21'],
            ['id' => 13, 'name' => 'Delete Roles', 'guard_name' => 'web', 'created_at' => '2024-09-16 23:09:53', 'updated_at' => '2024-09-16 23:09:53'],
            ['id' => 14, 'name' => 'Add Sessions', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:37:18', 'updated_at' => '2024-09-21 17:27:42'],
            ['id' => 15, 'name' => 'View Sessions', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:37:40', 'updated_at' => '2024-09-21 13:37:40'],
            ['id' => 16, 'name' => 'Edit Sessions', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:37:51', 'updated_at' => '2024-09-21 13:42:06'],
            ['id' => 17, 'name' => 'Delete Sessions', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:38:00', 'updated_at' => '2024-09-21 13:38:00'],
            ['id' => 18, 'name' => 'View Session Deliverables', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:40:04', 'updated_at' => '2024-09-21 13:40:04'],
            ['id' => 19, 'name' => 'Add Schools', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:40:28', 'updated_at' => '2024-09-21 13:40:28'],
            ['id' => 20, 'name' => 'View Schools', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:40:37', 'updated_at' => '2024-09-21 13:40:37'],
            ['id' => 21, 'name' => 'Edit Schools', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:40:56', 'updated_at' => '2024-09-21 13:40:56'],
            ['id' => 22, 'name' => 'Delete Schools', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:41:07', 'updated_at' => '2024-09-21 13:41:07'],
            ['id' => 23, 'name' => 'Add Parents', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:42:23', 'updated_at' => '2024-09-21 13:42:23'],
            ['id' => 24, 'name' => 'View Parents', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:42:30', 'updated_at' => '2024-09-21 13:42:30'],
            ['id' => 25, 'name' => 'Edit Parents', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:42:40', 'updated_at' => '2024-09-21 13:42:40'],
            ['id' => 26, 'name' => 'Delete Parents', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:42:51', 'updated_at' => '2024-09-21 13:42:51'],
            ['id' => 27, 'name' => 'Add Students', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:43:00', 'updated_at' => '2024-09-21 13:43:00'],
            ['id' => 28, 'name' => 'View Students', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:43:08', 'updated_at' => '2024-09-21 13:43:08'],
            ['id' => 29, 'name' => 'Edit Students', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:43:16', 'updated_at' => '2024-09-21 13:43:16'],
            ['id' => 30, 'name' => 'Delete Students', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:43:26', 'updated_at' => '2024-09-21 13:43:26'],
            ['id' => 31, 'name' => 'Add Teachers', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:43:48', 'updated_at' => '2024-09-21 13:43:48'],
            ['id' => 32, 'name' => 'View Teachers', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:43:56', 'updated_at' => '2024-09-21 13:43:56'],
            ['id' => 33, 'name' => 'Edit Teachers', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:44:02', 'updated_at' => '2024-09-21 13:44:02'],
            ['id' => 34, 'name' => 'Delete Teachers', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:44:11', 'updated_at' => '2024-09-21 13:44:11'],
            ['id' => 35, 'name' => 'Add Facilitators', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:44:27', 'updated_at' => '2024-09-21 13:44:27'],
            ['id' => 36, 'name' => 'View Facilitators', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:44:35', 'updated_at' => '2024-09-21 13:44:35'],
            ['id' => 37, 'name' => 'Edit Facilitators', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:44:43', 'updated_at' => '2024-09-21 13:44:43'],
            ['id' => 38, 'name' => 'Delete Facilitators', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:44:52', 'updated_at' => '2024-09-21 13:44:52'],
        ]);
        

        Schema::create($tableNames['roles'], function (Blueprint $table) use ($teams, $columnNames) {
            //$table->engine('InnoDB');
            $table->bigIncrements('id'); // role id
            if ($teams || config('permission.testing')) { // permission.testing is a fix for sqlite testing
                $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
            }
            $table->string('name');       // For MyISAM use string('name', 225); // (or 166 for InnoDB with Redundant/Compact row format)
            $table->string('guard_name'); // For MyISAM use string('guard_name', 25);
            $table->timestamps();
            if ($teams || config('permission.testing')) {
                $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
            } else {
                $table->unique(['name', 'guard_name']);
            }
        });

        DB::table($tableNames['roles'])->insert([
            ['id' => 14, 'name' => 'Regional Facilitator', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:47:33', 'updated_at' => '2024-09-21 13:47:33'],
            ['id' => 15, 'name' => 'Local Facilitator', 'guard_name' => 'web', 'created_at' => '2024-09-21 13:48:39', 'updated_at' => '2024-09-21 13:48:39'],
            ['id' => 16, 'name' => 'Super Admin', 'guard_name' => 'web', 'created_at' => '2024-09-26 23:12:36', 'updated_at' => '2024-09-26 23:12:36'],
        ]);
        

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $pivotPermission, $teams) {
            $table->unsignedBigInteger($pivotPermission);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign($pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_permissions_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], $pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            } else {
                $table->primary([$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            }

        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames, $pivotRole, $teams) {
            $table->unsignedBigInteger($pivotRole);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign($pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_roles_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], $pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            } else {
                $table->primary([$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            }
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames, $pivotRole, $pivotPermission) {
            $table->unsignedBigInteger($pivotPermission);
            $table->unsignedBigInteger($pivotRole);

            $table->foreign($pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign($pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary([$pivotPermission, $pivotRole], 'role_has_permissions_permission_id_role_id_primary');
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
};
