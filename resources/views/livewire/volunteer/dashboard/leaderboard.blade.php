<x-volunteer.dashboard-layout>
{{-- main--}}
   <div>
       {{--    heading--}}
       <div class="flex flex-col items-center gap-2">
           <div class="text-3xl xl:text-5xl font-bold text-primary leading-tight text-center">
               Smile Volunteer Leaderboard
           </div>
           <div class="text-lg font-bold text-gray-600 leading-tight text-center">
               Celebrating Our Top Volunteers!
           </div>
           <div class="filter">
               <input class="btn filter-reset" type="radio" name="metaframeworks" aria-label="All"/>
               <input class="btn" type="radio" name="metaframeworks" aria-label="Monthly"/>
               <input class="btn" type="radio" name="metaframeworks" aria-label="Yearly"/>
           </div>
       </div>
{{--       cards--}}
       <div class="flex flex-col items-center">
           <div class="carousel carousel-end rounded-box flex gap-5 my-10">
               <div class="carousel-item">
                   <img src="https://img.daisyui.com/images/stock/photo-1559703248-dcaaec9fab78.webp" alt="Drink" />
               </div>
               <div class="carousel-item">
                   <img
                       src="https://img.daisyui.com/images/stock/photo-1565098772267-60af42b81ef2.webp"
                       alt="Drink" />
               </div>
               <div class="carousel-item">
                   <img
                       src="https://img.daisyui.com/images/stock/photo-1572635148818-ef6fd45eb394.webp"
                       alt="Drink" />
               </div>

           </div>
       </div>
{{--       table--}}
       <div>
           <div class="overflow-x-auto">
               <table class="table">
                   <!-- head -->
                   <thead>
                   <tr>
                       <th>Name</th>
                       <th>Job</th>
                       <th>Favorite Color</th>
                       <th></th>
                   </tr>
                   </thead>
                   <tbody>
                   <!-- row 1 -->
                   <tr>
                       <td>
                           <div class="flex items-center gap-3">
                               <div class="avatar">
                                   <div class="mask mask-squircle h-12 w-12">
                                       <img
                                           src="https://img.daisyui.com/images/profile/demo/2@94.webp"
                                           alt="Avatar Tailwind CSS Component" />
                                   </div>
                               </div>
                               <div>
                                   <div class="font-bold">Hart Hagerty</div>
                                   <div class="text-sm opacity-50">United States</div>
                               </div>
                           </div>
                       </td>
                       <td>
                           Zemlak, Daniel and Leannon
                           <br />
                           <span class="badge badge-ghost badge-sm">Desktop Support Technician</span>
                       </td>
                       <td>Purple</td>
                       <th>
                           <button class="btn btn-ghost btn-xs">details</button>
                       </th>
                   </tr>
                   <!-- row 2 -->
                   <tr>
                       <td>
                           <div class="flex items-center gap-3">
                               <div class="avatar">
                                   <div class="mask mask-squircle h-12 w-12">
                                       <img
                                           src="https://img.daisyui.com/images/profile/demo/3@94.webp"
                                           alt="Avatar Tailwind CSS Component" />
                                   </div>
                               </div>
                               <div>
                                   <div class="font-bold">Brice Swyre</div>
                                   <div class="text-sm opacity-50">China</div>
                               </div>
                           </div>
                       </td>
                       <td>
                           Carroll Group
                           <br />
                           <span class="badge badge-ghost badge-sm">Tax Accountant</span>
                       </td>
                       <td>Red</td>
                       <th>
                           <button class="btn btn-ghost btn-xs">details</button>
                       </th>
                   </tr>
                   <!-- row 3 -->
                   <tr>
                       <td>
                           <div class="flex items-center gap-3">
                               <div class="avatar">
                                   <div class="mask mask-squircle h-12 w-12">
                                       <img
                                           src="https://img.daisyui.com/images/profile/demo/4@94.webp"
                                           alt="Avatar Tailwind CSS Component" />
                                   </div>
                               </div>
                               <div>
                                   <div class="font-bold">Marjy Ferencz</div>
                                   <div class="text-sm opacity-50">Russia</div>
                               </div>
                           </div>
                       </td>
                       <td>
                           Rowe-Schoen
                           <br />
                           <span class="badge badge-ghost badge-sm">Office Assistant I</span>
                       </td>
                       <td>Crimson</td>
                       <th>
                           <button class="btn btn-ghost btn-xs">details</button>
                       </th>
                   </tr>
                   <!-- row 4 -->
                   <tr>
                       <td>
                           <div class="flex items-center gap-3">
                               <div class="avatar">
                                   <div class="mask mask-squircle h-12 w-12">
                                       <img
                                           src="https://img.daisyui.com/images/profile/demo/5@94.webp"
                                           alt="Avatar Tailwind CSS Component" />
                                   </div>
                               </div>
                               <div>
                                   <div class="font-bold">Yancy Tear</div>
                                   <div class="text-sm opacity-50">Brazil</div>
                               </div>
                           </div>
                       </td>
                       <td>
                           Wyman-Ledner
                           <br />
                           <span class="badge badge-ghost badge-sm">Community Outreach Specialist</span>
                       </td>
                       <td>Indigo</td>
                       <th>
                           <button class="btn btn-ghost btn-xs">details</button>
                       </th>
                   </tr>
                   </tbody>
               </table>
           </div>
       </div>
   </div>


{{--    - **Leaderboard Table**:--}}
{{--    - Columns: Rank, Volunteer (clickable to profile), Points, Level (Bronze/Silver/Gold), Hours, Badges, Feedback (e.g., 4.8/5).--}}
{{--    - Responsive design: Table for desktop (`w-full border-collapse`), cards for mobile (`flex flex-col`).--}}
{{--    - Alternating row colors (`bg-gray-50`) and hover effects (`hover:bg-gray-100`).--}}
{{--    - Livewire for real-time updates when filters change.--}}

{{--    - **Visual Indicators**:--}}
{{--    - Badges via Blade Icons (e.g., `icon-star`, `icon-trophy`) for achievements.--}}
{{--    - Level badges (e.g., `bg-yellow-500 text-white` for Gold).--}}
{{--    - “New Entry” or “Top Mover” tags (`bg-green-200 text-green-800`).--}}
{{--    - Progress bars for points to next level (`bg-blue-600` fill).--}}

{{--    - **Sidebar/Call-to-Action (Optional)**:--}}
{{--    - Buttons: “View My Profile,” “Explore Opportunities” (`bg-blue-600 text-white rounded-md`).--}}
{{--    - Motivational message: “Join the top volunteers!” (`text-gray-700 italic`).--}}

{{--    - **Footer Section**:--}}
{{--    - Timestamp: “Last Updated: [Date]” (`text-sm text-gray-500`).--}}
{{--    - Link to rules: “How are points calculated?” (`text-blue-600 hover:underline`).--}}

{{--    - **Accessibility Features**:--}}
{{--    - ARIA labels (e.g., `aria-label="Select timeframe"`).--}}
{{--    - Keyboard-navigable dropdowns and buttons.--}}
{{--    - WCAG 2.1 AA-compliant colors and contrast (Tailwind CSS).--}}

{{--    - **Technical Features**:--}}
{{--    - Laravel Blade for initial rendering.--}}
{{--    - Livewire for dynamic updates (e.g., filter changes).--}}
{{--    - Alpine.js for client-side interactions (e.g., toggles, modals).--}}
{{--    - Redis caching for performance (leaderboard data).--}}
{{--    - Responsive design with Tailwind CSS (`sm:`, `md:`, `lg:` breakpoints).--}}
</x-volunteer.dashboard-layout>
