@props(['maxWidth' => 's2xl'])
<x-jet-modal :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="text-lg">
            {{ $title }}
        </div>
        <div class="mt-4">
            {{ $content }}
        </div>
    </div>
    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-jet-modal>
