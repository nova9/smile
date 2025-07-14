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
       </div>
{{--       cards--}}
       <div class="flex flex-col items-center">

           <div class="carousel carousel-end rounded-box flex gap-5 my-10">
               <div class="carousel-item">
                   <div class="card bg-base-100 w-96 shadow-sm">
                       <figure>
                           <img
                               src="{{asset('storage/assets/secondplace.png')}}"
                               alt="2" />
                       </figure>
                       <div class="card-body">
                           <div class="flex">

                               <h2 class="card-title">Noufa Nuzurath</h2>
                               <div class="avatar">
                                   <div class="ring-primary ring-offset-base-100 w-24 rounded-full ring-2 ring-offset-2">
                                       <img src="https://img.daisyui.com/images/profile/demo/spiderperson@192.webp" />
                                   </div>
                               </div>
                           </div>
                           <p>A card component has a figure, a body part, and inside body there are title and actions parts</p>
                           <div class="card-actions justify-end">
                           </div>
                       </div>
                   </div>
               </div>
               <div class="carousel-item">
                   <div class="card bg-base-100 w-96 shadow-sm">
                       <figure>
                           <img
                               src="{{asset('storage/assets/firstplace.png')}}"
                               alt="1" />
                       </figure>
                       <div class="card-body">
                           <h2 class="card-title">Thathsara madusha</h2>
                           <p>A card component has a figure, a body part, and inside body there are title and actions parts</p>
                           <div class="card-actions justify-end">
                           </div>
                       </div>
                   </div>
               </div>
               <div class="carousel-item">
                   <div class="card bg-base-100 w-96 shadow-sm">
                       <figure>
                           <img
                               src="{{asset('storage/assets/thirdplace.png')}}"
                               alt="3" />
                       </figure>
                       <div class="card-body">
                           <h2 class="card-title">Nethmi Nimansa</h2>
                           <p>A card component has a figure, a body part, and inside body there are title and actions parts</p>
                           <div class="card-actions justify-end">
                           </div>
                       </div>
                   </div>
               </div>

           </div>
       </div>
{{--       table--}}
       <div class="flex gap-3 my-10 items-center text-lg font-bold text-gray-600 leading-tight text-center">
           <div>
               Filter by
           </div>
           <div class="filter">
               <input class="btn filter-reset" type="radio" name="metaframeworks" aria-label="All"/>
               <input class="btn" type="radio" name="metaframeworks" aria-label="Monthly"/>
               <input class="btn" type="radio" name="metaframeworks" aria-label="Yearly"/>
           </div>
       </div>

       <div>
           <div class="overflow-x-auto">
               <table class="table">
                   <!-- head -->
                   <thead>
                   <tr>
                       <th class="p-3 text-left">Rank</th>
                       <th class="p-3 text-left">Volunteer</th>
                       <th class="p-3 text-left">Points</th>
                       <th class="p-3 text-left">Level</th>
                       <th class="p-3 text-left">Hours</th>
                       <th class="p-3 text-left">Badges</th>
                   </tr>
                   </thead>
                   <tbody>
                   <!-- row 1 -->
                   <tr>
                       <td>
                           <div class="text-4xl font-thin opacity-30 tabular-nums">01</div>
                       </td>
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
                           <div class="text-4xl font-thin opacity-30 tabular-nums">01</div>
                       </td>
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
                           <div class="text-4xl font-thin opacity-30 tabular-nums">01</div>
                       </td>
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
                           <div class="text-4xl font-thin opacity-30 tabular-nums">01</div>
                       </td>
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
