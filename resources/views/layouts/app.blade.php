<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        @stack('scripts')

        <script>
            let root = document.querySelector('[drag-root]');
            root.querySelectorAll('[drag-item]').forEach(el => {


                el.addEventListener('dragstart', e => {
                    e.target.setAttribute('dragging', true)
                    console.log('drag start');
                })
                el.addEventListener('dragenter', e => {
                    e.target.classList.add('bg-yellow-400')

                    e.preventDefault();
                })
                el.addEventListener('drop', e => {
                    e.target.classList.remove('bg-yellow-400')

                    let draggingEl = root.querySelector('[dragging]')

                    e.target.before(draggingEl);

                    console.log(e.target.closest('[wire\\:id]').getAttribute('wire:id'));
                    let component = Livewire.find(
                        e.target.closest('[wire\\:id]').getAttribute('wire:id')
                    )
                    console.log(root.querySelectorAll('[drag-item]'));

                    let ids =  Array.from(root.querySelectorAll('[drag-item]')).map(itemEl => itemEl.getAttribute('drag-item'))

                    component.call('reorder', ids);


                    console.log('drag drop');
                })
                el.addEventListener('dragover', e => {

                    e.preventDefault();
                })
                el.addEventListener('dragleave', e => {
                    e.target.classList.remove('bg-yellow-400')
                    console.log('drag leave');
                })
                el.addEventListener('dragend', e => {
                    e.target.removeAttribute('dragging', true)
                    console.log('drag end');
                })


            })
        </script>
    </body>
</html>
