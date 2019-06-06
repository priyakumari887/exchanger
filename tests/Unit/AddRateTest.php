<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;

class AddRateTest extends TestCase
{
   /**
   * @test 
   */
    function check_add_rates()
	{
		$this->withoutExceptionHandling();
	    $data = [
	      'base' => 'US',
	      'date' => '2019-02-02',
	      'inr' => 22,
	      'eur' => 111
	    ];
	    $this->json('post', 'api/exchange_rate', $data)
	         ->assertStatus(Response::HTTP_OK);
	}

	//-------------------------------------------------------------------------

	/**
   	* @test 
   	*/

	function check_update_rates()
	{
		$this->withoutExceptionHandling();
	    $data = [
	      'base' => 'US',
	      'date' => '2019-02-02',
	      'inr' => 2222,
	      'eur' => 111
	    ];
	    $this->json('put', 'api/exchange_rate/1', $data)
	         ->assertStatus(Response::HTTP_OK);
	}
	//-------------------------------------------------------------------------

	/**
   	* @test 
   	*/

	function check_delete_rates()
	{
		$this->withoutExceptionHandling();
	   
	    $this->json('delete', 'api/exchange_rate/1')
	         ->assertStatus(Response::HTTP_OK);
	}
}
