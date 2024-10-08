<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('referral_code')->nullable()->after('plan');
            $table->integer('referral_user')->nullable()->after('referral_code');
        });
       
        User::where('type', 'owner')->update(['referral_code' => rand(100000, 999999)]);
    }
};
