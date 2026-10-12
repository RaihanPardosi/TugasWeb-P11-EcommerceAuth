<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_policy_rules(): void
    {
        $admin = User::factory()->admin()->create();
        $editor = User::factory()->editor()->create();
        $otherEditor = User::factory()->editor()->create();
        $user = User::factory()->create();
        $post = Post::factory()->for($editor, 'author')->create();

        $this->assertTrue($admin->can('update', $post));
        $this->assertTrue($admin->can('delete', $post));
        $this->assertTrue($editor->can('update', $post));
        $this->assertTrue($editor->can('delete', $post));
        $this->assertFalse($otherEditor->can('update', $post));
        $this->assertFalse($otherEditor->can('delete', $post));
        $this->assertFalse($user->can('update', $post));
        $this->assertFalse($user->can('delete', $post));
        $this->assertFalse($user->can('create', Post::class));
        $this->assertTrue($editor->can('create', Post::class));
    }

    public function test_editor_can_update_and_delete_own_post(): void
    {
        $editor = User::factory()->editor()->create();
        $post = Post::factory()->for($editor, 'author')->create();

        $this->actingAs($editor)
            ->put(route('manage.artikel.update', $post), [
                'title' => 'Judul Baru',
                'body' => 'Isi artikel yang cukup panjang untuk lolos validasi.',
                'status' => 'published',
            ])
            ->assertRedirect(route('manage.artikel.index'));

        $this->assertSame('Judul Baru', $post->fresh()->title);

        $this->actingAs($editor)->delete(route('manage.artikel.destroy', $post))->assertRedirect();
        $this->assertModelMissing($post);
    }

    public function test_editor_cannot_update_or_delete_another_editors_post(): void
    {
        $owner = User::factory()->editor()->create();
        $intruder = User::factory()->editor()->create();
        $post = Post::factory()->for($owner, 'author')->create(['title' => 'Asli']);

        $this->actingAs($intruder)->get(route('manage.artikel.edit', $post))->assertForbidden();

        $this->actingAs($intruder)
            ->put(route('manage.artikel.update', $post), [
                'title' => 'Diubah',
                'body' => 'Isi artikel yang cukup panjang untuk lolos validasi.',
                'status' => 'draft',
            ])
            ->assertForbidden();

        $this->actingAs($intruder)->delete(route('manage.artikel.destroy', $post))->assertForbidden();

        $this->assertSame('Asli', $post->fresh()->title);
        $this->assertModelExists($post);
    }

    public function test_admin_can_update_and_delete_any_post(): void
    {
        $admin = User::factory()->admin()->create();
        $post = Post::factory()->create();

        $this->actingAs($admin)
            ->put(route('manage.artikel.update', $post), [
                'title' => 'Diubah Admin',
                'body' => 'Isi artikel yang cukup panjang untuk lolos validasi.',
                'status' => 'draft',
            ])
            ->assertRedirect();

        $this->assertSame('Diubah Admin', $post->fresh()->title);

        $this->actingAs($admin)->delete(route('manage.artikel.destroy', $post))->assertRedirect();
        $this->assertModelMissing($post);
    }

    public function test_draft_is_hidden_from_guests_but_visible_to_author(): void
    {
        $editor = User::factory()->editor()->create();
        $draft = Post::factory()->draft()->for($editor, 'author')->create();

        $this->get(route('posts.show', $draft->slug))->assertForbidden();
        $this->actingAs($editor)->get(route('posts.show', $draft->slug))->assertOk();
    }
}
