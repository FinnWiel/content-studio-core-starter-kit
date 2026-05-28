<section>
    <div class="flex justify-between items-center border border-slate-200 bg-slate-50 p-4 text-sm text-slate-700">
        <div>
            <h2 class="text-2xl font-bold">{{ $data['heading'] }}</h2>
            <p class="max-w-lg">{{ $data['message'] }}</p>
        </div>
        <a href="/admin" target="_blank"
            class="group bg-amber-500 px-3 py-2 text-sm font-medium text-white hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 cursor-pointer flex items-center gap-3">

            <p>Explore the Admin panel</p>

            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-arrow-up-right transition-transform duration-200 group-hover:-translate-y-0.5 group-hover:translate-x-0.5">

                <path d="M7 7h10v10" />
                <path d="M7 17 17 7" />
            </svg>
        </a>
    </div>
</section>
