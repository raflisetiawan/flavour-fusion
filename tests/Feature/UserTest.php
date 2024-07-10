<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Order;
use App\Models\Kedai;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_mass_assignable_attributes()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'phone' => '1234567890',
            'role_id' => 1
        ]);

        $this->assertEquals('Test User', $user->name);
        $this->assertEquals('test@example.com', $user->email);
        $this->assertNotEmpty($user->password);
        $this->assertEquals('1234567890', $user->phone);
        $this->assertEquals(1, $user->role_id);
    }

    /** @test */
    public function it_can_hide_attributes()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
            'remember_token' => 'token'
        ]);

        $array = $user->toArray();

        $this->assertArrayNotHasKey('password', $array);
        $this->assertArrayNotHasKey('remember_token', $array);
    }

    /** @test */
    public function it_can_cast_attributes()
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'password' => bcrypt('password')
        ]);

        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $user->email_verified_at);
        $this->assertTrue(password_verify('password', $user->password));
    }

    /** @test */
    public function it_belongs_to_a_role()
    {
        $role = Role::factory()->create(['name' => 'admin']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->assertInstanceOf(Role::class, $user->role);
        $this->assertEquals('admin', $user->role->name);
    }

    /** @test */
    public function it_has_many_orders()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['customer_id' => $user->id]);

        $this->assertTrue($user->orders->contains($order));
    }

    /** @test */
    public function it_has_many_kedais()
    {
        $user = User::factory()->create();
        $kedai = Kedai::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($user->kedais->contains($kedai));
    }

    /** @test */
    public function it_can_check_if_user_has_a_specific_role()
    {
        $role = Role::factory()->create(['name' => 'admin']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->assertTrue($user->hasRole('admin'));
        $this->assertFalse($user->hasRole('customer'));
    }
}
