<div class="flex-col space-y-4">
    <div class="flex items-center justify-between">
        <strong class="text-lg font-bold md:text-2xl">
            {{ __('Details') }}
        </strong>
    </div>



    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Route name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Visits
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Duration
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Last visit at
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($userAuditTrail->route_tracking as $routeTracking)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $routeTracking['route'] }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $routeTracking['type'] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $routeTracking['visits'] }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $routeTracking['totalDuration'] }}s
                    </td>
                    <td class="px-6 py-4">
                        {{ Carbon\Carbon::parse($routeTracking['lastTrackedAt'])->format('m/d/Y h:i a') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
