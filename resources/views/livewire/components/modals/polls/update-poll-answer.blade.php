<x-modal class="modal-bottom sm:modal-middle">
    <div class="text-center">
        <h2 class="text-2xl font-bold mb-4">{{ __('sites/poll.modals.update_answer.title') }}</h2>
        <p class="mb-3">{{ __('sites/poll.modals.update_answer.description') }}</p>
    </div>


    <x-form wire:submit="updatePollAnswer">
        <div class="space-y-5">
            <x-input label="{{ __('sites/poll.title') }}"
                     class="input input-bordered w-full" wire:model="title" required/>

            <x-input label="{{ __('sites/poll.modals.update_answer.max_votes') }}"
                     class="input input-bordered w-full" wire:model="maxVotes" type="number" min="1" required/>

            <x-checkbox label="{{ __('sites/poll.modals.update_answer.unlimited_votes') }}"
                        class="checkbox checkbox-primary" wire:model="unlimitedVotes"
                        hint="If checked, the answer has unlimited votes"/>

            <x-checkbox label="{{ __('sites/poll.modals.update_answer.use_custom_input') }}"
                        class="checkbox checkbox-primary" wire:model="useCustomInput"
                        hint="If checked, the answer has a custom input field"/>
        </div>

        <div class="divider"></div>

        <div class="mt-2 flex justify-between gap-3">

            <button class="btn btn-neutral flex-grow" type="button"
                    wire:click="$dispatch('closeModal')">{{ __('messages.buttons.cancel') }}</button>
            <x-button class="btn btn-success flex-grow" type="submit"
                      spinner="updatePollAnswer">{{ __('sites/poll.modals.update_answer.buttons.update_answer') }}
            </x-button>
        </div>
    </x-form>
</x-modal>

