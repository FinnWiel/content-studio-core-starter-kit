@php
    $locale = request()->route('locale') ?? (setting('default_lang') ?: app()->getLocale());
    $navigationItems = load_navigation_menu('main', $locale);

    $homePageId = null;

    if (cms_is_multilang()) {
        foreach (setting('homepages', []) ?? [] as $homepage) {
            if (($homepage['lang'] ?? null) === $locale) {
                $homePageId = $homepage['page'] ?? null;
                break;
            }
        }
    } else {
        $homePageId = setting('global_homepage');
    }

    if ($homePageId) {
        $page = \Shazzoo\ContentStudioCore\Models\Page::query()->find($homePageId);

        if ($page) {
            $homePageUrl = cms_route('page', ['slug' => $page->slug, 'locale' => $page->locale]);

            $navigationItems = collect($navigationItems)
                ->map(function (array $item) use ($homePageUrl, $locale): array {
                    if (($item['url'] ?? null) === $homePageUrl) {
                        $item['url'] = cms_route('home', ['locale' => $locale]);
                        $item['active'] = request()->routeIs('home');
                    }

                    return $item;
                })
                ->all();
        }
    }
@endphp

<header class="border-b border-slate-200 bg-slate-50">
    <div class="mx-auto flex w-full max-w-5xl items-center justify-between py-4">
        <a href="{{ cms_route('home', ['locale' => $locale]) }}"
            class="text-sm font-semibold tracking-wide text-slate-900">
            {{ config('app.name') }}
        </a>

        <nav class="flex items-center gap-4 text-sm text-slate-600">
            @forelse($navigationItems as $item)
                <a href="{{ $item['url'] ?? '' }}" @class([
                    'hover:text-slate-900 hover:font-semibold' => !($item['active'] ?? false),
                    'font-semibold text-slate-900' => $item['active'] ?? false,
                ])>
                    {{ $item['title'] ?? 'Untitled' }}
                </a>
            @empty
                <a href="{{ cms_route('home', ['locale' => $locale]) }}" class="hover:text-slate-900">Home</a>
            @endforelse
        </nav>
    </div>
</header>
