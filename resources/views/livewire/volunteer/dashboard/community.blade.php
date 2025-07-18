<x-volunteer.dashboard-layout>
    <main class="relative z-10 px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-4xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="text-center space-y-6">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500/10 to-green-600/10 text-blue-600 rounded-full text-sm font-medium shadow-lg backdrop-blur-sm border border-blue-500/20">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Connect with Volunteers
                </div>
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl font-bold text-gray-800 leading-tight relative">
                        Community <span class="bg-gradient-to-r from-blue-500 to-green-600 bg-clip-text text-transparent">Space</span>
                        <svg class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-40 h-4 text-blue-500/30" viewBox="0 0 100 12" fill="none">
                            <path d="M2 6C20 1 40 1 50 6C60 11 80 11 98 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Join discussions and share ideas for events and projects
                    </p>
                </div>
            </div>

            <!-- Volunteer Discussions Section -->
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 via-green-500/10 to-gray-800/20 rounded-3xl transform rotate-1 group-hover:rotate-0 transition-transform duration-300"></div>
                <div class="relative bg-white/95 backdrop-blur-lg rounded-3xl p-8 shadow-xl border border-white/50">
                    <h2 class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-blue-500 bg-clip-text text-transparent mb-4">Volunteer Discussions</h2>
                    <p class="text-gray-600 mb-4">Share updates and ideas for events and projects</p>
                    <div class="space-y-4">
                        <label class="relative block">
                            <input id="nameInput" type="text" placeholder="Your Name" class="input input-md w-full bg-gray-50 border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-500/20 transition-all duration-200" />
                        </label>
                        <label class="relative block">
                            <input id="eventInput" type="text" placeholder="Event/Project Name" class="input input-md w-full bg-gray-50 border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-500/20 transition-all duration-200" />
                        </label>
                        <div class="flex flex-col space-y-4">
                            <textarea id="messageInput" placeholder="Your Message" class="textarea textarea-md w-full bg-gray-50 border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-500/20 transition-all duration-200" rows="4"></textarea>
                            <button onclick="postMessage()" class="btn bg-accent text-white px-4 py-2 rounded-md hover:from-blue-600 hover:to-green-700 transition-all duration-200">Post Message</button>
                        </div>
                    </div>
                    <div id="discussionThread" class="mt-6 space-y-4 max-h-96 overflow-y-auto">
                        <!-- Messages will be appended here -->
                    </div>
                </div>
            </div>

            <!-- Past Discussions Section -->
            <div class="relative group">
                <div class="relative bg-white/95 backdrop-blur-lg rounded-3xl shadow-xl overflow-hidden">
                    <div class="bg-blue-500/10 px-8 py-6 border-b border-gray-100">
                        <h2 class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-blue-500 bg-clip-text text-transparent">Past Discussions</h2>
                        <p class="text-gray-600 mt-1">Review previous event and project discussions</p>
                    </div>
                    <div class="overflow-x-auto">
                        <table id="pastDiscussionTable" class="table w-full">
                            <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                                <th class="px-8 py-4 text-left font-semibold text-gray-800">Volunteer</th>
                                <th class="px-8 py-4 text-left font-semibold text-gray-800">Event/Project</th>
                                <th class="px-8 py-4 text-left font-semibold text-gray-800">Message</th>
                                <th class="px-8 py-4 text-left font-semibold text-gray-800">Date</th>
                            </tr>
                            </thead>
                            <tbody id="pastDiscussionBody" class="divide-y divide-gray-100">
                            <!-- Past discussion entries will be appended here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>


</x-volunteer.dashboard-layout>
