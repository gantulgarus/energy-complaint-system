<aside id="sidebar"
   class="fixed hidden z-20 h-full top-0 left-0 pt-16 flex lg:flex flex-shrink-0 flex-col w-64 transition-width duration-75"
   aria-label="Sidebar" :class="{ '-ml-64': !sidebarOpen }">
   <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
      <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
         <div class="flex-1 px-3 bg-white divide-y space-y-1">
            <ul class="space-y-2 pb-2">
               <li class="bg-purple-50">
                  <div class="rounded-lg font-bold text-sm p-2 text-primary">{{ Auth::user()->org?->name }}</div>
               </li>
               <li>
                  <a href="{{ route('dashboard') }}"
                     class="text-base text-gray-900 font-normal rounded-lg flex items-center p-2 hover:bg-gray-100 group {{ Request::routeIs('dashboard') ? 'bg-gray-100' : '' }}">
                     <img src="{{ asset('/image/dashboard-layout.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="dashboard">
                     <span class="ml-3">Хянах самбар</span>
                  </a>
               </li>
               {{-- @if (Auth::user()->org_id == 99)    --}}
               <li>
                  <a href="{{ route('sourceComplaint.index') }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ Request::routeIs('sourceComplaint.index') ? 'bg-gray-100' : '' }}">
                     <img src="{{ asset('/image/source-control.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="new">
                     <span class="ml-3 flex-1 whitespace-nowrap">1111-н хүсэлт</span>
                     <span
                        class="bg-blue-200 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full"></span>
                  </a>
               </li>
               {{-- @endif --}}
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 0]) }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/0') ? 'bg-gray-100' : '' }}">
                     <img src="{{ asset('/image/inbox-in.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="new">
                     <span class="ml-3 flex-1 whitespace-nowrap">Шинээр ирсэн</span>
                     <span
                        class="bg-blue-200 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{
                        $new_complaints!==0 ? $new_complaints : '' }}</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 2]) }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/2') ? 'bg-gray-100' : '' }}">
                     <img src="{{ asset('/image/rule-draft-svgrepo-com.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="recieved">
                      
                     <span class="ml-3 flex-1 whitespace-nowrap">Хүлээн авсан</span>
                     <span
                        class="bg-orange-100 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{
                        $received_complaints !==0 ? $received_complaints : '' }}</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 3]) }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/3') ? 'bg-gray-100' : '' }}">
                     <img src="{{ asset('/image/rule-test-svgrepo-com.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="recieved">
                     <span class="ml-3 flex-1 whitespace-nowrap">Хянаж байгаа</span>
                     <span
                        class="bg-orange-100 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{
                        $under_control_complaints !== 0 ? $under_control_complaints : '' }}</span>
                  </a>
               </li>
               @if (Auth::user()->org_id == 99)
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 1]) }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/1') ? 'bg-gray-100' : '' }}">
                     <img src="{{ asset('/image/document-export-svgrepo-com.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="sent">
                     <span class="ml-3 flex-1 whitespace-nowrap">Шилжүүлсэн</span>
                     <span
                        class="bg-orange-100 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{
                        $sent_complaints !== 0 ? $sent_complaints : '' }}</span>
                  </a>
               </li>
               @endif
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 6]) }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/6') ? 'bg-gray-100' : '' }}">
                     <img src="{{ asset('/image/approve-invoice-svgrepo-com.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="report">
                     <span class="ml-3 flex-1 whitespace-nowrap">Шийдвэрлэсэн</span>
                     <span
                        class="bg-green-100 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{
                        $solved_complaints!==0 ? $solved_complaints : '' }}</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('complaintStatus', ['id' => 4]) }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ request()->is('complaintStatus/4') ? 'bg-gray-100' : '' }}">
                     <img src="{{ asset('/image/rule-cancelled-svgrepo-com.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="cancelled">
                     <span class="ml-3 flex-1 whitespace-nowrap">Цуцлагдсан</span>
                     <span
                        class="bg-red-100 text-gray-800 ml-3 text-sm font-medium inline-flex items-center justify-center px-2 rounded-full">{{
                        $canceled_complaints!==0 ? $canceled_complaints : '' }}</span>
                  </a>
               </li>
               
               <li>
                  <a href="{{ route('complaint.index') }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ Request::routeIs('complaint.index') ? 'bg-gray-100' : '' }}">
                     <img src="{{ asset('/image/documents-symbol-svgrepo-com.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="report">
                     <span class="ml-3 flex-1 whitespace-nowrap">Тайлан</span>
                  </a>
               </li>
               
            </ul>

            {{-- Тохиргоо --}}
            @auth
            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
               @if (Auth::user()->role?->name == 'admin')
               <li>
                  <a href="{{ route('user.index') }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ Request::routeIs('user.index') ? 'bg-gray-100' : '' }}">
                     <img src="{{ asset('/image/group-security-svgrepo-com.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="users">
                     <span class="ml-3 flex-1 whitespace-nowrap">Хэрэглэгчид</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('organization.index') }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ Request::routeIs('organization.index') ? 'bg-gray-100' : '' }}">
                     <img src="{{ asset('/image/org.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="organization">
                     <span class="ml-3 flex-1 whitespace-nowrap">Байгууллага</span>
                  </a>
               </li>
               @endif
               <li>
                  <a href="{{ route('cdr.index') }}"
                     class="text-base text-gray-900 font-normal rounded-lg hover:bg-gray-100 flex items-center p-2 group {{ Request::routeIs('cdr.index') ? 'bg-gray-100' : '' }}">
                     <img src="{{ asset('/image/turntable-music-note.svg')}}" class="w-[24px] h-[24px] shrink-0 inline-block" alt="users">
                     <span class="ml-3 flex-1 whitespace-nowrap">Яриа бичлэг</span>
                  </a>
               </li>
            </ul>
            @endauth
            
         </div>
      </div>
   </div>
</aside>