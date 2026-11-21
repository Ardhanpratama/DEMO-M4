<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FlipPlay - Laravel 12</title>
        @if (file_exists(public_path('build/manifest.json')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-[#141414] text-white antialiased">
        <main class="flex min-h-screen items-center justify-center px-6">
            <section class="w-full max-w-2xl rounded-2xl border border-white/10 bg-[#1f1f1f] p-8 text-center shadow-2xl">
                <p class="text-sm font-bold uppercase tracking-widest text-red-500">FlipPlay API</p>
                <h1 class="mt-3 text-4xl font-black">Laravel 12.73.0</h1>
                <p class="mt-4 text-slate-300">
                    Framework ini sudah dikonfigurasi untuk API Media dan Koleksi Pengguna.
                </p>

                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="/api/media"
                       class="rounded-lg bg-red-600 px-5 py-3 font-bold transition hover:bg-red-700">
                        Buka API Media
                    </a>
                    <a href="/api/user"
                       class="rounded-lg border border-white/20 px-5 py-3 font-bold transition hover:border-white/50">
                        Endpoint User
                    </a>
                </div>

                <p class="mt-8 text-xs text-slate-400">
                    PHP {{ PHP_VERSION }}
                </p>
            </section>
        </main>
    </body>
</html>
