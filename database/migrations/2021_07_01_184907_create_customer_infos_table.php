    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('count')->nullable();
            $table->string('with_family')->nullable();
            $table->string('job')->nullable();
            $table->string('car_model')->nullable();
            $table->string('phone')->nullable();
            $table->string('age')->nullable();
            $table->string('estate_type_id')->nullable();
            $table->string('Terms_of_purchase')->nullable();
            $table->string('Purchasing_power')->nullable();
            $table->string('visited_estate_count')->nullable();
            $table->string('admin_comment')->nullable();
            $table->string('circulation_comment')->nullable();
            $table->string('attract_comment')->nullable();
            $table->string('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_infos');
    }
}
