<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-md flex-col gap-6">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex h-9 w-9 items-center justify-center rounded-md">
                        <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                    </span>

                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>

                <div class="flex flex-col gap-6">
                    <div class="rounded-xl border bg-white dark:bg-stone-950 dark:border-stone-800 text-stone-800 shadow-xs">
                        <div class="px-10 py-8">
                            <div class="flex justify-end mb-3">
                                <button type="button" data-theme-toggle aria-label="Toggle theme"
                                        class="rounded-full p-2 hover:bg-gray-100 dark:hover:bg-stone-900 transition text-gray-700 dark:text-gray-200">
                                    <svg class="h-5 w-5 dark:hidden" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M17.293 13.293A8 8 0 116.707 2.707a8.001 8.001 0 1010.586 10.586z" /></svg>
                                    <svg class="h-5 w-5 hidden dark:inline" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-4 7a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM3 9a1 1 0 100 2H2a1 1 0 100-2h1zm15 0a1 1 0 100 2h-1a1 1 0 100-2h1zM4.222 4.222a1 1 0 011.415 0l.708.708a1 1 0 11-1.414 1.414l-.709-.708a1 1 0 010-1.414zM15.656 15.656a1 1 0 011.415 0l.708.708a1 1 0 11-1.414 1.414l-.709-.708a1 1 0 010-1.414zM15.657 4.222a1 1 0 010 1.415l-.708.708a1 1 0 11-1.415-1.414l.709-.709a1 1 0 011.414 0zM4.222 15.657a1 1 0 010 1.415l-.708.708A1 1 0 112.1 16.365l.709-.709a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                </button>
                            </div>
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
