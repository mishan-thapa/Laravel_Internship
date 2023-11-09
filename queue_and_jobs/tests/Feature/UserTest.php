<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/send_mail');//->secure();

        $response->assertStatus(200);
    }
        /**
         * Test a console command.
         */
        public function test_console_command(): void
        {
            $this->artisan('list')->assertExitCode(0);
        }
}
