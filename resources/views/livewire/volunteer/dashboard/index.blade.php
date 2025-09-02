<x-volunteer.dashboard-layout>
    <div class="p-8 bg-gradient-to-br from-gray-100 via-white to-gray-50 min-h-screen">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Campaign Overview -->
            <div
                class="bg-white rounded-2xl shadow-lg p-8 flex flex-col justify-between border border-gray-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Campaign Overview</h2>
                    <div class="flex gap-2">
                        <i data-lucide="facebook" class="text-blue-600"></i>
                        <i data-lucide="twitter" class="text-sky-400"></i>
                        <i data-lucide="youtube" class="text-red-600"></i>
                    </div>
                </div>
                <div class="text-4xl font-extrabold text-primary mb-2">65 <span
                        class="text-base font-normal text-gray-400">Active</span></div>
                <div class="flex justify-between text-sm text-gray-400 mb-4">
                    <span>56 Pending</span>
                    <span>45 Cancel</span>
                    <span>75% Success rate</span>
                </div>
                <input type="text"
                    class="mt-2 w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-primary"
                    placeholder="Search Campaign" />
            </div>
            <!-- Mail Statistic -->
            <div
                class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center justify-center border border-gray-100 hover:shadow-xl transition-shadow">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Mail Statistic</h2>
                <!-- Pie Chart Placeholder -->
                <svg width="90" height="90" viewBox="0 0 32 32" class="mb-4">
                    <circle r="16" cx="16" cy="16" fill="#f3f4f6" />
                    <path d="M16 16 L16 0 A16 16 0 0 1 32 16 Z" fill="#34d399" />
                    <path d="M16 16 L32 16 A16 16 0 0 1 16 32 Z" fill="#fbbf24" />
                    <path d="M16 16 L16 32 A16 16 0 0 1 0 16 Z" fill="#ef4444" />
                </svg>
                <div class="flex flex-col gap-1 text-sm">
                    <span class="text-green-500 font-medium">Sent: 128 Mails</span>
                    <span class="text-yellow-500 font-medium">Pending: 24</span>
                    <span class="text-red-500 font-medium">Cancel: 10</span>
                </div>
            </div>
            <!-- Traffic Effectives -->
            <div
                class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center justify-center border border-gray-100 hover:shadow-xl transition-shadow">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Traffic Effectives</h2>
                <!-- Donut Chart Placeholder -->
                <svg width="90" height="90" viewBox="0 0 32 32" class="mb-4">
                    <circle r="14" cx="16" cy="16" fill="#e5e7eb" />
                    <path d="M16 16 L16 2 A14 14 0 0 1 30 16 Z" fill="#3b82f6" />
                    <path d="M16 16 L30 16 A14 14 0 0 1 16 30 Z" fill="#10b981" />
                    <path d="M16 16 L16 30 A14 14 0 0 1 2 16 Z" fill="#f59e42" />
                </svg>
                <div class="flex gap-4 text-sm">
                    <span class="text-blue-500 font-medium">Paid: 70%</span>
                    <span class="text-green-500 font-medium">Direct: 24%</span>
                    <span class="text-yellow-500 font-medium">Organic: 12%</span>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
         <div class="grid grid-rows-1 md:grid-rows-3 gap-8 col-span-1">
            <!-- Impression Cards -->
            <div
                class="bg-white rounded-2xl shadow-lg p-8 flex flex-col gap-3 border border-gray-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-3 mb-2">
                    <i data-lucide="activity" class="text-blue-500"></i>
                    <span class="font-bold text-gray-700">Ad Name GOCA #30</span>
                    <span class="ml-auto text-green-500 text-xs font-semibold">Active</span>
                </div>
                <div class="text-3xl font-extrabold text-primary">245k</div>
                <div class="text-sm text-gray-400">Impressions</div>
                <div class="w-full h-8 bg-gradient-to-r from-green-400 to-blue-400 rounded-lg"></div>
                <div class="text-xs text-gray-300">Jan 24-26 2023</div>
            </div>
            <div
                class="bg-white rounded-2xl shadow-lg p-8 flex flex-col gap-3 border border-gray-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-3 mb-2">
                    <i data-lucide="activity" class="text-blue-500"></i>
                    <span class="font-bold text-gray-700">Ad Name FACA #24</span>
                    <span class="ml-auto text-green-500 text-xs font-semibold">Active</span>
                </div>
                <div class="text-3xl font-extrabold text-primary">558k</div>
                <div class="text-sm text-gray-400">Impressions</div>
                <div class="w-full h-8 bg-gradient-to-r from-yellow-400 to-green-400 rounded-lg"></div>
                <div class="text-xs text-gray-300">Jan 24-26 2023</div>
            </div>
            <div
                class="bg-white rounded-2xl shadow-lg p-8 flex flex-col gap-3 border border-gray-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-3 mb-2">
                    <i data-lucide="activity" class="text-blue-500"></i>
                    <span class="font-bold text-gray-700">Ad Name VOCA #20</span>
                    <span class="ml-auto text-green-500 text-xs font-semibold">Active</span>
                </div>
                <div class="text-3xl font-extrabold text-primary">412k</div>
                <div class="text-sm text-gray-400">Impressions</div>
                <div class="w-full h-8 bg-gradient-to-r from-blue-400 to-yellow-400 rounded-lg"></div>
                <div class="text-xs text-gray-300">Jan 24-26 2023</div>
            </div>
        </div>
        <div class="col-span-2">
          <div class="grid grid-rows-1 md:grid-rows-2 gap-8 mb-8 ">
            <!-- Engagement Analytics -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold text-gray-700">Engagement Analytics</h2>
                        <div class="flex gap-2">
                        <select
                            class="border border-gray-200 rounded-lg px-2 py-1 text-sm focus:ring-2 focus:ring-primary">
                            <option>Social media</option>
                            <option>Email</option>
                        </select>
                        <select
                            class="border border-gray-200 rounded-lg px-2 py-1 text-sm focus:ring-2 focus:ring-primary">
                            <option>Monthly</option>
                            <option>Weekly</option>
                        </select>
                    </div>
                </div>
                <!-- Bar Chart Placeholder -->
                <div class="flex items-end gap-3 h-36 mt-6">
                    <div class="bg-green-400 w-5 h-20 rounded-lg hover:scale-105 transition-transform"></div>
                    <div class="bg-blue-400 w-5 h-28 rounded-lg hover:scale-105 transition-transform"></div>
                    <div class="bg-yellow-400 w-5 h-24 rounded-lg hover:scale-105 transition-transform"></div>
                    <div class="bg-green-400 w-5 h-32 rounded-lg hover:scale-105 transition-transform"></div>
                    <div class="bg-blue-400 w-5 h-16 rounded-lg hover:scale-105 transition-transform"></div>
                    <div class="bg-yellow-400 w-5 h-28 rounded-lg hover:scale-105 transition-transform"></div>
                    <div class="bg-green-400 w-5 h-24 rounded-lg hover:scale-105 transition-transform"></div>
                    <div class="bg-blue-400 w-5 h-32 rounded-lg hover:scale-105 transition-transform"></div>
                    <div class="bg-yellow-400 w-5 h-20 rounded-lg hover:scale-105 transition-transform"></div>
                </div>
                <div class="flex justify-between text-sm mt-4 text-gray-400">
                    <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span><span>Jul</span><span>Aug</span><span>Sep</span>
                </div>
            </div>
            <!-- Schedule Table -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Schedule</h2>
                    <button class="text-xs px-3 py-1 bg-primary text-white rounded-lg shadow">Export</button>
                </div>
                <table class="w-full text-sm rounded-lg overflow-hidden">
                    <thead>
                        <tr class="text-gray-500 bg-gray-50">
                            <th class="py-2">No</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Date & Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="py-2">01</td>
                            <td>Social Ads</td>
                            <td><span class="text-green-500 font-semibold">Active</span></td>
                            <td>01.12.23</td>
                            <td><button class="text-xs text-primary underline">View</button></td>
                        </tr>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="py-2">02</td>
                            <td>Email</td>
                            <td><span class="text-yellow-500 font-semibold">Pending</span></td>
                            <td>01.12.23</td>
                            <td><button class="text-xs text-primary underline">View</button></td>
                        </tr>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="py-2">03</td>
                            <td>Social Ads</td>
                            <td><span class="text-red-500 font-semibold">Cancel</span></td>
                            <td>01.12.23</td>
                            <td><button class="text-xs text-primary underline">View</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
          
        </div>

       
        </div>

       
    </div>
</x-volunteer.dashboard-layout>
