<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4 2xl:col-span-1">
        @if (count($complaints) > 0)
            @foreach ($complaints as $complaint)
                <div class="mx-auto border border-gray-200 rounded-lg text-gray-700 mb-0.5 h-30 clickable-row cursor-pointer hover:bg-gray-100"
                    data-url="{{ route('complaint.create') }}" data-created="{{ $complaint->created_date }}"
                    data-fullname="{{ $complaint->fullname }}" data-phone="{{ $complaint->phone }}"
                    data-email="{{ $complaint->email }}" data-city="{{ $complaint->city }}"
                    data-district="{{ $complaint->district }}" data-address="{{ $complaint->address }}"
                    data-content="{{ $complaint->content }}" data-number="{{ $complaint->number }}"
                    data-quarter="{{ $complaint->quarter }}">
                    <div class="flex p-3 border-l-4 border-red-500 rounded-lg">
                        <div class="space-y-1 border-r-2 pr-3">
                            <div class="text-xs leading-5 font-semibold"><span
                                    class="text-xs leading-4 font-normal text-gray-500"> №</span>
                                {{ $complaint['number'] }}</div>
                            <div class="text-xs leading-5"><span class="text-xs leading-4 font-normal text-gray-500 pr">
                                    Төрөл: </span> {{ $complaint['type'] }}</div>
                            <div class="text-xs leading-5"><span class="text-xs leading-4 font-normal text-gray-500">
                                    Шинээр ирсэн: </span>{{ $complaint['created_date'] }}</div>
                        </div>
                        <div class="flex-1">
                            <div class="ml-3 space-y-1 border-r-2 pr-3">
                                <div class="text-sm leading-4 font-semibold">
                                    {{ $complaint['fullname'] }}
                                    <span class="text-xs leading-4 font-normal text-gray-500">Иргэн</span>
                                </div>
                                <div class="text-sm leading-4 font-normal">
                                    {{-- {{ Str::limit($complaint['content'], 200) }} --}}
                                    {{ html_entity_decode($complaint['content'], ENT_QUOTES, 'UTF-8') }}
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ml-3 my-5 bg-red-500 p-1 w-20">
                                <div class="uppercase text-xs leading-4 font-semibold text-center text-white">
                                    {{ $complaint['type'] }}</div>
                            </div>
                            <div class="ml-3 p-1 bg-gray-100 rounded text-xs">
                                {{ isset($complaint['complaint_id']) ? 'Бүртгэгдсэн' : '' }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {!! $complaints->links() !!}
        @else
            <div class="text-gray-500">
                <img class="w-32 h-32 mx-auto" src="{{ asset('/image/empty.svg') }}" alt="image empty states">
                <p class="text-gray-500 font-medium text-lg text-center">Мэдээлэл байхгүй байна.</p>
            </div>
        @endif
        <br>
    </div>
</x-admin-layout>

@push('scripts')

    <script>
        $(document).ready(function() {
            $('.clickable-row').click(function() {
                const url = $(this).data('url');
                const created = $(this).data('created');
                const fullname = $(this).data('fullname');
                const phone = $(this).data('phone');
                const email = $(this).data('email');
                const city = $(this).data('city');
                const district = $(this).data('district');
                const address = $(this).data('address');
                const content = $(this).data('content');
                const number = $(this).data('number');
                const quarter = $(this).data('quarter');

                const nameParts = fullname.split(' ');
                const lastname = nameParts[0];
                const firstname = nameParts.slice(1).join(' ');

                // Redirect to create page with data
                window.location.href = url + '?firstname=' + firstname + '&lastname=' + lastname +
                    '&email=' + email + '&created=' + created + '&phone=' + phone + '&city=' + city +
                    '&district=' + district + '&address=' + address + '&content=' + content + '&number=' +
                    number + '&quarter=' + quarter;
            });
        });
    </script>
