<?php

namespace Shazzoo\ExampleTheme\Templates;

use Shazzoo\ContentStudioCore\Support\Fields\Definitions\ToggleField;
use Shazzoo\ContentStudioCore\Support\Templates\TemplateSettingsDefinition;
use Shazzoo\ContentStudioCore\Support\Theming\Contracts\HasTemplateSettings;

final class DefaultSettings implements HasTemplateSettings
{
    public static function definition(): TemplateSettingsDefinition
    {
        return TemplateSettingsDefinition::make('default')
            ->schema([
                ToggleField::make('show_page_title')
                    ->label('Show page title')
                    ->default(true)
                    ->required(),
            ]);
    }
}
