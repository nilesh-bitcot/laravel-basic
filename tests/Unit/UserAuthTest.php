<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UserAuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testBasicHttpTest()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/post-login', ['email' => 'nilesh.pixiart@gmail.com', 'password' => '12345']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
}
