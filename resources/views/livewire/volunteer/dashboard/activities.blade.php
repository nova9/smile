<x-volunteer.dashboard-layout>
    <div class="flex flex-col gap-4 mt-10">

        <h1 class="text-2xl font-bold text-primary text-center">
            My Activities
        </h1>
        <!-- name of each tab group should be unique -->
        <div class="tabs tabs-lift">
            <label class="tab flex gap-1">
                <input type="radio" name="my_tabs_4" />
                <i data-lucide="timer" class="size-4 "></i>
                Time Tracking
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6">
                Hours History
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th></th>
                            <th>Date</th>
                            <th>Activity</th>
                            <th>Hours</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- row 1 -->
                        <tr class="bg-base-200">
                            <th>1</th>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                        </tr>
                        <!-- row 2 -->
                        <tr>
                            <th>2</th>
                            <td>Hart Hagerty</td>
                            <td>Desktop Support Technician</td>
                            <td>Purple</td>
                        </tr>
                        <!-- row 3 -->
                        <tr>
                            <th>3</th>
                            <td>Brice Swyre</td>
                            <td>Tax Accountant</td>
                            <td>Red</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="my_tabs_4" checked="checked" />
                <i data-lucide="shield-check"></i>
                Certificates
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6">
                Certificates (view/download digital certificates)
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Event</th>
                            <th class="flex justify-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- row 1 -->
                        <tr class="bg-base-200">
                            <th>1</th>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td class="flex justify-end">
                                <a href="certificates/cy_ganderton_certificate.pdf" target="_blank" class="btn btn-sm btn-primary mr-2">View</a>
                            </td>
                        </tr>
                        <!-- row 2 -->
                        <tr>
                            <th>2</th>
                            <td>Hart Hagerty</td>
                            <td>Desktop Support Technician</td>
                            <td class="flex justify-end">
                                <a href="certificates/hart_hagerty_certificate.pdf" target="_blank" class="btn btn-sm btn-primary mr-2">View</a>
                            </td>
                        </tr>
                        <!-- row 3 -->
                        <tr>
                            <th>3</th>
                            <td>Brice Swyre</td>
                            <td>Tax Accountant</td>
                            <td class="flex justify-end">
                                <a href="certificates/brice_swyre_certificate.pdf" target="_blank" class="btn btn-sm btn-primary mr-2">View</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <label class="tab flex gap-1">
                <input type="radio" name="my_tabs_4" />
                <i data-lucide="award"></i>
                Badges & Points
            </label>
            <div class="tab-content bg-base-100 border-base-300 p-6">
                Badges & Points (view earned badges, points, leaderboard rank)
                <div class="flex gap-3">
                    <div class="card bg-base-100 w-96 shadow-sm">
                        <figure>
                            <img
                                src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                                alt="Shoes" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">Card Title</h2>
                            <p>A card component has a figure, a body part, and inside body there are title and actions parts</p>
                            <div class="card-actions justify-end">
                                <button class="btn btn-primary">Buy Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Job</th>
                                <th>Favorite Color</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th>1</th>
                                <td>Cy Ganderton</td>
                                <td>Quality Control Specialist</td>
                                <td>Blue</td>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th>2</th>
                                <td>Hart Hagerty</td>
                                <td>Desktop Support Technician</td>
                                <td>Purple</td>
                            </tr>
                            <!-- row 3 -->
                            <tr>
                                <th>3</th>
                                <td>Brice Swyre</td>
                                <td>Tax Accountant</td>
                                <td>Red</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-volunteer.dashboard-layout>
