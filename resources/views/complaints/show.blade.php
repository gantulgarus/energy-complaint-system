<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4">
        <div class="flex items-center justify-between mb-4">
            <div class="w-full grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 md:gap-4">

                <div class="col-span-1 flow-root rounded-lg border border-gray-300 py-3 shadow-lg mb-4">
                    <dl class="-my-3 divide-y divide-gray-100 text-sm">
                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">№</dt>
                            <dd class="text-gray-700 text-right font-bold sm:col-span-2">{{ $complaint->serial_number }}
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Хүсэлт гаргагч</dt>
                            <dd class="text-gray-700 text-right sm:col-span-2">
                                @if ($complaint->complaint_maker_type_id == 1)
                                    {{ mb_substr($complaint->lastname, 0, 1) }}.{{ $complaint->firstname }}
                                @else
                                    {{ $complaint->complaint_maker_org_name }}
                                @endif
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Утас</dt>
                            <dd class="text-gray-700 text-right sm:col-span-2">
                                {{ $complaint->phone }}
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Хаяг</dt>
                            <dd class="text-gray-700 text-right sm:col-span-2">
                                {{ $complaint->country }},
                                {{ $complaint->district }},
                                {{ $complaint->khoroo }},
                                {{ $complaint->addressDetail }}
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Бүртгэсэн огноо</dt>
                            <dd class="text-gray-700 text-right sm:col-span-2">
                                {{ date('Y-m-d H:i', strtotime($complaint->complaint_date)) }}</dd>
                        </div>

                        @if ($complaint->status_id != 6)
                            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                                <dt class="font-medium text-gray-900">Үлдсэн хугацаа</dt>
                                <dd class="text-gray-700 text-right sm:col-span-2">
                                    @if ($complaint->hasExpired())
                                        <i class="fa-solid fa-circle fa-beat-fade text-red-500"></i>
                                        <span class="">Хугацаа хэтэрсэн</span>
                                    @else
                                        <span>{{ \App\Helpers\DateHelper::formatDateDiff(now(), $complaint->expire_date) }}
                                        </span>
                                    @endif
                                </dd>
                            </div>
                        @endif

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Төрөл</dt>
                            <dd class="text-gray-700 text-right sm:col-span-2"><span
                                    class="bg-red-200 p-1 rounded">{{ $complaint->category?->name }}</span></dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Ирсэн хэлбэр</dt>
                            <dd class="text-gray-700 text-right sm:col-span-2">{{ $complaint->channel?->name }}</dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Хариуцсан байгууллага</dt>
                            <dd class="text-gray-700 text-right sm:col-span-2"><span
                                    class="bg-black text-white p-1 rounded">{{ $complaint->organization?->name }}</span>
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Төлөв</dt>
                            <dd class="text-gray-700 text-right sm:col-span-2"><span
                                    class="p-1 rounded @if ($complaint->status_id == 0) bg-gray-100
                            @elseif($complaint->status_id == 1)
                            bg-gray-200
                            @elseif($complaint->status_id == 2)
                            bg-yellow-200
                            @elseif($complaint->status_id == 3)
                            bg-blue-200
                            @elseif($complaint->status_id == 4)
                            bg-orange-200
                            @elseif($complaint->status_id == 5)
                            bg-red-200
                            @elseif($complaint->status_id == 6)
                            bg-green-200
                            @else
                            bg-gray-200 @endif">{{ $complaint->status?->name }}</span>
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Ангилал</dt>
                            <dd class="text-gray-700 text-right sm:col-span-2">
                                <div class="mb-2">
                                    @if ($complaint->complaintMakerType)
                                        <span
                                            class="text-blue-900 bg-blue-100 text-sm py-1 px-2 rounded-md">{{ $complaint->complaintMakerType?->name }}</span>
                                    @endif
                                </div>
                                <div class="mb-2">
                                    <span
                                        class="text-blue-900 bg-blue-100 text-sm py-1 px-2 rounded-md">{{ $complaint->energyType?->name }}</span>
                                </div>

                                <div class="mb-2">
                                    @if ($complaint->complaintTypeSummary)
                                        <span
                                            class="text-blue-900 bg-blue-100 text-sm py-1 px-2 rounded-md">{{ $complaint->complaintTypeSummary?->name }}</span>
                                    @endif
                                </div>
                            </dd>
                        </div>

                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Үнэлгээ</dt>
                            <dd class="text-gray-700 text-right sm:col-span-2">
                                @if (isset($rating->rating))
                                    <div class="flex justify-end rating">
                                        <label for="star1">
                                            <input class="hidden" type="radio" id="star1" name="rating"
                                                value="1" />
                                            <svg class="cursor-pointer block w-6 h-6 @if ($rating->rating >= 1) text-yellow-300 @else text-grey @endif "
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                            </svg>
                                        </label>
                                        <label for="star2">
                                            <input class="hidden" type="radio" id="star2" name="rating"
                                                value="2" />
                                            <svg class="cursor-pointer block w-6 h-6 @if ($rating->rating >= 2) text-yellow-300 @else text-grey @endif "
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                            </svg>
                                        </label>
                                        <label for="star3">
                                            <input class="hidden" type="radio" id="star3" name="rating"
                                                value="3" />
                                            <svg class="cursor-pointer block w-6 h-6 @if ($rating->rating >= 3) text-yellow-300 @else text-grey @endif "
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                            </svg>
                                        </label>
                                        <label for="star4">
                                            <input class="hidden" type="radio" id="star4" name="rating"
                                                value="4" />
                                            <svg class="cursor-pointer block w-6 h-6 @if ($rating->rating >= 4) text-yellow-300 @else text-grey @endif "
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                            </svg>
                                        </label>
                                        <label for="star5">
                                            <input class="hidden" type="radio" id="star5" name="rating"
                                                value="5" />
                                            <svg class="cursor-pointer block w-6 h-6 @if ($rating->rating >= 5) text-yellow-300 @else text-grey @endif "
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                            </svg>
                                        </label>
                                    </div>
                                @endif
                            </dd>
                        </div>
                        <div class="p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            @if (isset($rating->comment))
                                {{ $rating->comment }}
                            @endif
                        </div>
                        <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-gray-900">Холбоотой гомдлууд</dt>
                            <dd class="text-gray-700 text-right sm:col-span-2">
                                <a href="{{ route('complaint.index', ['related_complaints' => $related_complaints->pluck('id')->toArray()]) }}"
                                    class="text-blue-500 hover:underline">
                                    {{ count($related_complaints) }} гомдлууд
                                </a>
                            </dd>
                        </div>
                    </dl>
                </div>


                <div class="col-span-3 py-3 mb-4 bg-white p-6 rounded-lg border border-gray-300 shadow-lg">
                    @if (session()->has('message'))
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                            role="alert">
                            <div class="flex">
                                <div>
                                    <p class="text-sm">{{ session('message') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="flex items-center border-b border-gray-200 pb-3">

                        <div class="flex items-start justify-between w-full">
                            <div class="pl-3">
                                <p class="focus:outline-none text-xl font-medium leading-5 text-gray-700 ">Өргөдөл
                                    гомдлын агуулга</p>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <p tabindex="0"
                            class="bg-slate-100 shadow-inner rounded focus:outline-none text-sm leading-5 p-2 my-2 text-gray-900 text-justify">
                            {{ $complaint->complaint }}</p>
                    </div>

                    <div>
                        @if ($complaint->cdr_id != null)
                            <div class="text-sm px-2 mb-2">
                                <p>Яриа бичлэг</p>
                                <audio controls class="w-full">
                                    <source src="{{ asset('records/' . $complaint->cdr?->record_name) }}.wav"
                                        type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        @endif
                        @if ($complaint->audio_file_id != null)
                            <div class="text-sm px-2 mb-2">
                                <p>Бичлэг</p>
                                <audio controls class="w-full">
                                    <source src="/files/{{ $complaint->audioFile?->filename }}" type="audio/mpeg">
                                    Your browser does not support the audio tag.
                                </audio>
                            </div>
                        @endif
                        @if ($complaint->audio_file_url != null)
                            <div class="text-sm px-2 mt-4">
                                {{-- <audio controls class="w-full">
                                    <source src="{{ $complaint->audio_file_url }}" type="audio/mpeg">
                                    Your browser does not support the audio tag.
                                </audio> --}}
                                <a href="{{ $complaint->audio_file_url }}" target="_blank"
                                    class="bg-blue-500 text-white px-4 py-2 rounded">
                                    Бичлэг сонсох
                                </a>
                            </div>
                        @endif

                        @if ($complaint->file_id != null)
                            <div class="flex space-x-4 py-4">
                                <x-file-list-component :$fileName :$fileExt :$fileUrl :$fileSizeInKilobytes />
                            </div>
                        @endif
                        @if ($complaint->files->isNotEmpty())
                            <div class="flex flex-row flex-wrap">
                                @foreach ($complaint->files as $file)
                                    <div class="m-2">
                                        <x-file-list-component :fileName="$file->filename" :fileExt="pathinfo($file->filename, PATHINFO_EXTENSION)" :fileUrl="url('files/' . $file->filename)"
                                            :fileSizeInKilobytes="10" />
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>

                    <div role="img" aria-label="bookmark">
                        <div>
                            <livewire:complaint-step :complaint="$complaint" />
                        </div>
                    </div>

                </div>
            </div>
        </div>
</x-admin-layout>
