<?php

namespace Tests\Unit\jamin;

use Tests\TestCase;
use Mockery;
use App\Http\Controllers\PraktijkmanagementController;
use App\Models\User;

class PraktijkmanagementControllerDestroyTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_destroy_redirects_with_success_message_when_user_is_deleted()
    {
        $userId = 5;

        $userModelMock = Mockery::mock(User::class);
        $userModelMock->shouldReceive('sp_DeleteUser')
            ->once()
            ->with($userId)
            ->andReturn(1);

        $controller = new PraktijkmanagementController($userModelMock);

        $response = $controller->destroy($userId);

        $this->assertEquals(
            route('praktijkmanagement.userroles'),
            $response->getTargetUrl()
        );

        $this->assertEquals(
            'User is succesvol verwijdert',
            session('success')
        );
    }

    public function test_destroy_redirects_with_error_message_when_user_is_not_deleted()
    {
        $userId = 5;

        $userModelMock = Mockery::mock(User::class);
        $userModelMock->shouldReceive('sp_DeleteUser')
            ->once()
            ->with($userId)
            ->andReturn(0);

        $controller = new PraktijkmanagementController($userModelMock);

        $response = $controller->destroy($userId);

        $this->assertEquals(
            route('praktijkmanagement.userroles'),
            $response->getTargetUrl()
        );

        $this->assertEquals(
            'User is niet verwijdert',
            session('error')
        );
    }
}
