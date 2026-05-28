<?php

$file = base_path('bootstrap/cache/cms_runtime.php');

$runtime = is_file($file)
    ? require $file
    : [
        'enable_multilang'  => false,
        'default_lang'      => 'nl',
        'available_locales' => ['nl'],
    ];

return [
    'enable_multilang'  => (bool) ($runtime['enable_multilang'] ?? false),
    'default_lang'      => $runtime['default_lang'] ?? 'nl',
    'available_locales' => $runtime['available_locales'] ?? ['nl'],

    'admin_ip_allowlist' => array_values(array_filter(array_map(
        'trim',
        explode(',', (string) env('ADMIN_IP_ALLOWLIST', ''))
    ))),

    'themes_path'  => app_path('Themes'),
    'plugins_path' => app_path('Plugins'),
];