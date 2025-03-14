<div>
    <div class="relative">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                {{ session('success') }}
            </div>
        @endif
        {{-- @if (session('info'))
            <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                {{ session('info') }}
              </div>
        @endif --}}
        @if (session('warning'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                {{ session('warning') }}
            </div>
        @endif
        <div class="text-right">
            <button wire:click="create()"
                class="bg-black hover:bg-gray-700 text-white text-right text-sm py-2 px-4 rounded my-3"><i
                    class="fa-solid fa-gear"></i> Удирдах<p></button>
        </div>
        @if ($isOpen)
            @include('livewire.create')
        @endif
    </div>

    @foreach ($complaint_steps as $step)
        @if ($step->status_id == 7)
            <div class="p-2 bg-red-100 text-red-800 text-sm rounded mb-4">
                Шийдвэрлэх хугацаа хэтэрсэн
            </div>
        @endif
        <div
            class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-300">
            <div class="border-b-2 border-neutral-100 px-6 py-3 font-semibold">
                <span
                    class="py-1 px-2 rounded-lg text-sm 
                    @if ($step->status_id == 0) bg-gray-100
                    @elseif($step->status_id == 1)
                    bg-gray-200
                    @elseif($step->status_id == 2)
                    bg-yellow-200
                    @elseif($step->status_id == 3)
                    bg-blue-200
                    @elseif($step->status_id == 4)
                    bg-orange-200
                    @elseif($step->status_id == 5)
                    bg-red-200
                    @elseif($step->status_id == 6)
                    bg-green-200
                    @else
                    bg-gray-200 @endif">

                    Өргөдөл
                    гомдол {{ $step->status?->name }}
                </span>
            </div>
            <div class="p-4">
                <div class="w-full mx-auto bg-white rounded-xl overflow-hidden">
                    <div class="md:flex">
                        <!-- First Column - User Info -->
                        <div class="md:w-1/3 p-4">
                            <!-- User Avatar -->
                            {{-- <img src="user-avatar.jpg" alt="User Avatar" class="w-20 h-20 rounded-full mx-auto mb-4"> --}}
                            <div class="flex items-start">
                                <img class="w-12 h-12 rounded-full object-cover mr-4 shadow"
                                    src="{{ $step->sentUser?->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                <div class="text-sm ">
                                    <div class="flex items-center justify-between">
                                        <h2 class="font-semibold text-gray-900">
                                            {{ $step->sentUser?->name }}</h2>
                                    </div>
                                    <p class="text-gray-700">{{ $step->sentUser?->division }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Second Column - Additional Content -->
                        <div class="md:w-1/3 p-4 text-sm">
                            <!-- Other content goes here -->
                            <h2 class="font-semibold text-gray-900">Байгууллага</h2>
                            <div>{{ $step->org?->name }}</div>
                        </div>
                        <div class="md:w-1/3 p-4 text-sm ">
                            <!-- Other content goes here -->
                            <h2 class="font-semibold text-gray-900">Огноо</h2>
                            <div>{{ $step->sent_date }}</div>
                        </div>
                    </div>
                    <div class="bg-slate-100 shadow-inner p-2">
                        <div class="text-sm text-gray-700">
                            {{-- {!! $step->desc !!} --}}
                            @foreach (explode("\n", $step->desc) as $index => $line)
                                <div class="py-1 {{ $index % 2 == 0 ? '' : 'bg-blue-100 p-2 rounded' }}">
                                    {{ $line }}
                                </div>
                            @endforeach
                        </div>
                        @if (isset($step->amount))
                            <div class="text-sm text-gray-700 mt-2 font-bold">
                                Үнийн дүн: {{ number_format((float) $step->amount) }}₮
                            </div>
                        @endif
                        @if (isset($step->amount_pay) && $step->amount_pay != 0)
                            <div class="text-sm text-gray-700 mt-2 font-bold">
                                Хэрэглэгч төлөх дүн: {{ number_format((float) $step->amount_pay) }}₮
                            </div>
                        @endif
                        @if (isset($step->amount_recieve) && $step->amount_recieve != 0)
                            <div class="text-sm text-gray-700 mt-2 font-bold">
                                Хэрэглэгчид буцаах дүн: {{ number_format((float) $step->amount_recieve) }}₮
                            </div>
                        @endif
                    </div>
                    @if ($step->file_id != null)
                        @php
                            if ($step->file_id != null) {
                                $fileName = $step->file?->filename; // Example dynamic image URL
                                $fileUrl = 'files/' . $step->file?->filename; // Example dynamic image URL
                                $fileExt = pathinfo($step->file?->filename, PATHINFO_EXTENSION);
                                $fileSizeInBytes = filesize(public_path($fileUrl));
                                $fileSizeInKilobytes = round($fileSizeInBytes / 1024);
                            }
                        @endphp
                        <div class="flex space-x-4 py-4">
                            <x-file-list-component :$fileName :$fileExt :$fileUrl :$fileSizeInKilobytes />
                        </div>
                    @endif
                    @if ($step->files->isNotEmpty())
                        <div class="flex flex-row flex-wrap">
                            @foreach ($step->files as $file)
                                <div class="m-2">
                                    <x-file-list-component :fileName="$file->filename" :fileExt="pathinfo($file->filename, PATHINFO_EXTENSION)" :fileUrl="url('files/' . $file->filename)"
                                        :fileSizeInKilobytes="10" />
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Edit and Delete Buttons -->
                    @if (Auth::user()->role->name == 'ehzh')
                        <div class="text-right mt-4">
                            <button wire:click="edit({{ $step->id }})"
                                class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded">Засах</button>
                            {{-- <button wire:click="confirmDelete({{ $step->id }})" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded">Устгах</button> --}}
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <br>
    @endforeach

</div>
