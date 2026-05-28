{{--
Template Name: Starter Default
Template Key: default
Description: Minimal default template for starter projects
Regions: content
--}}

@extends($layout)

@section('content')
    <section class="space-y-6">
        @if (($page->template_settings['show_page_title'] ?? true) && !empty($page->title))
            <header class="space-y-2">
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900">{{ $page->title }}</h1>
                @if (!empty($page->excerpt))
                    <p class="text-base text-slate-600">{{ $page->excerpt }}</p>
                @endif
            </header>
        @endif

        <div class="space-y-6">
            @foreach ($pageBlocks['content'] ?? [] as $block)
                @livewire($block['component'], $block['props'] ?? [])
            @endforeach

            @foreach ($page->content ?? [] as $contentblock)
                @php
                    $type = $contentblock['type'] ?? null;
                    $data = $contentblock['data'] ?? [];
                    $view = $type ? cms_block_view($type) : null;
                @endphp

                @if ($view)
                    @include($view, ['data' => $data, 'page' => $page, 'settings' => $settings ?? null])
                @endif
            @endforeach
        </div>
    </section>
@endsection
