<?php
// database/migrations/xxxx_xx_xx_create_orders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Foreign key to the users table
            $table->decimal('total_amount', 10, 2);
            $table->string('status')->default('pending'); // order status (pending, completed, canceled)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
