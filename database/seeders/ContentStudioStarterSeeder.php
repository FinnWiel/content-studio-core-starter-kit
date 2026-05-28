<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Shazzoo\ContentStudioCore\Models\Navigation;
use Shazzoo\ContentStudioCore\Models\Page;
use Shazzoo\ContentStudioCore\Models\Setting;

class ContentStudioStarterSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::query()->firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        );

        $adminUser->forceFill([
            'name' => 'Admin User',
            'is_admin' => true,
        ])->save();

        $homePage = Page::query()->firstOrCreate(
            [
                'locale' => 'nl',
                'slug' => 'home',
            ],
            [
                'translation_key' => (string) Str::uuid(),
                'title' => 'Welcome to Content Studio',
                'template_key' => 'default',
                'is_active' => true,
                'content' => [],
                'header' => [],
                'template_settings' => [],
                'seo' => [
                    'title' => 'Welcome to Content Studio',
                    'description' => 'Starter homepage seeded by Content Studio starter kit.',
                ],
                'created_by' => $adminUser->id,
                'updated_by' => $adminUser->id,
            ],
        );

        $homePage->forceFill([
            'title' => 'Welcome to Content Studio',
            'template_key' => 'default',
            'is_active' => true,
            'template_settings' => [
                'show_page_title' => true,
            ],
            'content' => [
                [
                    'type' => 'welcome-block',
                    'data' => [
                        'heading' => 'Hello,',
                        'message' => 'You can get started by exploring the admin panel, dont be afraid to make changes to this page and come back to see the changes.',
                    ],
                ],
            ],
            'updated_by' => $adminUser->id,
        ])->save();

        Navigation::query()->updateOrCreate(
            [
                'translation_key' => 'main',
                'locale' => 'nl',
            ],
            [
                'title' => 'Main Navigation',
                'slug' => 'main',
                'items' => [
                    [
                        'id' => 'nav-home',
                        'title' => 'Home',
                        'type' => 'page',
                        'page' => $homePage->id,
                        'url' => null,
                        'children' => [],
                    ],
                ],
            ],
        );

        $settings = Setting::query()->firstOrCreate(['id' => 1], ['settings' => []]);

        $settings->settings = array_replace_recursive($settings->settings ?? [], [
            'enable_multilang' => false,
            'default_lang' => 'nl',
            'available_locales' => ['nl'],
            'global_homepage' => $homePage->id,
            'homepages' => [
                [
                    'lang' => 'nl',
                    'page' => $homePage->id,
                ],
            ],
            'seo_site_name' => config('app.name', 'Content Studio'),
            'seo_default_description' => 'Starter website powered by Content Studio Core.',
            'seo_org_description' => 'A starter site configuration for Content Studio projects.',
        ]);
        $settings->save();

        sys_set('active_theme', 'shazzoo/example-theme');
    }
}
