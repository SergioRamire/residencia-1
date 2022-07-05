<div class="overflow-x-auto">
    <div class="pb-1.5 align-middle inline-block min-w-full">
        <div class="shadow-md overflow-hidden border border-[#1b396a] rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                <tr>
                    {{ $head }}
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    {{ $slot }}
                </tbody>
            </table>
        </div>
    </div>
</div>
