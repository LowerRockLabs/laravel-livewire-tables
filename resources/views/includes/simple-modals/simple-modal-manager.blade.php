<div>
    <div x-data="{ modalOpen: $wire.entangle('modalOpen'), behaviour: $wire.entangle('closeBehaviour'), closeModal() { this.modalOpen = false; $wire.closeSimpleModal(); } }">
        @if($modalOpen && $modalComponent)
            <div x-show="modalOpen" x-cloak :class="modalOpen ? 'fixed inset-0 z-600 overflow-y-auto z-99' : ''" >
                <div class="flex h-full place-items-center items-center justify-center min-h-screen content-center px-4 text-center sm:block sm:p-0">
                    <div class=" w-full  rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-md md:max-w-xl lg:max-w-3xl xl:max-w-5xl 2xl:max-w-9xl">
                        <div class="w-full bg-white dark:bg-gray-800 items-center" x-on:click.outside="closeModal">
                            <div class="w-full h-96 overflow-x-hidden drop-shadow-sm overflow-y-visible px-2">
                                <div class="w-12 self-end"><button class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" x-on:click="closeModal">X</button></div>
                                <div class="pt-4" wire:key="{{ $modalComponent }}">
                                    {!! $this->getLivewireString() !!}
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

</div>
