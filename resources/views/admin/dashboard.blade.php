<x-admin-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <style>
        .text-lg {
            font-size: 1.2rem;
            /* ขนาดตัวอักษรที่ใหญ่ขึ้น */
        }

        .font-weight-bold {
            font-weight: 550;
            /* ทำให้ตัวหนามากขึ้น */
        }

        .card-header {
            background-color: #f8f9fa;
            /* เปลี่ยนสีพื้นหลังของการ์ด */
            border-bottom: 1px solid #e7e7e7;
            /* เพิ่มขอบล่าง */
        }

        .progress {
            height: 20px;
            /* ปรับความสูงของแถบโปรเกรส */
            border-radius: 5px;
            /* มุมโค้งมน */
        }

        .progress-bar {
            transition: width 0.4s ease;
            /* เพิ่มเอฟเฟกต์การเปลี่ยน */
            border-radius: 5px;
            /* มุมโค้งมน */
        }
    </style>

    <div class="py-3"> <!-- ปรับระยะห่างให้สั้นลง -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="font-weight-bold mb-3">Welcome back, Admin!</h1>
                    <h2 class="text-lg text-gray-900">Hi Panyakorn</h2>

                    <!-- User and Event Card Example -->
                    <div class="row g-2"> <!-- ลดระยะห่างระหว่างคอลัมน์ -->
                        <div class="col-lg-6 col-md-6 mb-3"> <!-- เพิ่ม margin-bottom -->
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <span class="text-lg font-weight-bold">Total Users</span>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userCount }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-3x text-gray-300"></i> <!-- Icon แสดงผู้ใช้ -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 mb-3"> <!-- เพิ่ม margin-bottom -->
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <span class="text-lg font-weight-bold">Event Dashboard</span>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $eventCount }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-3x text-gray-300"></i>
                                            <!-- Icon แสดงเหตุการณ์ -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- จบ row -->
                </div>
            </div>
        </div>
    </div>

    <div class="py-3"> <!-- ปรับระยะห่างให้สั้นลง -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Project Card Example -->
                    <div class="card shadow mb-3"> <!-- ลด margin-bottom ของการ์ด -->
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Events Progress</h6>
                        </div>
                        <div class="card-body">
                            @php
                                $today = \Carbon\Carbon::now(); // วันที่ปัจจุบัน
                            @endphp
                            @foreach ($events as $event)
                                @php
                                    $attendingCount = \App\Models\Attending::where('event_id', $event->id)->count(); // จำนวนผู้ที่เข้าร่วม
                                    $totalTickets = $event->num_register; // จำนวนตั๋วทั้งหมด
    
                                    // ตรวจสอบช่วงวันที่
                                    $startDate = \Carbon\Carbon::parse($event->start_date)->startOfDay(); // วันที่เริ่ม
                                    $endDate = \Carbon\Carbon::parse($event->end_date)->endOfDay(); // วันที่จบ
                                @endphp
    
                                @if ($today->isAfter($startDate->subDay()) && $today->isBefore($endDate->addDay())) 
                                    <!-- เงื่อนไขกรอง event ที่อยู่ระหว่างวันที่ปัจจุบันถึงวันที่จบ -->
                                    <h4 class="small font-weight-bold">{{ $event->title }}
                                        <span class="float-right">{{ $attendingCount }}/{{ $totalTickets }}</span>
                                        <!-- แสดงจำนวนผู้เข้าร่วม/จำนวนตั๋ว -->
                                    </h4>
                                    <div class="progress mb-3"> <!-- ลด margin-bottom ของ progress -->
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $totalTickets > 0 ? ($attendingCount / $totalTickets) * 100 : 0 }}%; background-color: {{ $event->progressClass }};"
                                            aria-valuenow="{{ $attendingCount }}" aria-valuemin="0"
                                            aria-valuemax="{{ $totalTickets }}">
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    



    <div class="py-1"> <!-- ใช้ py-1 เพื่อระยะห่างที่พอดี -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="card shadow mb-3"> <!-- ลด margin-bottom ของการ์ด -->
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">User Attendance Data</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>Event Name</th>
                                            <th>Time</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendings as $attending)
                                            <tr>
                                                <td>{{ $attending->user_id }}</td>
                                                <td>{{ $attending->name_user }}</td>
                                                <td>{{ $attending->event_name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($attending->event_time)->format('H:i A') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($attending->event_start)->format('d M Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($attending->event_end)->format('d M Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</x-admin-layout>
