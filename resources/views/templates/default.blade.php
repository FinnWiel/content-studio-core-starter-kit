{{--
Template Name: Default
Template Key: default
Description: Default fallback template
Regions: content
--}}

@extends($layout)

@section('content')
    <div class="overflow-x-clip lg:overflow-x-visible">
        @foreach (($pageBlocks['content'] ?? []) as $block)
            @livewire($block['component'], $block['props'] ?? [])
        @endforeach

        @foreach (($page->content ?? []) as $contentblock)
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
@endsection
