# Content Studio Core Starter Kit

Laravel starter kit for projects powered by `shazzoo/content-studio-core`.

## What this starter includes

- Content Studio Core preconfigured in a fresh Laravel app
- Filament admin panel at `/admin`
- Example theme: `shazzoo/example-theme`
- Seeded homepage, navigation, language + SEO settings
- Seeded starter block: `welcome-block`
- Custom command: `make:content-studio-user`

## Create a project

Stable tag:

```bash
laravel new my-site --using=finnwiel/content-studio-core-starter-kit
```

Latest starter branch (development):

```bash
laravel new my-site --using=finnwiel/content-studio-core-starter-kit:dev-main
```

Then run:

```bash
cd my-site
npm install
npm run build
```

The starter runs key generation, migrations, and seeding during `post-create-project-cmd`.

## First login

Default seeded admin:

- Email: `admin@example.com`
- Password: `password`

Create your own admin user:

```bash
php artisan make:content-studio-user
```

## Seeded starter data

`ContentStudioStarterSeeder` creates:

- admin user (`is_admin = true`)
- homepage
- main navigation (`translation_key = main`)
- global language settings
- default SEO settings
- active theme set to `shazzoo/example-theme`

## Starter theme structure

Theme location:

- `app/Themes/starter-simple`

Includes:

- layout: `resources/views/layouts/app.blade.php`
- template: `resources/views/templates/default.blade.php`
- header + footer components
- block view: `resources/views/components/blocks/welcome-block.blade.php`
- block definition: `src/Forms/Blocks/WelcomeBlockDefinition.php`
- template settings: `src/Templates/DefaultSettings.php`

Template setting available on `default` template:

- `show_page_title` (toggle)

## Useful commands

```bash
composer run dev
php artisan test
vendor/bin/pint --format agent
php artisan optimize:clear
```

## Troubleshooting

- If styling is missing, restart Vite: `npm run dev`, then hard refresh.
- If routes/config are stale, run `php artisan optimize:clear`.
- If you use `dev-main`, remember `composer.lock` controls the exact commit installed.

## License

Proprietary. Internal starter kit for Shazzoo projects.
