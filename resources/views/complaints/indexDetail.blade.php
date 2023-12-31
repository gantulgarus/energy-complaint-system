<x-admin-layout>
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-1">
        <div class="flex items-center justify-between mb-4">
            <div class="container mx-auto mt-8">
                <div class="mb-4">
                    <h1 class="text-xl font-bold"> Санал, хүсэлт</h1>
                    {{-- <div class="flex justify-end">
                        <a href="{{ route('complaint.create') }}"
                            class="px-4 py-2 rounded-md bg-black text-sky-100 hover:bg-gray-600">Нэмэх</a>
                    </div> --}}
                </div>
                @if ($message = Session::get('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 text-sm p-2 mb-4" role="alert">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 py-4">
                    <div class="w-full md:w-2/3">
                        <form method="GET" autocomplete="off" class="flex items-center">
                            @csrf
                            <div class="mr-3">
                                <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2" placeholder="Хайх" name="search_text" value="{{$search_text}}">
                            </div>
                            <div class="mr-3">
                                <input type="text" id="daterange" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2" placeholder="" name="daterange" value="{{$daterange}}">
                            </div>
                            <button type="submit" class="flex items-center justify-center text-white bg-primary hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">
                                Хайх
                            </button>
                        </form>
                    </div>
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        
                        <button type="button" id="export-btn" class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            Export
                        </button>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                        <div
                            class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                            <table class="min-w-full" id="complaint-report">
                                <thead>
                                    <tr>
                                        <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            ID</th>
                                        <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Төрөл</th>
                                        {{-- <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Суваг</th> --}}
                                        {{-- <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Төлөв</th> --}}
                                        <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Овог, нэр</th>
                                        <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Регистр</th>
                                        <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Утас</th>
                                        {{-- <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Байгууллага</th> --}}
                                        <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Санал, хүсэлт</th>
                                        <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Бүртгэсэн огноо</th>
                                        <th
                                            class="p-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                            Үлдсэн хугацаа</th>
                                        <th class="px-6 py-3 text-sm text-left text-gray-500 border-b border-gray-200 bg-gray-50"
                                            colspan="3">
                                            Үйлдэл</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white">
                                    @if (count($complaints) > 0)
                                        @foreach ($complaints as $complaint)
                                        
                                            <tr class="table-row hover:bg-gray-100 cursor-pointer" data-id="{{ $complaint->id }}">
                                                <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="flex items-center">
                                                        {{++$i}}
                                                    </div>
                                                </td>
    
                                                <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->category->name}}
                                                    </div>
                                                </td>
    
                                                {{-- <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->channel->name}}
                                                    </div>
                                                </td> --}}
    
                                                {{-- <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->status->name}}
                                                    </div>
                                                </td> --}}
    
                                                <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->lastname}} {{$complaint->firstname}}
                                                    </div>
                                                </td>
    
                                                <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->registerNumber}}
                                                    </div>
                                                </td>
    
                                                <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->phone}}
                                                    </div>
                                                </td>
    
                                                {{-- <td class="p-2 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900">{{$complaint->organization->name}}
                                                    </div>
                                                </td> --}}
    
                                                <td class="p-2 whitespace-no-wrap border-b border-gray-200 text-sm">
                                                    <p>{{$complaint->complaint}}</p>
                                                </td>
    
                                                <td
                                                    class="p-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                                    <span>{{$complaint->complaint_date}}</span>
                                                </td>
                                                @if ($complaint->status_id != 4 || $complaint->status_id != 6)
                                                <td
                                                    class="p-2 text-sm leading-5 text-orange-500 whitespace-no-wrap border-b border-gray-200">
                                                    <span>{{ now()->diffInHours($complaint->expire_date) > 0 ? now()->diffInHours($complaint->expire_date) . " цаг үлдсэн" : "Хугацаа хэтэрсэн" }}</span>
                                                </td>
                                                @endif
    
                                                <td
                                                    class="w-2 text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 ">
                                                    <a href="{{route('complaint.edit', $complaint->id)}}"
                                                        class="text-indigo-600 hover:text-indigo-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                </td>
                                                {{-- <td
                                                    class="text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200">
                                                    <a href="{{route('complaint.show', $complaint->id)}}"
                                                        class="text-indigo-600 hover:text-indigo-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                </td> --}}
                                                <td
                                                    class="w-2 text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200 ">
                                                    <form action="{{ route('complaint.destroy',$complaint->id) }}"
                                                        method="Post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                class="w-6 h-6 text-red-600 hover:text-red-800" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="w-full text-center mx-auto py-12" colspan="5">
                                            <img class="w-32 h-32 mx-auto"
                                                src="{{asset('/image/empty.svg')}}"
                                                alt="image empty states">                                             
                                            <p class="text-gray-700 font-medium text-lg text-center">Мэдээлэл байхгүй байна.</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <br>
                        {!! $complaints->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

@push('scripts')

<script>
    $(document).ready(function() {
        // Add click event handler to table rows with class 'table-row'
        $('.table-row').click(function() {
            // Get the value of the 'data-id' attribute of the clicked row
            var id = $(this).data('id');

            $.ajax({
                url: '/updateComplaintStatus/' + id,
                method: 'PUT',
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {
                },
                success: function (response) {
                    console.log(response.message);
                },
                error: function (error) {
                    console.error(error.responseText);
                }
            });

            window.location.href = '/complaint/' + id;

        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#daterange", {
            mode: "range",
            showMonths: 2,
            dateFormat: "Y-m-d",
        });
    });


    document.getElementById('export-btn').addEventListener('click', function () {
        // Get the HTML table element
        var table = document.getElementById('complaint-report');

        // Convert the HTML table to a worksheet
        var ws = XLSX.utils.table_to_sheet(table);

        // Create a workbook and add the worksheet to it
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

        XLSX.writeFile(wb, "Reports.xlsx", { compression: true });

    });
</script>