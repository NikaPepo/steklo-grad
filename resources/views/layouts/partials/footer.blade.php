<footer class="bg-[#162229] text-white pt-14 pb-10">
    <div class="container mx-auto max-w-6xl">

        <!-- ===================== MOBILE ===================== -->
        <div class="md:hidden px-4">
            <div class="space-y-6">

                <!-- CTA  -->
                <button
                        class="w-full cursor-pointer bg-brand-primary hover:bg-[#9BA8B8]
                           shadow-md hover:shadow-lg
                           transition-colors duration-600 ease-in-out text-white px-8 py-3 rounded-md text-sm font-medium openContactModal">
                    Заказать звонок
                </button>

                <!-- Контакты (открыто) -->
                <div>
                    <h3 class="font-semibold mb-3">Контакты</h3>
                    <ul class="space-y-3 text-sm text-gray-300">
                        @if($phone)
                            <li>
                                <a href="tel:+79160238501"
                                   class="hover:text-brand-primary active:text-brand-primary transition-colors duration-600 ease-in-out">
                                    {{ $phone }}
                                </a>
                            </li>
                        @endif
                        @if($phone2)
                            <li>
                                <a href="tel:+79671470022"
                                   class="hover:text-brand-primary active:text-brand-primary transition-colors duration-600 ease-in-out">
                                    {{ $phone2 }}
                                </a>
                            </li>
                        @endif
                        @if($post)
                            <li>
                                <a href="mailto:{{$post}}"
                                   class="hover:text-brand-primary active:text-brand-primary transition-colors duration-600 ease-in-out break-all">
                                    {{ $post }}
                                </a>
                            </li>
                        @endif
                        <li>
                            <div class="flex gap-8 text-3xl items-start pt-2">
                                <a href="https://wa.me/79160238501" target="_blank">
                                    <i class="bx bxl-whatsapp text-brand-primary hover:text-[#9BA8B8]
                                              transition-colors duration-600 ease-in-out"></i>
                                </a>
                                <a href="" target="_blank">
                                    <i class="bx bxl-vk text-brand-primary hover:text-[#9BA8B8]
                                              transition-colors duration-600 ease-in-out"></i>
                                </a>
                                <a href="https://t.me/+79160238501" target="_blank">
                                    <i class="bx bxl-telegram text-brand-primary hover:text-[#9BA8B8]
                                              transition-colors duration-600 ease-in-out"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Услуги (аккордеон) -->
                <div class="border-t border-white/10 pt-4">
                    <details class="group">
                        <summary class="list-none cursor-pointer flex items-center justify-between py-2 font-semibold">
                            <span>Услуги</span>
                            <i class="bx bx-chevron-down transition-transform duration-200 group-open:rotate-180 text-[22px]"></i>
                        </summary>
                        <ul class="space-y-2 text-sm text-gray-300 pt-2">
                            @foreach($menuServices as $service)
                                <li>
                                    <a href="{{ route('service.show', $service->slug) }}"
                                       class="hover:text-brand-primary active:text-brand-primary transition-colors duration-600 ease-in-out">
                                        {{ $service->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </details>
                </div>

                <!-- Категории (каждая как аккордеон) -->
                @foreach($menuParents as $parent)
                    @if($parent)
                        <div class="border-t border-white/10 pt-4">
                            <details class="group">
                                <summary class="list-none cursor-pointer flex items-center justify-between py-2 font-semibold">
                                    <span>{{ $parent->name }}</span>
                                    <i class="bx bx-chevron-down transition-transform duration-200 group-open:rotate-180 text-[22px]"></i>
                                </summary>

                                <ul class="space-y-2 text-sm text-gray-300 pt-2">
                                    @if($parent->children)
                                        @foreach($parent->children as $child)
                                            <li>
                                                <a href="{{ route('category.show', $parent->slug . '/' . $child->slug) }}"
                                                   class="hover:text-brand-primary active:text-brand-primary transition-colors duration-600 ease-in-out">
                                                    {{ $child->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </details>
                        </div>
                    @endif
                @endforeach

                <!-- Политика -->
                <div class="border-t border-white/10 pt-6 text-sm text-gray-400">
                    <a href="{{route('privacy.index')}}"
                       class="hover:text-brand-primary active:text-brand-primary transition-colors duration-600 ease-in-out">
                        Политика конфиденциальности
                    </a>
                </div>
            </div>
        </div>

        <!-- ===================== DESKTOP (md и выше) — твой код 1:1 (только фиксим ease-in-ou) ===================== -->
        <div class="hidden md:block">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                <div>
                    <h3 class="font-semibold mb-4">Услуги</h3>
                    <ul class="space-y-2 text-sm text-gray-300">
                        @foreach($menuServices as $service)
                            <li>
                                <a href="{{ route('service.show', $service->slug) }}" class="hover:text-brand-primary
                                     shadow-md hover:shadow-lg
                                      transition-colors duration-600 ease-in-out">
                                    {{ $service->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @foreach($menuParents as $parent)
                    @if($parent)
                        <div>
                            <h3 class="font-semibold mb-4">{{ $parent->name }}</h3>
                            <ul class="space-y-2 text-sm text-gray-300">
                                @if($parent->children)
                                    @foreach($parent->children as $child)
                                        <li>
                                            <a href="{{ route('category.show', $parent->slug . '/' . $child->slug) }}" class="hover:text-brand-primary
                                          transition-colors duration-600 ease-in-out">
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    @endif
                @endforeach

                <div>
                    <h3 class="font-semibold mb-4">Контакты</h3>
                    <ul class="space-y-3 text-sm text-gray-300">
                        @if($phone)
                            <li><a href="tel:+79160238501" class="hover:text-brand-primary
                                      transition-colors duration-600 ease-in-out">{{ $phone }}</a></li>
                        @endif
                        @if($phone2)
                            <li><a href="tel:+79671470022" class="hover:text-brand-primary
                                      transition-colors duration-600 ease-in-out">{{ $phone2 }}</a></li>
                        @endif
                        @if($post)
                            <li><a href="mailto:{{$post}}" class="hover:text-brand-primary
                                      transition-colors duration-600 ease-in-out">{{ $post }}</a></li>
                        @endif
                        <li>
                            <div class="flex gap-8 text-3xl  items-start">
                                <a href="https://wa.me/79160238501" target="_blank"><i
                                            class="bx bxl-whatsapp text-brand-primary hover:text-[#9BA8B8]
                                      transition-colors duration-600 ease-in-out"></i></a>
                                <a href="" target="_blank"><i
                                            class="bx bxl-vk text-brand-primary hover:text-[#9BA8B8]
                                      transition-colors duration-600 ease-in-out"></i></a>
                                <a href="https://t.me/+79160238501" target="_blank"><i
                                            class="bx bxl-telegram text-brand-primary hover:text-[#9BA8B8]
                                      transition-colors duration-600 ease-in-out"></i></a>
                            </div>
                        </li>
                    </ul>

                    <button
                            class="cursor-pointer inline-block mt-6 bg-brand-primary hover:bg-[#9BA8B8]
                              shadow-md hover:shadow-lg
                              transition-colors duration-600 ease-in-out text-white px-8 py-3 rounded-md text-sm font-medium openContactModal">
                        Заказать звонок
                    </button>
                </div>
            </div>

            <div class="border-t border-white/10 mt-10 pt-6 flex justify-between text-sm text-gray-400">
                <div>
                    <a href="{{route('privacy.index')}}" class="hover:text-brand-primary
                                     shadow-md hover:shadow-lg
                                      transition-colors duration-600 ease-in-out">
                        Политика конфиденциальности
                    </a>
                </div>
            </div>
        </div>

    </div>
</footer>
