<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->string('staffID', 10)->primary();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('contact')->unique();
            $table->string('position');
            $table->set('role', ['director', 'fellow', 'operations', 'chef', 'nurse']);
            $table->string('class')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('staff')->insert([
            [
                'staffID' => 'AIDXXXXXXX',
                'firstname' => 'Emily',
                'lastname' => 'Fiabedzi',
                'email' => 'emily@meltwater.org',
                'contact' => '+12348178041',
                'position' => 'Director of Training Program',
                'role' => 'director',
                'password' => Hash::make('emily1234'),
                'email_verified_at' => now()
            ], [
                'staffID' => 'AID7J21C9D',
                'firstname' => 'Kezia',
                'lastname' => 'Allotey',
                'email' => 'keziah.alloteh@meltwater.org',
                'contact' => '+233205714908',
                'position' => 'Operations Associate',
                'role' => 'operations',
                'password' => Hash::make('kezia1234'),
                'email_verified_at' => now()
            ], [
                'staffID' => 'AID8W76G1M',
                'firstname' => 'Bright',
                'lastname' => 'Ahedor',
                'email' => 'bright.ahedor@meltwater.org',
                'contact' => '+233500294411',
                'position' => 'Technology Teaching Fellow',
                'role' => 'fellow',
                'password' => Hash::make('bright1234'),
                'email_verified_at' => now()
            ], [
                'staffID' => 'AID8W76YUI',
                'firstname' => 'Sandra',
                'lastname' => 'Amoateng',
                'email' => 'amoatengsandra68@gmail.com',
                'contact' => '+233500294412',
                'position' => 'Nurse',
                'role' => 'nurse',
                'password' => Hash::make('nurse1234'),
                'email_verified_at' => now()
            ], [
                'staffID' => 'AID8W7CHEF',
                'firstname' => 'Felicia',
                'lastname' => 'Chef',
                'email' => 'felicia@meltwater.org',
                'contact' => '+233248649124',
                'position' => 'Chef',
                'role' => 'chef',
                'password' => Hash::make('chef1234'),
                'email_verified_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
