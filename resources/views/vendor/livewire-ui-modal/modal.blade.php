<div>
    @isset($jsPath)
        <script>{!! file_get_contents($jsPath) !!}</script>
    @endisset
    @isset($cssPath)
        <style>{!! file_get_contents($cssPath) !!}</style>
    @endisset

    <div x-data="LivewireUIModal()"
         x-init="init()"
         x-on:close.stop="setShowPropertyTo(false)"
         x-on:keydown.escape.window="closeModalOnEscape()"
         x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
         x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
         x-show="show"
    >
        <div
                class="modal show d-block"
                data-bs-backdrop="static" 
                data-bs-keyboard="false" 
                tabindex="-1" 
                aria-labelledby="staticBackdropLabel"
                aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" x-on:click="closeModal()" class="btn-close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div
                            x-show="show && showActiveComponent"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"

                            class="modal-body"
                            id="modal-container"
                    >
                        @forelse($components as $id => $component)
                            <div x-show.immediate="activeComponent == '{{ $id }}'" x-ref="{{ $id }}" wire:key="{{ $id }}">
                                @livewire($component['name'], $component['attributes'], key($id))
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"  x-on:click="closeModal()" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Test</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>