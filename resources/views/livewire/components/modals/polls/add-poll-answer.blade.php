<x-modal class="modal-bottom sm:modal-middle">
    <div class="text-center">
        <h2 class="text-2xl font-bold mb-4">{{ __('sites/poll.modals.add_answer.title') }}</h2>
        <p class="mb-3">{{ __('sites/poll.modals.add_answer.description') }}</p>
    </div>


    <x-form wire:submit="addPollAnswer">
        <div class="space-y-5">
            <x-input label="{{ __('sites/poll.title') }}"
                     class="input input-bordered w-full" wire:model="title" required/>

            <x-input label="{{ __('sites/poll.modals.add_answer.max_votes') }}"
                     class="input input-bordered w-full" wire:model="maxVotes" type="number" min="1" required/>

            <x-checkbox label="{{ __('sites/poll.modals.add_answer.unlimited_votes') }}"
                        class="checkbox checkbox-primary" wire:model="unlimitedVotes"
                        hint="{{ __('sites/poll.modals.add_answer.unlimited_votes_hint') }}"/>

            <x-checkbox label="{{ __('sites/poll.modals.add_answer.use_custom_input') }}"
                        class="checkbox checkbox-primary" wire:model="useCustomInput"
                        hint="{{ __('sites/poll.modals.add_answer.custom_input_hint') }}"/>
        </div>

        <div class="divider"></div>

        <div class="mt-2 flex justify-between gap-3">

            <button class="btn btn-neutral flex-grow" type="button"
                    wire:click="$dispatch('closeModal')">{{ __('messages.buttons.cancel') }}</button>
            <x-button class="btn btn-success flex-grow" type="submit"
                      spinner="addPollAnswer">{{ __('sites/poll.modals.add_answer.buttons.add_answer') }}
            </x-button>
        </div>
    </x-form>
</x-modal>

