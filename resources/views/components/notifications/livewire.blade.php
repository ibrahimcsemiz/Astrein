<div class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
    <div
        x-data="{ show: false, message: '' }"
        x-on:notify.window="show = true; message = $event.detail; setTimeout(() => { show = false }, 2500)"
        x-show="show"
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto"
    >
        <div class="rounded-lg shadow-xs overflow-hidden">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg x-show="message.type === 'success'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>

                        <svg x-show="message.type === 'error'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <svg x-show="message.type === 'info'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <svg x-show="message.type === 'warning'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p
                            x-text="message.title"
                            :class="{
                                'text-green-900': message.type === 'success',
                                'text-red-900': message.type === 'error',
                                'text-blue-900': message.type === 'info',
                                'text-orange-900': message.type === 'warning',
                            }"
                            class="font-medium text-md"></p>
                        <p
                            x-text="message.message"
                            :class="{
                                'text-green-500': message.type === 'success',
                                'text-red-500': message.type === 'error',
                                'text-blue-500': message.type === 'info',
                                'text-orange-500': message.type === 'warning',
                            }"
                            class="text-sm leading-5 font-medium"></p>
                    </div>
                    <div class="ml-4 flex-shrink-0 flex">
                        <button @click="show = false" class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
