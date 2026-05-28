<?php

namespace Shazzoo\ExampleTheme\Forms\Blocks;

use Shazzoo\ContentStudioCore\Support\Blocks\BlockDefinition;
use Shazzoo\ContentStudioCore\Support\Fields\Definitions\TextareaField;
use Shazzoo\ContentStudioCore\Support\Fields\Definitions\TextInput;

final class WelcomeBlockDefinition
{
    public static function definition(): BlockDefinition
    {
        return BlockDefinition::make('welcome-block')
            ->label('Welcome Block')
            ->description('Simple starter welcome message block.')
            ->group('Theme')
            ->icon('heroicon-o-sparkles')
            ->schema([
                TextInput::make('heading')
                    ->label('Heading')
                    ->required()
                    ->columnSpan(12),

                TextareaField::make('message')
                    ->label('Message')
                    ->rows(3)
                    ->required()
                    ->columnSpan(12),
            ]);
    }
}
