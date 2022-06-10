<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeafoodshopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 

		Schema::create('country', function(Blueprint $table){
			$table->increments('id');
			$table->string('name', 100)->unique();
			$table->timestamps();
		});
		
		Schema::create('state', function(Blueprint $table){
			$table->increments('id');
			$table->string('name', 100)->unique();
			$table->integer('country_id')->unsigned();
			$table->foreign('country_id')->references('id')->on('country');
			$table->timestamps();
		});

		Schema::create('city', function(Blueprint $table){
			$table->increments('id');
			$table->string('name', 100);
			$table->integer('state_id')->unsigned();
			$table->foreign('state_id')->references('id')->on('state');
			$table->timestamps();
		});

		Schema::create('user', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100); 
			$table->date('dob')->nullable(); 
			$table->char('gender', 1)->nullable(); 
			$table->string('email', 50)->unique();
			$table->string('password', 60);
			$table->text('image')->nullable();
			$table->text('address');
			$table->integer('city_id')->unsigned();
			$table->foreign('city_id')->references('id')->on('city');
			$table->integer('state_id')->unsigned();
			$table->foreign('state_id')->references('id')->on('state');
			$table->integer('country_id')->unsigned();
			$table->foreign('country_id')->references('id')->on('country');
			$table->integer('user_type')->unsigned()->default(1); // 0=admin, 1=user
			$table->string('contact_number', 15)->nullable();
			$table->text('activation_code', 20)->nullable();
			$table->text('reset_password_code', 20)->nullable();
			$table->integer('status'); // 0=inactive, 1=active, 2=disabled
			$table->rememberToken();
			$table->timestamps();
		});

		Schema::create('product', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100); 
			$table->text('description');
			$table->float('price');
			$table->integer('quantity');
			$table->integer('reorder_level');
			$table->integer('set_as_banner'); // 0=no, 1=yes
			$table->text('banner_image')->nullable();
			$table->text('display_image');
			$table->integer('status'); // 0=inactive, 1=active, 2=disabled
			$table->timestamps();
		});

		Schema::create('product_images', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')->references('id')->on('product');
			$table->text('name');
			$table->timestamps();
		});

		Schema::create('product_videos', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')->references('id')->on('product');
			$table->text('link');
			$table->timestamps();
		});
		
		Schema::create('cart', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')->references('id')->on('product');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('user');
			$table->integer('product_quantity');
			$table->timestamps();
		});

		Schema::create('order', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('user');
			$table->integer('payment_mode');
			$table->integer('payment_method');						
			$table->text('transaction_id');
			$table->dateTime('transaction_date');
			$table->integer('transaction_status')->default(0);
			$table->integer('payment_failure_reason');
			$table->float('discount');
			$table->float('total_amount');
			$table->float('cgst_rate');
			$table->float('cgst_amount');
			$table->float('sgst_rate');
			$table->float('sgst_amount');
			$table->float('igst_rate');
			$table->float('igst_amount');
			$table->text('shipping_address');
			$table->text('shipping_locality');
			$table->text('shipping_area');
			$table->integer('shipping_country_id')->unsigned();
			$table->foreign('shipping_country_id')->references('id')->on('country');
			$table->integer('shipping_city_id')->unsigned();
			$table->foreign('shipping_city_id')->references('id')->on('city');
			$table->integer('shipping_state_id')->unsigned();
			$table->foreign('shipping_state_id')->references('id')->on('state');
			$table->integer('shipping_pincode');
			$table->string('shipping_contact', 15);
			$table->text('billing_address');
			$table->text('billing_locality');
			$table->text('billing_area');
			$table->integer('billing_country_id')->unsigned();
			$table->foreign('billing_country_id')->references('id')->on('country');
			$table->integer('billing_city_id')->unsigned();
			$table->foreign('billing_city_id')->references('id')->on('city');
			$table->integer('billing_state_id')->unsigned();
			$table->foreign('billing_state_id')->references('id')->on('state');
			$table->integer('billing_pincode');
			$table->string('billing_contact', 15);			
			$table->timestamps();
		});

		Schema::create('order_details', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('order_id')->unsigned();
			$table->foreign('order_id')->references('id')->on('order');
			$table->text('tracking_id');
			$table->integer('tracking_status');
			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')->references('id')->on('product');
			$table->float('unit_price');
			$table->integer('product_quantity');
			$table->float('product_amount');
			$table->float('discount');
			$table->float('total');
			$table->integer('order_status')->default(0);
			$table->timestamps();
		});
		
		Schema::create('contact_us', function (Blueprint $table) {
			$table->increments('id');
			$table->string('first_name', 50)->nullable();
			$table->string('last_name', 50)->nullable();
			$table->string('phone_number', 50)->nullable();
			$table->string('email', 50)->nullable();
			$table->string('message', 300)->nullable();
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
		Schema::drop('contact_us');
		Schema::drop('order_details');
		Schema::drop('order');
		Schema::drop('cart');
		Schema::drop('product_videos');
		Schema::drop('product_images');
		Schema::drop('product');
		Schema::drop('user');
		Schema::drop('city');
		Schema::drop('state');
        Schema::drop('country'); 
	}
}
