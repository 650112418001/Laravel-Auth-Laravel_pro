<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="mb-4 text-lg font-semibold">
                        {{ __("You're logged in!") }}
                    </p>

                    <!-- Hero Section -->
                    <section class="hero">
                        <div class="container">
                            <div class="brid-con">
                                <!-- Event Hub Info -->
                                <div class="brid-info">
                                    <h3 class="hero-title">Event Hub</h3>
                                    <p class="hero-desc">
                                        ยินดีต้อนรับเข้าสู่ระบบจัดการกิจกรรม! ที่นี่คุณสามารถสร้างและจัดการกิจกรรมต่าง ๆ
                                        ได้อย่างสะดวกสบาย ไม่ว่าคุณจะเป็นผู้จัดงานหรือผู้เข้าร่วม
                                        เรามีฟีเจอร์ครบครันที่ช่วยให้คุณสามารถติดตามความคืบหน้าของการลงทะเบียนหรือเข้าร่วมกิจกรรมต่าง
                                        ๆ ได้อย่างง่ายดาย ระบบของเราพร้อมให้คุณใช้ทุกความสามารถที่ต้องการ!
                                    </p>
                                    <a href="AIDetector" class="brid-btn">Click for use</a>
                                </div>

                                <!-- Event Hub Image -->
                                <div class="brid-img">
                                    <img src="https://media.discordapp.net/attachments/904408798461042708/1292303327685771314/E0B980E0B980E0B881E0B989E0B984E0B8824.png?ex=67033ec3&is=6701ed43&hm=a3d469c6c90a38bcb23465b6e6c0b10a5f72cef81c03f5c3571aaee1d205a85d&=&format=webp&quality=lossless&width=648&height=579"
                                        alt="Event Hub Image">
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>

    <!-- CSS Styles -->
    <style>
        /* Hero Section Styling */
        .hero {
            display: flex;
            justify-content: space-between;
            /* ทำให้มีช่องว่างระหว่าง content กับรูป */
            padding: 20px;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #4A90E2;
            margin-bottom: 20px;
        }

        .hero-desc {
            font-size: 1.125rem;
            color: #6B7280;
            margin-bottom: 20px;
            max-width: 600px;
        }

        .brid-con {
            display: flex;
            flex-direction: row;
            /* จัดเรียงแนวนอน */
            align-items: center;
            gap: 20px;
        }

        .brid-info {
            flex: 1;
            max-width: 600px;
            text-align: left;
        }

        .brid-btn {
            display: inline-block;
            background-color: #4A90E2;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 1rem;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .brid-btn:hover {
            background-color: #357ABD;
        }

        .brid-img img {
            max-width: 60%;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design for Mobile */
        @media (max-width: 768px) {
            .brid-con {
                flex-direction: column;
                /* เมื่อจอเล็ก ให้เรียงแนวตั้ง */
                text-align: center;
            }

            .brid-img img {
                max-width: 80%;
            }
        }
    </style>
</x-app-layout>
