<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('trn_activity_log')) {
            Schema::create('trn_activity_log', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('performed_user_id')->default('0')->comment = "If there are any type of user who performed, then that specific type user ID (Ex: Member/Company)";
                $table->tinyInteger('performed_user_type')->default('0')->comment = "If there are any type of user who performed, then type ID (Ex: Member/Company)";
                $table->integer('performed_user_account_id')->default('0')->comment = "Users table ID, who performed the action";
                $table->integer('action_user_account_id')->default('0')->comment = "Users table ID, who receives the action";
                $table->integer('action_user_id')->default('0')->comment = "If there are any type of user who receives the effect from action, then that specific type user ID (Ex: Member/Company)";
                $table->tinyInteger('action_user_type')->default('0')->comment = "If there are any type of user who receives the effect from action, then type ID (Ex: Member/Company)";
                $table->integer('action_id')->default('0')->comment = "Activity ID (Can check activity_log.php config file)";
                $table->integer('platform_type')->nullable()->default(null)->comment = "If the application has different sections, then the specific platform type (Ex: Portal A, Portal B)";
                $table->string('request_ip', 20)->nullable()->default('')->comment = "IP address where the activity occurred";
                $table->text('request_user_agent')->nullable()->default(null)->comment = "User agent/Browser from where the activity triggered";
                $table->text('action_data')->comment = "JSON encoded array of input data";
                $table->integer('action_admin_user_id')->nullable()->default(null)->comment = "If admin performs the activity, then admin user's ID";
                $table->tinyInteger('api_type')->default('1')->comment = "Whether it is admin or front end (1 - Admin, 2 - Front end)";
                $table->dateTime('created_at')->comment = "";
                $table->dateTime('updated_at')->comment = "";
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasTable('trn_activity_log')) {
            Schema::dropIfExists('trn_activity_log');
        }
    }
}
