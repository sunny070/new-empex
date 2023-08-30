@extends('layouts.web.app')

@section('title', 'Welcome to Employment Exchange')

@section('navbar')
    @parent
@endsection

@section('content')
    {{-- carousel --}}
    <div class="py-5">
        <div class="flex overflow-x-hidden">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="content-center md:flex-wrap md:flex order-2 md:order-1 mt-10 md:mt-0">
                        <div>
                            <span class="font-semibold text-2xl md:text-3xl">Apply for employment index card and browse
                                jobs</span>
                            <div class="empex mt-2 md:mt-5"></div>


                        </div>

                        <div class="flex max-w-1xl mt-4 md:mt-10">

                            <img class="w-96" src="/images/lesde_logo.jpg" alt="lesde_logo">
                        </div>

                        <div
                            class="mt-2 pa-2 md:mt-10 sm:flex sm:justify-between justsify-around md:justify-between mdd:w-5/6">
                            <div>
                                <a href="#" class="flex p-2 hover:bg-empex-gray hover:rounded">
                                    <img src="/images/main/playstore.svg" alt="playstore" class="my-auto">
                                    <div class="ml-3 mt-1 md:mt-0">
                                        {{-- <div class="-mb-1 text-sm">Coming soon</div> --}}
                                        <div class="-mt-1 text-sm">Coming soon</div>
                                        <div class="md:text-1xl  font-semibold">Mobile App</div>
                                    </div>
                                </a>

                                <div class="flex p-2 hover:bg-empex-gray hover:rounded">
                                    <img src="/images/main/contact.svg" alt="playstore" cladss="h-12 w-12 mx-auto">
                                    <div class="ml-3 mt-1 md:mt-0">
                                        {{-- <div class="-mb-1 text-sm">Coming soon</div> --}}
                                        <div class="-mt-1 text-sm ">(Lunglei, Hnahthial)</div>
                                        <div class="md:text-1xl font-semibold">8131-875-533</div>
                                    </div>
                                </div>
                                <div class="flex p-2 hover:bg-empex-gray hover:rounded">
                                    <img src="/images/main/contact.svg" alt="playstore" classs="h-12 w-12 mx-auto">
                                    <div class="ml-3 mt-1 md:mt-0">
                                        {{-- <div class="-mb-1 text-sm">Coming soon</div> --}}
                                        <div class="-mt-1 text-sm">(Champhai, Khawzawl)</div>
                                        <div class="md:text-1xl font-semibold">9233-671-799</div>
                                    </div>
                                </div>
                            </div>


                            <div>
                                <a href="#" class="flex p-2 hover:bg-empex-gray hover:rounded">
                                    <img src="/images/main/contact.svg" alt="playstore" cladss="h-12 w-12 mx-auto">
                                    <div class="ml-3 mt-1 md:mt-0">
                                        {{-- <div class="-mb-1 text-sm">Coming soon</div> --}}
                                        <div class="-mt-1 text-sm">(Aizawl, Kolasib, Mamit, Serchhip, Saitual)</div>
                                        <div class="md:text-1xl  font-semibold">8729-982-569</div>
                                    </div>
                                </a>

                                <div class="flex p-2 hover:bg-empex-gray hover:rounded">
                                    <img src="/images/main/contact.svg" alt="playstore" cladss="h-12 w-12 mx-auto">
                                    <div class="ml-3 mt-1 md:mt-0">
                                        {{-- <div class="-mb-1 text-sm">Coming soon</div> --}}
                                        <div class="-mt-1 text-sm">(Siaha, Lawngtlai)</div>
                                        <div class="md:text-1xl font-semibold">8798-168-493</div>
                                    </div>
                                </div>
                                <div class="flex p-2 hover:bg-empex-gray hover:rounded">
                                    <img src="/images/main/contact.svg" alt="playstore" cladss="h-12 w-12 mx-auto">
                                    <div class="ml-3 mt-1 md:mt-0">
                                        {{-- <div class="-mb-1 text-sm">Coming soon</div> --}}
                                        <div class="-mt-1 text-sm">(Directorate)</div>
                                        <div class="md:text-1xl font-semibold">7085-354-654</div>
                                    </div>
                                </div>
                            </div>



                        </div>




                        {{-- <div class="flex mt-4 md:mt-10">

                            <img src="/images/lesde_logo.jpg" alt="lesde_logo">
                        </div> --}}

                        {{-- <div class="mt-4 md:mt-6">
                            <a href="javascript:void(0)" id="videoTutorialTrigger"
                                class="flex p-2 hover:bg-empex-gray hover:rounded text-empex-green font-semibold">
                                <img src="/images/main/videoTutorial.svg" alt="video tutorial" class="h-6 w-6 mr-1">
                                View Tutorial Video
                            </a>
                        </div> --}}
                    </div>





                    <div class="w-full h-52 md:h-96 2xl:h-auto object-cover order-1 md:order-2">
                        <img class="w-full h-52 md:h-96 2xl:h-auto object-cover order-1 md:order-2" alt="1"
                            src="/images/main/banner.gif" />

                        <div class="text-center mt-3">

                            <button id="videoTutorialTrigger"
                                class="bg-empex-green text-white font-semibold hover:text-white py-2 px-4 border rounded">
                                <svg class="inline" xmlns="http://www.w3.org/2000/svg" width="21.918" height="21.918"
                                    viewBox="0 0 21.918 21.918">
                                    <path data-name="Icon ionic-ios-play-circle"
                                        d="M14.334 3.375a10.959 10.959 0 1 0 10.959 10.959A10.957 10.957 0 0 0 14.334 3.375zm4.415 11.164-7.229 4.374a.234.234 0 0 1-.353-.205V9.961a.233.233 0 0 1 .353-.205l7.229 4.373a.242.242 0 0 1 0 .41z"
                                        transform="translate(-3.375 -3.375)" style="fill:#fff" />
                                </svg>

                                <span>View Tutoral</span>
                            </button>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>

    {{-- <div class="rounded max-w-7xl mx-auto border border-[#f5cb58] bg-[#fdf9ed]">
    <div class="grid grid-cols-8 gap-4">
        <div class="bg-[#f5cb58] p-4">
            <img src="/images/main/info.svg" alt="" class="mx-auto">
        </div>
        <div class="col-span-7 m-auto overflow-hidden">
            <div class="animate-marquee">
                <span>
                    <div class="font-bold">Important Notification!</div>
                    All Job Seekers registering through CSC and District Employment Exchange Offices before 31 Jan, 2023 should update their Employment profile in the EMPEX Portal, including Education, Experience, NCO Code.
                </span>
                <span>
                    <div class="font-bold">Important Notification!</div>
                    All Job Seekers registering through CSC and District Employment Exchange Offices before 31 Jan, 2023 should update their Employment profile in the EMPEX Portal, including Education, Experience, NCO Code.
                </span>
            </div>
        </div>
    </div>

</div> --}}

    <div class="w-full bg-white py-12">
        <div class="max-w-7xl mx-auto px-4">

            {{-- statistics --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
                <div class="text-white rounded border flex w-full">
                    <div class="w-2/3 px-5 py-3 rounded-l" style="background-color: #009726;">
                        <div>
                            <img src="/images/main/registration.svg" alt="register" class="inline">
                            <span class="font-semibold">Registered</span>
                        </div>
                        <div class="text-xl font-bold text-empex-yellow">{{ $totalUsers }}</div>
                        <div class="flex justify-between mt-5">
                            <div>
                                <div class="text-sm font-light" style="color: #b7e8cb;">Aadhaar</div>
                                <div class="font-semibold">{{ $totalAadhaarGender }}</div>
                            </div>
                            <div>
                                <div class="text-sm font-light" style="color: #b7e8cb;">Non-Aadhaar</div>
                                <div class="font-semibold">{{ $totalNonAadhaarGender }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/3 px-5 py-3 rounded-r" style="background-color: #028723;">
                        <div>
                            <div class="text-sm font-light" style="color: #b7e8cb;">Male</div>
                            <div class="-mt-1 font-medium">{{ $totalMaleGender }}</div>
                            <div class="text-sm font-light" style="color: #b7e8cb;">Female</div>
                            <div class="-mt-1 font-medium">{{ $totalFemaleGender }}</div>
                            <div class="text-sm font-light" style="color: #b7e8cb;">Others</div>
                            <div class="-mt-1 font-medium">{{ $totalOtherGender }}</div>
                        </div>
                    </div>
                </div>

                <div class="text-white rounded border flex w-full">
                    <div class="w-2/3 px-5 py-3 rounded-l" style="background-color: #009726;">
                        <div>
                            <img src="/images/main/renew.svg" alt="renew" class="inline">
                            <span class="font-semibold">Renew</span>
                        </div>
                        <div class="text-xl font-bold text-empex-yellow">{{ $totalRenewUsers }}</div>
                        <div class="flex justify-between mt-5">
                            <div>
                                <div class="text-sm font-light" style="color: #b7e8cb;">Aadhaar</div>
                                <div class="font-semibold">{{ $totalRenewAadhaarGender }}</div>
                            </div>
                            <div>
                                <div class="text-sm font-light" style="color: #b7e8cb;">Non-Aadhaar</div>
                                <div class="font-semibold">{{ $totalRenewNonAadhaarGender }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/3 px-5 py-3 rounded-r" style="background-color: #028723;">
                        <div>
                            <div class="text-sm font-light" style="color: #b7e8cb;">Male</div>
                            <div class="-mt-1 font-medium">{{ $totalRenewMaleGender }}</div>
                            <div class="text-sm font-light" style="color: #b7e8cb;">Female</div>
                            <div class="-mt-1 font-medium">{{ $totalRenewFemaleGender }}</div>
                            <div class="text-sm font-light" style="color: #b7e8cb;">Others</div>
                            <div class="-mt-1 font-medium">{{ $totalRenewOtherGender }}</div>
                        </div>
                    </div>
                </div>

                <div class="text-white rounded border flex w-full">
                    <div class="w-2/3 px-5 py-3 rounded-l" style="background-color: #009726;">
                        <div>
                            <img src="/images/main/job.svg" alt="job" class="inline">
                            <span class="font-semibold">Job Post</span>
                        </div>
                        <div class="text-xl font-bold text-empex-yellow">{{ $totalJobs }}</div>
                        <div class="flex justify-between mt-5">
                            <div>
                                <div class="text-sm font-light" style="color: #b7e8cb;">Active</div>
                                <div class="font-semibold">{{ $totalActiveJobs }}</div>
                            </div>
                            <div>
                                <div class="text-sm font-light" style="color: #b7e8cb;">In-Active</div>
                                <div class="font-semibold">{{ $totalInactiveJobs }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/3 px-5 py-3 rounded-r" style="background-color: #028723;">
                        <div>
                            <div class="text-sm font-light" style="color: #b7e8cb;">Govt</div>
                            <div class="-mt-1 font-medium">{{ $totalGovtJobs }}</div>
                            <div class="text-sm font-light" style="color: #b7e8cb;">Private</div>
                            <div class="-mt-1 font-medium">{{ $totalPrivateJobs }}</div>
                            <div class="text-sm font-light" style="color: #b7e8cb;">Public</div>
                            <div class="-mt-1 font-medium">{{ $totalPublicJobs }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- chart/notice board --}}
            <div class="mt-5 grid grid-cols-1 md:grid-cols-3 md:gap-4">
                <div class="col-span-2 border rounded p-5 order-2 md:order-1">
                    <div class="text-3xl font-semibold">NCO Statistics</div>
                    <div class="empex mt-3"></div>
                    <div class="text-gray-400 mt-2">Total Users based on NCO Division</div>
                    <div class="my-5">
                        <canvas id="canvas" height="250" width="600"></canvas>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-8">
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($ncoDivisions->chunk(6) as $division)
                            <div>
                                @foreach ($division as $nco)
                                    <div class="flex mb-2 items-center">
                                        <div class="bg-empex-gray font-semibold text-empex-green text-center w-8 text-sm">
                                            {{ sprintf('%02d', $count) }}
                                        </div>
                                        <div class="text-gray-400 text-sm pl-3">{{ $nco->name }}</div>
                                    </div>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- notice board --}}
                <div class="border rounded p-5 mb-5 md:mb-0 order-1 md:order-2">
                    <div class="text-3xl font-semibold">Notice Board</div>
                    <div class="empex mt-3"></div>
                    <ul class="divide-y mt-5">

                        @forelse ($noticeboards as $notice)
                            <li class="py-3">
                                <a href="/notice/{{ $notice->slug }}"
                                    class="font-normal hover:text-empex-green line-clamp-2">{{ $notice->title }}</a>

                                <br>
                                {{ $notice->content }}
                                <br />
                                <div class="text-gray-400 text-sm mt-3">
                                    <span
                                        class=" pr-2 mr-2 border-gray-300">{{ date('dS M Y', strtotime($notice->created_at)) }}</span>
                                    @if ($notice->file != null)
                                        <a href="{{ asset('storage/' . $notice->file) }}"
                                            class="float-right hover:text-empex-green">
                                            Download
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 inline text-empex-green" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @empty
                            <li>
                                {{-- Notice not found! --}}
                            </li>
                        @endforelse

                        <li class="py-3">
                            <b>Important Notice!</b>
                            <br>
                            Hna zawnglai mek ten CSC kaltlang emaw District Employment
                            Exchange Office a ni 31 Jan 2023 hma a lo in register tawh te chuan an Employment profile Empex
                            Portal ah heng education,
                            experience, NCO Code te hi update tur a ni e
                            <br />
                            <p class="font-light text-gray-500">
                                (All Job Seekers who had registered through CSC and District Employment Exchange Offices
                                before 31 Jan 2023
                                should update their Employment profile in the EMPEX Portal, including Education, Experience,
                                NCO Code.)
                            </p>
                        </li>

                        <li class="py-3">
                            <b>Fees</b>
                            <br>
                            Service Charge - ₹ 20
                            <br>
                            CSC Facilitation Charge - ₹ 30
                        </li>
                        @if (count($noticeboards) > 0)
                            <li class="pt-5">
                                <a href="{{ route('web.notice-board') }}"
                                    class="font-semibold uppercase text-empex-green">view All</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            @guest
                <div class="mt-5 grid grid-cols-1 md:grid-cols-2 md:gap-4">
                    <div class="border rounded p-5 bg-empex-green text-white mb-5 md:mb-0">
                        <div class="flex md:p-5 p-3 justify-between">
                            <div>
                                <div class="font-bold text-xl md:text-2xl mb-2">Hna i zawng em ?</div>
                                <div class="font-light text-lg md:text-xl md:mb-14 mb-5">Are you looking for Jobs?</div>
                                <a href="{{ route('signup') }}">
                                    Register Now
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                            <img src="/images/features/employee.svg" alt="employee" class="h-12 md:h-auto">
                        </div>
                    </div>

                    <div class="border rounded p-5 bg-empex-green text-white">
                        <div class="flex md:p-5 p-3 justify-between">
                            <div>
                                <div class="font-bold text-xl md:text-2xl mb-2">Hnathawk tu tur i zawng em?</div>
                                <div class="font-light text-lg md:text-xl md:mb-14 mb-5">Are you an Employer?</div>
                                <a href="{{ route('register') }}">
                                    Let's Create Job
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                            <img src="/images/features/employer.svg" alt="employer" class="h-12 md:h-auto">
                        </div>
                    </div>
                </div>
            @endguest

            <div class="mt-10 flex justify-center text-2xl md:text-3xl font-semibold" id="videoTutorialPlaceholder">
                Learn how to use EmpEx
            </div>

            <div class="mt-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <iframe width="100%" height="228" src="https://www.youtube.com/embed/GvBmBLphpZc"
                        title="Employment card register dan leh Jobs en dan" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
                <div>
                    <iframe width="100%" height="228" src="https://www.youtube.com/embed/heZjAvzeHNw"
                        title="Job Employer tana hna post dan" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
                <div>
                    <iframe width="100%" height="228" src="https://www.youtube.com/embed/0GkTcwS6VDg"
                        title="Govt. Department hna post dan" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    {{-- features --}}
    <div class="w-full bg-custom-yellow py-12">
        <div class="max-w-7xl mx-auto px-4" style="color: #404040;">
            <div class="text-3xl font-semibold text-center">Features</div>
            <div class="grid grid-cols-2 md:grid-cols-3 md:gap-8 gap-2 gap-y-4 mt-5 text-center">
                <div class="md:p-3">
                    <img class="mx-auto" src="/images/features/employment_registration_black.svg"
                        alt="employment registration">
                    <div class="font-semibold mt-1">Employment Registration</div>
                    <div class="text-sm mt-2">Online registration of applicant in Employment Exchange.</div>
                </div>
                <div class="md:p-3">
                    <img class="mx-auto" src="/images/features/job_black.svg" alt="Job Notification">
                    <div class="font-semibold mt-1">Job Notification</div>
                    <div class="text-sm mt-2">Registered user can get notify to the registered mobile number using
                        SMS</div>
                </div>
                <a href="https://www.ncs.gov.in/Pages/Search.aspx?OT=fheFJjl41aGWG85YSvGqng%3D%3D&Source=https://www.ncs.gov.in/"
                    target="_blank" class="md:p-3">
                    <img class="mx-auto" src="/images/features/news_black.svg" alt="Employment News">
                    <div class="font-semibold mt-1">Employment News</div>
                    <div class="text-sm mt-2">Employment News will be shown through this portal</div>
                </a>
                <div class="md:p-3">
                    <img class="mx-auto" src="/images/features/job_post_black.svg" alt="Job Posting">
                    <div class="font-semibold mt-1">Job Posting</div>
                    <div class="text-sm mt-2">This portal allows employer to post latest jobs</div>
                </div>
                <div class="md:p-3">
                    <img class="mx-auto" src="/images/features/user_management_black.svg" alt="User Management">
                    <div class="font-semibold mt-1">User Management</div>
                    <div class="text-sm mt-2">The ability for administrators to manage user access.</div>
                </div>
                <div class="md:p-3">
                    <img class="mx-auto" src="/images/features/post_management_black.svg" alt="Post Management">
                    <div class="font-semibold mt-1">Post Management</div>
                    <div class="text-sm mt-2">This allows to maintain information such as news & other various
                        updates.</div>
                </div>
            </div>
        </div>
    </div>

    {{-- workflow --}}
    <div class="w-full bg-green-50 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-3xl font-semibold">User Workflow</div>
            <div class="empex mt-3"></div>

            <div class="w-full mt-5">
                <img src="/images/main/workflow.svg" alt="workflow" class="hidden md:block w-full">
                <img src="/images/main/workflow_mobile.svg" alt="workflow" class="block md:hidden w-full">
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection

@section('copyright')
    @parent

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
    <script>
        $(document).ready(function() {
            //added rj
            console.log('ready');
            let ncsStatistics = [];

            //added rj




            var ctx = document.getElementById("canvas").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10'],
                    datasets: [{
                        label: 'User',
                        data: [
                            @foreach ($ncoStatistics as $nco)
                                '{{ $nco }}',
                            @endforeach
                        ],
                        backgroundColor: '#2d9735'
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            barThickness: 20,
                            maxBarThickness: 20,
                        }]
                    }
                }
            });

            console.log('mychart old', myChart);

        });
    </script>
@endsection
