<div class="flex justify-center my-5 text-gray-800">
    <div class="w-64" drag-root>

        @foreach ($users as $user)
            <div drag-item="{{ $user->id }}" draggable="true" wire:key="{{ $user->id }}" class="p-2 my-1 bg-white border border-green-500 rounded">
                {{ $user->name }}
            </div>
        @endforeach
    </div>
</div>
