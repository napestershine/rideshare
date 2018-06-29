<?php

namespace Tests\Feature;

use Laravel\Lumen\Testing\DatabaseMigrations;
use TestCase;
use App\Models\User;

class UsersTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_logged_in_user_can_get_his_info() {
        $user = $this->be(User::class);

    }
}
