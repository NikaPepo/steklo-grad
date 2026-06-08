@php
    $currentCategory = $category ?? $product->category ?? null;
@endphp
<header class="w-full border-b border-gray-200 bg-white">


    <div class="lg:hidden px-4 py-3 flex items-center justify-between gap-3">
        <!-- Logo -->
        <a href="/" class="flex items-center">
            <img src="{{asset('assets/img/favicon/steklograd.png')}}" alt="Logo"
                 class="h-10 w-auto object-contain">
        </a>
        <div class="flex items-center gap-3">
            <a href="tel:+79160238501"
               class="inline-flex items-center gap-2 font-semibold transition-colors duration-200 hover:text-brand-primary active:text-brand-primary">
                <i class="bx bxs-phone text-brand-primary text-[22px] w-6 h-6"></i>
                <span class="tracking-wider">{{$phone}}</span>
            </a>

            <button id="mobileMenuBtn" class="p-2" aria-expanded="false" aria-controls="mobileMenu">
                <i class="bx bx-menu text-[28px] w-7 h-7"></i>
            </button>
        </div>
    </div>

    <!-- Mobile dropdown -->
    <div id="mobileMenu" class="lg:hidden hidden border-t border-gray-100 px-4 py-5 space-y-5">

        <!-- CTA -->
        <button class="w-full cursor-pointer bg-brand-primary hover:bg-[#9BA8B8]
                      shadow-md hover:shadow-lg
                      transition-colors duration-600 ease-in-out text-white px-8 py-3.5 rounded-md text-sm font-medium openContactModal">
            Заказать звонок
        </button>

        <!-- Phones + mail -->
        <div class="grid gap-3 font-semibold text-base">
            <a href="tel:+79160238501"
               class="inline-flex items-center gap-2 transition-colors duration-200 hover:text-brand-primary active:text-brand-primary">
                <i class="bx bxs-phone text-brand-primary text-[20px] w-5 h-5"></i>
                <span class="tracking-wider">{{$phone}}</span>
            </a>
            <a href="tel:+79671470022"
               class="inline-flex items-center gap-2 transition-colors duration-200 hover:text-brand-primary active:text-brand-primary">
                <i class="bx bxs-phone text-brand-primary text-[20px] w-5 h-5"></i>
                <span class="tracking-wider">{{$phone2}}</span>
            </a>
            <a href="mailto:{{$post}}"
               class="inline-flex items-center gap-2 transition-colors duration-200 hover:text-brand-primary active:text-brand-primary">
                <i class="bx bxs-envelope text-brand-primary text-[20px] w-5 h-5"></i>
                <span class="tracking-wider">{{$post}}</span>
            </a>
        </div>

        <!-- Menu -->
        <nav class="border-t border-gray-100 pt-4">
            <ul class="grid gap-2 text-gray-700 text-base">

                @foreach($menuParents as $parent)
                    <li class="border-b border-gray-100 pb-2">
                        @if($parent->children && count($parent->children))
                            <details class="group">
                                <summary
                                        class="list-none flex items-center justify-between py-2 cursor-pointer
                                           transition-colors duration-200
                                           @if($currentCategory && $currentCategory->isDescendantOf($parent)) text-brand-primary @else hover:text-brand-primary active:text-brand-primary @endif">
                                    <span>{{$parent->name}}</span>
                                    <i class="bx bx-chevron-down transition-transform duration-200 group-open:rotate-180 text-[22px] w-6 h-6"></i>
                                </summary>

                                <ul class="pl-3 mt-1 grid gap-1">
                                    <li>
                                        <a href="{{ route('category.show', $parent->slug) }}"
                                           class="block py-2 text-sm transition-colors duration-200 hover:text-brand-primary active:text-brand-primary">
                                            Все {{$parent->name}}
                                        </a>
                                    </li>
                                    @foreach($parent->children as $child)
                                        <li>
                                            <a href="{{ route('category.show', $parent->slug . '/' . $child->slug) }}"
                                               class="block py-2 text-sm transition-colors duration-200 hover:text-brand-primary active:text-brand-primary">
                                                {{$child->name}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </details>
                        @else
                            <a href="{{ route('category.show', $parent->slug) }}"
                               class="block py-2 transition-colors duration-200
                                      @if(isset($currentCategory) && $currentCategory->id === $parent->id) text-brand-primary @else hover:text-brand-primary active:text-brand-primary @endif">
                                {{$parent->name}}
                            </a>
                        @endif
                    </li>
                @endforeach

                <li class="border-b border-gray-100 pb-2">
                    @if(isset($menuServices) && count($menuServices))
                        <details class="group">
                            <summary
                                    class="list-none flex items-center justify-between py-2 cursor-pointer
                                       transition-colors duration-200
                                       @if(request()->is('services')) text-brand-primary @else hover:text-brand-primary active:text-brand-primary @endif">
                                <span>Услуги</span>
                                <i class="bx bx-chevron-down transition-transform duration-200 group-open:rotate-180 text-[22px] w-6 h-6"></i>
                            </summary>

                            <ul class="pl-3 mt-1 grid gap-1">
                                <li>
                                    <a href="{{route('services.index')}}"
                                       class="block py-2 text-sm transition-colors duration-200 hover:text-brand-primary active:text-brand-primary">
                                        Все услуги
                                    </a>
                                </li>
                                @foreach($menuServices as $service)
                                    <li>
                                        <a href="{{route('service.show', $service->slug)}}"
                                           class="block py-2 text-sm transition-colors duration-200 hover:text-brand-primary active:text-brand-primary">
                                            {{$service->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </details>
                    @else
                        <a href="{{route('services.index')}}"
                           class="block py-2 transition-colors duration-200
                                  @if(request()->is('services')) text-brand-primary @else hover:text-brand-primary active:text-brand-primary @endif">
                            Услуги
                        </a>
                    @endif
                </li>

                <li><a href="{{route('about.index')}}"
                       class="block py-2 transition-colors duration-200 hover:text-brand-primary active:text-brand-primary @if(request()->is('about')) text-brand-primary @endif">О компании</a></li>
                <li><a href="{{route('gallery.index')}}"
                       class="block py-2 transition-colors duration-200 hover:text-brand-primary active:text-brand-primary @if(request()->is('gallery')) text-brand-primary @endif">Галерея</a></li>
                <li><a href="{{route('reviews.index')}}"
                       class="block py-2 transition-colors duration-200 hover:text-brand-primary active:text-brand-primary @if(request()->is('reviews')) text-brand-primary @endif">Отзывы</a></li>
                <li><a href="{{route('contacts.index')}}"
                       class="block py-2 transition-colors duration-200 hover:text-brand-primary active:text-brand-primary @if(request()->is('contacts')) text-brand-primary @endif">Контакты</a></li>

            </ul>
        </nav>

        <!-- Socials -->
        <div class="flex gap-8 justify-center items-center pt-2">
            <a href="https://wa.me/79160238501" target="_blank">
                <i class="bx bxl-whatsapp text-brand-primary hover:text-[#9BA8B8]
                          transition-colors duration-600 ease-in-out text-[30px] w-[30px] h-[30px]"></i>
            </a>
            <a href="" target="_blank">
                <i class="bx bxl-vk text-brand-primary hover:text-[#9BA8B8]
                          transition-colors duration-600 ease-in-out text-[30px] w-[30px] h-[30px]"></i>
            </a>
            <a href="https://t.me/+79160238501" target="_blank">
                <i class="bx bxl-telegram text-brand-primary hover:text-[#9BA8B8]
                          transition-colors duration-600 ease-in-out text-[30px] w-[30px] h-[30px]"></i>
            </a>
        </div>
    </div>

    <!-- ===================== DESKTOP ===================== -->
    <div class="hidden lg:block">
        <div class="max-w-6xl grid grid-cols-1 md:flex mx-auto px-0  justify-between gap-4 xl:gap-10  items-center pb-3">
            <div class=" px-4 py-3 flex justify-center">
                <a href="/" class="flex items-center ">
                    <img src="{{asset('assets/img/favicon/steklograd.png')}}" alt="Logo"
                         class="max-h-28 w-auto object-contain">
                </a>
            </div>
            <div >
                <div class="grid py-5 font-semibold text-lg">
                    <div class="grid grid-cols-1 gap-3 md:inline-flex">
                        <a href="tel:+79160238501" class="inline-flex items-center gap-2 group transition justify-center">
                            <i class="bx bxs-phone text-brand-primary transition duration-300 group-hover:text-brand-primary/50 text-[20px] w-5 h-5" ></i>
                            <span class="tracking-wider"> {{$phone}}
                             </span>
                        </a>
                        <a href="tel:+79671470022" class="inline-flex items-center gap-2 group transition justify-center">
                            <i class="bx bxs-phone text-brand-primary transition duration-300 group-hover:text-brand-primary/50 text-[20px] w-5 h-5" ></i>
                            <span class="tracking-wider"> {{$phone2}}
                             </span>
                        </a>
                        <a href="mailto:{{$post}}" class="inline-flex items-center gap-2 group transition justify-center">
                            <i class="bx bxs-envelope text-brand-primary transition duration-300 group-hover:text-brand-primary/50 text-[20px] w-5 h-5" ></i>
                            <span class="tracking-wider"> {{$post}}
                             </span>
                        </a>
                    </div>
                </div>
                <div class="font-normal xl:text-base lg:text-sm  whitespace-nowrap ">
                    <nav class="border-t border-gray-100">
                        <div class="container mx-auto">
                            <ul class="grid grid-cols-1  md:flex items-center gap-3 md:gap-9 py-3 text-gray-700">
                                @foreach($menuParents as $parent)
                                    <li class="relative group cursor-pointer ">
                                        <div class="flex transition-colors duration-600 justify-center items-center gap-1 @if($currentCategory && $currentCategory->isDescendantOf($parent)) text-brand-primary @else group-hover:text-brand-primary @endif">
                                            <a href="{{ route('category.show', $parent->slug) }}"
                                               class=" ">{{$parent->name}}</a>
                                            <i class="bx bx-chevron-down  transition-transform  duration-600  group-hover:rotate-180 text-[20px] w-5 h-5" ></i>
                                        </div>
                                        @if($parent->children)
                                            <ul class="absolute z-50 p-4 gap-2 top-full left-0 bg-white shadow-lg rounded-md py-2 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition">
                                                @foreach($parent->children as $child)
                                                    <li class="w-full"><a href="{{ route('category.show', $parent->slug . '/' .  $child->slug) }}"
                                                                          class="hover:text-brand-primary block w-full whitespace-nowrap p-3
                                                           transition-colors duration-600 ease-in-out">{{$child->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach

                                <li class="relative group cursor-pointer">
                                    <div class="flex items-center justify-center gap-1 @if(request()->is('services') || request()->is('services/*')) text-brand-primary @else group-hover:text-brand-primary @endif">
                                        <a href="{{route('services.index')}}" class="transition-colors duration-600 ">
                                            Услуги
                                        </a>
                                        <i class="bx bx-chevron-down transition-transform duration-600 group-hover:rotate-180 text-[20px] w-5 h-5" ></i>
                                    </div>
                                    @if(isset($menuServices))
                                        <ul class="absolute z-50 p-4 gap-2 top-full left-0 bg-white shadow-lg rounded-md py-2 opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition">
                                            @foreach($menuServices as $service)
                                                <li><a href="{{route('service.show', $service->slug)}}"
                                                       class="hover:text-brand-primary block w-full whitespace-nowrap py-3
                                                           transition-colors duration-600 ease-in-out">{{$service->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    @endif
                                </li>

                                <li class="relative"><a href="{{route('about.index')}}"
                                                        class="flex transition-colors justify-center duration-600 ease-in-out hover:text-brand-primary @if(request()->is('about'))text-brand-primary  @endif">О компании</a></li>
                                <li class="relative"><a href="{{route('gallery.index')}}" class="flex transition-colors justify-center duration-600 ease-in-out hover:text-brand-primary @if(request()->is('gallery'))text-brand-primary  @endif">Галерея</a></li>
                                <li class="relative"><a href="{{route('reviews.index')}}"
                                                        class=" flex  transition-colors justify-center duration-600 ease-in-out hover:text-brand-primary @if(request()->is('reviews'))text-brand-primary  @endif ">Отзывы</a>
                                </li>
                                <li class="relative"><a href="{{route('contacts.index')}}"
                                                        class=" flex transition-colors duration-600 justify-center ease-in-out hover:text-brand-primary @if(request()->is('contacts'))text-brand-primary  @endif">Контакты</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="flex flex-col h-[130px]">
                <div class="my-5">
                    <button class="cursor-pointer bg-brand-primary hover:bg-[#9BA8B8]
                              shadow-md hover:shadow-lg
                              transition-colors duration-600 ease-in-out text-white px-8 py-3.5 rounded-md text-sm font-medium openContactModal">
                        Заказать звонок
                    </button>
                </div>
                <div class="flex gap-8  justify-center items-center">
                    <a href="https://wa.me/79160238501" target="_blank"><i
                                class="bx bxl-whatsapp text-brand-primary hover:text-[#9BA8B8]
                                      transition-colors duration-600 ease-in-out text-[30px] w-[30px] h-[30px]" ></i></a>
                    <a href="" target="_blank"><i
                                class="bx bxl-vk text-brand-primary hover:text-[#9BA8B8]
                                      transition-colors duration-600 ease-in-out text-[30px] w-[30px] h-[30px]" ></i></a>
                    <a href="https://t.me/+79160238501" target="_blank"><i
                                class="bx bxl-telegram text-brand-primary hover:text-[#9BA8B8]
                                      transition-colors duration-600 ease-in-out text-[30px] w-[30px] h-[30px]" ></i></a>
                </div>
            </div>
        </div>
    </div>

</header>

