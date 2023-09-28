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
        Schema::create('student', function (Blueprint $table) {
            $table->string('studentID', 10)->primary();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('contact')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('student')->insert([
            [
                'studentID' => 'SIDXXXXXXX',
                'firstname' => 'Mesheck',
                'lastname' => 'Lukhama',
                'email' => 'mesheck.lukhama@meltwater.org',
                'contact' => '+12348178041',
                'password' => Hash::make('mesheck1234'),
                'email_verified_at' => now()
            ], [
                'studentID' => 'SID7J21C9D',
                'firstname' => 'Elizabeth',
                'lastname' => 'Ojesanmi',
                'email' => 'elizabeth.ojesanmi@meltwater.org',
                'contact' => '+2348067048315',
                'password' => Hash::make('lizzy1234'),
                'email_verified_at' => now()
            ], [
                'studentID' => 'SID8W7CHEF',
                'firstname' => 'Jude',
                'lastname' => 'Ukana',
                'email' => 'jude.ukana@meltwater.org',
                'contact' => '+2348168776889',
                'password' => Hash::make('jude1234'),
                'email_verified_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
