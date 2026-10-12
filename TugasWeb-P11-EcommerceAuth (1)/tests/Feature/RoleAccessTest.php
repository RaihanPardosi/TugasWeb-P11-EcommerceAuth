<?php

namespace Tests\Feature;

use App\Enums\Role;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_guest_is_redirected_to_login_on_protected_routes(): void
    {
        foreach (['/dashboard', '/pesanan', '/kelola/artikel', '/kelola/pengguna', '/kelola/demo-eager'] as $url) {
            $this->get($url)->assertRedirect(route('login'));
        }
    }

    public function test_regular_user_cannot_open_staff_or_admin_pages(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/dashboard')->assertOk();
        $this->actingAs($user)->get('/kelola/artikel')->assertForbidden();
        $this->actingAs($user)->get('/kelola/artikel/create')->assertForbidden();
        $this->actingAs($user)->get('/kelola/pengguna')->assertForbidden();
        $this->actingAs($user)->get('/kelola/demo-eager')->assertForbidden();
    }

    public function test_editor_can_open_post_management_but_not_admin_pages(): void
    {
        $editor = User::factory()->editor()->create();

        $this->actingAs($editor)->get('/kelola/artikel')->assertOk();
        $this->actingAs($editor)->get('/kelola/artikel/create')->assertOk();
        $this->actingAs($editor)->get('/kelola/pengguna')->assertForbidden();
        $this->actingAs($editor)->get('/kelola/demo-eager')->assertForbidden();
    }

    public function test_admin_can_open_every_management_page(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)->get('/kelola/artikel')->assertOk();
        $this->actingAs($admin)->get('/kelola/pengguna')->assertOk();
        $this->actingAs($admin)->get('/kelola/demo-eager')->assertOk();
    }

    public function test_registration_always_creates_a_regular_user(): void
    {
        $this->post('/register', [
            'name' => 'Pendaftar Baru',
            'email' => 'baru@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'admin',
        ])->assertRedirect(route('dashboard', absolute: false));

        $this->assertSame(Role::User, User::where('email', 'baru@example.com')->firstOrFail()->role);
    }

    public function test_admin_can_change_another_users_role_but_not_their_own(): void
    {
        $admin = User::factory()->admin()->create();
        $target = User::factory()->create();

        $this->actingAs($admin)
            ->patch(route('manage.users.update', $target), ['role' => 'editor'])
            ->assertSessionHas('success');

        $this->assertSame(Role::Editor, $target->fresh()->role);

        $this->actingAs($admin)
            ->patch(route('manage.users.update', $admin), ['role' => 'user'])
            ->assertSessionHas('error');

        $this->assertSame(Role::Admin, $admin->fresh()->role);
    }

    public function test_non_admin_cannot_change_roles(): void
    {
        $editor = User::factory()->editor()->create();
        $target = User::factory()->create();

        $this->actingAs($editor)
            ->patch(route('manage.users.update', $target), ['role' => 'admin'])
            ->assertForbidden();

        $this->assertSame(Role::User, $target->fresh()->role);
    }

    public function test_users_cannot_view_other_users_orders(): void
    {
        $owner = User::factory()->create();
        $stranger = User::factory()->create();
        $order = \App\Models\Order::factory()->for($owner)->create();

        $this->actingAs($owner)->get(route('orders.show', $order->order_number))->assertOk();
        $this->actingAs($stranger)->get(route('orders.show', $order->order_number))->assertForbidden();
        $this->actingAs(User::factory()->admin()->create())->get(route('orders.show', $order->order_number))->assertOk();
    }

    public function test_public_pages_render_with_empty_database(): void
    {
        $this->get('/')->assertOk();
        $this->get('/produk')->assertOk();
        $this->get('/artikel')->assertOk();
    }
}
