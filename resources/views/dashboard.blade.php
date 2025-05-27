<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight flex items-center">
            <i class="fas fa-tachometer-alt mr-2"></i>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Quick Stats Card -->
                <div class="sport-card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Quick Stats</h3>
                        <i class="fas fa-chart-line text-blue-600 text-xl"></i>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Your Activities</span>
                            <span class="text-blue-600 font-semibold">12</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Progress</span>
                            <span class="text-green-600 font-semibold">85%</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Card -->
                <div class="sport-card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Recent Activity</h3>
                        <i class="fas fa-clock text-blue-600 text-xl"></i>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <i class="fas fa-running text-green-500 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-600">Last workout completed</p>
                                <p class="text-sm font-semibold">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-trophy text-yellow-500 mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-600">Achievement unlocked</p>
                                <p class="text-sm font-semibold">Weekly Goal Reached</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Goals Card -->
                <div class="sport-card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Your Goals</h3>
                        <i class="fas fa-bullseye text-blue-600 text-xl"></i>
                    </div>
                    <div class="space-y-4">
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div>
                                    <span class="text-xs font-semibold inline-block text-blue-600">
                                        Weekly Progress
                                    </span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-semibold inline-block text-blue-600">
                                        75%
                                    </span>
                                </div>
                            </div>
                            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-200">
                                <div style="width:75%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-600"></div>
                            </div>
                        </div>
                        <a href="#" class="btn-sport inline-flex items-center justify-center w-full">
                            <i class="fas fa-plus mr-2"></i>
                            Set New Goal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
