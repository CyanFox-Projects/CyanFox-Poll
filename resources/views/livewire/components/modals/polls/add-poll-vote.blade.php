<x-modal class="modal-bottom sm:modal-middle">
    @if($useCustomInput)
        <div class="text-center">
            <h2 class="text-2xl font-bold mb-4">{{ __('sites/poll.modals.add_vote.custom_input.title') }}</h2>
            <p class="mb-3">{{ __('sites/poll.modals.add_vote.custom_input.description') }}</p>
        </div>


        <x-form wire:submit="addPollVote">
            <div class="space-y-5">
                <x-input label="{{ __('sites/poll.modals.add_vote.custom_input.custom_input') }}"
                         class="input input-bordered w-full" wire:model="pollVoteCustomInput" required/>
            </div>

            <div class="divider"></div>

            <div class="mt-2 flex justify-between gap-3">
                <button class="btn btn-neutral flex-grow" type="button"
                        wire:click="$dispatch('closeModal')">{{ __('messages.buttons.cancel') }}</button>
                <x-button class="btn btn-primary flex-grow" type="button"
                          wire:click="addPollVote(true)" spinner>{{ __('sites/poll.modals.add_vote.buttons.add_vote') }}
                </x-button>
                <x-button class="btn btn-success flex-grow" type="submit"
                          spinner="addPollVote">{{ __('sites/poll.modals.add_vote.buttons.vote') }}
                </x-button>
            </div>
        </x-form>
    @else
        <div class="text-center">
            <h2 class="text-2xl font-bold mb-4">{{ __('sites/poll.modals.add_vote.title') }}</h2>
            <p class="mb-3">{{ __('sites/poll.modals.add_vote.description') }}</p>
        </div>


        <x-form wire:submit="addPollVote">
            <div class="space-y-5">

                <x-input label="{{ __('sites/poll.modals.add_vote.name') }}"
                         class="input input-bordered w-full" wire:model="name" required/>

                <x-select label="{{ __('sites/poll.modals.add_vote.poll_answers') }}"
                          class="select select-bordered w-full" wire:model="pollAnswerId"
                          placeholder="{{ __('sites/poll.modals.add_vote.poll_answers_placeholder') }}"
                          :options="$pollAnswers" required></x-select>
            </div>

            <div class="divider"></div>

            @if(app()->currentLocale() == 'de')
                <div class="mt-2 flex justify-between gap-3">
                    <x-button class="btn btn-primary flex-grow" type="button"
                              wire:click="addPollVote(true)" spinner>{{ __('sites/poll.modals.add_vote.buttons.add_vote') }}
                    </x-button>
                    <x-button class="btn btn-success flex-grow" type="submit"
                              spinner="addPollVote">{{ __('sites/poll.modals.add_vote.buttons.vote') }}
                    </x-button>
                </div>
                <button class="btn btn-neutral" type="button"
                        wire:click="$dispatch('closeModal')">{{ __('messages.buttons.cancel') }}</button>
            @else
                <div class="mt-2 flex justify-between gap-3">
                    <button class="btn btn-neutral flex-grow" type="button"
                            wire:click="$dispatch('closeModal')">{{ __('messages.buttons.cancel') }}</button>
                    <x-button class="btn btn-primary flex-grow" type="button"
                              wire:click="addPollVote(true)" spinner>{{ __('sites/poll.modals.add_vote.buttons.add_vote') }}
                    </x-button>
                    <x-button class="btn btn-success flex-grow" type="submit"
                              spinner="addPollVote">{{ __('sites/poll.modals.add_vote.buttons.vote') }}
                    </x-button>
                </div>
            @endif
        </x-form>
    @endif
</x-modal>

