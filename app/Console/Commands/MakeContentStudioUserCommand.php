<?php

namespace App\Console\Commands;

use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class MakeContentStudioUserCommand extends Command
{
    protected $signature = 'make:content-studio-user {--name=} {--email=} {--password=}';

    protected $description = 'Create a Content Studio admin user';

    public function handle(): int
    {
        $name = $this->option('name') ?: text(
            label: 'Name',
            required: true,
        );

        $email = $this->option('email') ?: text(
            label: 'Email address',
            required: true,
            validate: fn (string $value): ?string => match (true) {
                ! filter_var($value, FILTER_VALIDATE_EMAIL) => 'The email address must be valid.',
                User::query()->where('email', $value)->exists() => 'A user with this email address already exists.',
                default => null,
            },
        );

        $plainPassword = $this->option('password') ?: password(
            label: 'Password',
            required: true,
        );

        $user = User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($plainPassword),
            'email_verified_at' => now(),
        ]);

        $user->forceFill([
            'is_admin' => true,
        ])->save();

        $loginUrl = Filament::getPanel('admin')?->getLoginUrl() ?? url('/admin/login');

        $this->components->info("Success! {$email} may now log in at {$loginUrl}");

        return self::SUCCESS;
    }
}
