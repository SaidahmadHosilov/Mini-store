<?php
// app/Console/Commands/GenerateEcommerceStructure.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateEcommerceStructure extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:ecommerce-structure';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate migrations, models, and controllers for ecommerce structure';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Generating migrations, models, and controllers...');

        // Migrations
        $this->call('make:migration', ['name' => 'create_storages_table']);
        $this->call('make:migration', ['name' => 'create_products_table']);
        $this->call('make:migration', ['name' => 'create_orders_table']);
        $this->call('make:migration', ['name' => 'create_order_products_table']);
        $this->call('make:migration', ['name' => 'create_baskets_table']);

        // Models
        $this->call('make:model', ['name' => 'Storage']);
        $this->call('make:model', ['name' => 'Product']);
        $this->call('make:model', ['name' => 'Order']);
        $this->call('make:model', ['name' => 'OrderProduct']);
        $this->call('make:model', ['name' => 'Basket']);

        // Controllers
        $this->call('make:controller', ['name' => 'ProductController']);
        $this->call('make:controller', ['name' => 'OrderController']);
        $this->call('make:controller', ['name' => 'BasketController']);

        $this->info('Migrations, models, and controllers have been generated!');
    }
}
