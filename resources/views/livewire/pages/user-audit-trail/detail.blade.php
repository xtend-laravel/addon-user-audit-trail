<div class="flex-col space-y-4">
    <div class="flex items-center justify-between">
        <strong class="text-lg font-bold md:text-2xl">
            {{ __('Details') }}
        </strong>
    </div>

    <pre class="text-sm font-mono bg-gray-100 p-4 rounded-lg shadow-inner overflow-x-auto">
        @php print_r($userAuditTrail->toArray()) @endphp
    </pre>
</div>
