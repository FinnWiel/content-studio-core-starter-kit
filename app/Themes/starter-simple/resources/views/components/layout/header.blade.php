<header class="border-b border-slate-200 bg-slate-50">
    <div class="mx-auto flex w-full max-w-5xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ url('/') }}" class="text-sm font-semibold tracking-wide text-slate-900">
            {{ config('app.name') }}
        </a>

        <nav class="flex items-center gap-4 text-sm text-slate-600">
            <a href="{{ url('/') }}" class="hover:text-slate-900">Home</a>
        </nav>
    </div>
</header>
