<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    public function test_loginadmin_page_can_be_rendered(): void
    {
        $response = $this->get('/loginadmin');

        $response->assertStatus(200);
        $response->assertSee('Masuk ke Dashboard Admin');
        $response->assertSee('IdihSebel');
    }

    public function test_guest_is_redirected_from_admin_to_login(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
    }

    public function test_admin_can_login_with_default_credentials(): void
    {
        $response = $this->post('/loginadmin', [
            'email' => 'admin@idihsebel.id',
            'password' => 'admin123',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticated();
    }

    public function test_admin_dashboard_shows_6_members_and_projects(): void
    {
        $admin = User::where('email', 'admin@idihsebel.id')->first();

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Rasya Syahreza');
        $response->assertSee('M. Fathin');
        $response->assertSee('Refaldy Febriansyah');
        $response->assertSee('Surya Aditya');
        $response->assertSee('Leonard');
        $response->assertSee('Fadhila');
        $response->assertSee('Ringkasan &amp; Pengelolaan Portofolio', false);
    }

    public function test_admin_can_update_member_profile(): void
    {
        $admin = User::where('email', 'admin@idihsebel.id')->first();
        $member = Member::first();

        $response = $this->actingAs($admin)->put('/admin/members/' . $member->id, [
            'name' => 'Rasya Syahreza',
            'role' => 'Lead Systems Architect & Full-Stack Engineer',
            'specialization' => 'Distributed Cloud & Laravel Systems',
            'location' => 'Ciamis, Jawa Barat, Indonesia',
            'email' => 'rasya@idihsebel.id',
            'phone' => '+62 812-3456-7801',
            'short_bio' => 'Software Engineer spesialis arsitektur backend scalable dan infrastruktur cloud modern.',
            'about_story' => 'Lulusan SMKN 1 Ciamis jurusan RPL dengan dedikasi pada performa tinggi dan clean architecture.',
            'is_available' => '1',
        ]);

        $response->assertRedirect('/admin');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('members', [
            'id' => $member->id,
            'specialization' => 'Distributed Cloud & Laravel Systems',
        ]);
    }
}

