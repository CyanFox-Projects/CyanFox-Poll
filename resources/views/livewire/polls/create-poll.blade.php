<div class="md:mx-20 md:my-10 sm:m-10">
    <div class="card-body">
        <span class="font-bold text-xl">{{ __('sites/poll.create_poll.title') }}</span>
        <div class="divider"></div>

        <x-form wire:submit="createPoll">
            @csrf

            <div class="grid md:grid-cols-2 gap-4 my-4">
                <x-input label="{{ __('sites/poll.title') }}"
                         class="input input-bordered w-full" wire:model="title" required/>

                <x-input label="{{ __('sites/poll.description') }}"
                         class="input input-bordered w-full" wire:model="description"/>

                <x-input label="{{ __('sites/poll.email') }}" hint="{{ __('sites/poll.email_hint') }}"
                         class="input input-bordered w-full" wire:model="email"/>

                <x-input label="{{ __('sites/poll.end_date') }}"
                         class="input input-bordered w-full" type="date" wire:model="endDate"/>

            </div>

            <div class="divider"></div>

            <div class="mt-4 overflow-x-auto">
                <button type="button" class="btn btn-primary"
                        wire:click="$dispatch('openModal', { component: 'components.modals.polls.add-poll-answer' })">
                    {{ __('sites/poll.buttons.add_answer') }}
                </button>
                <table class="table table-zebra">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('sites/poll.table.title') }}</th>
                        <th>{{ __('sites/poll.table.unlimited_votes') }} / {{ __('sites/poll.table.max_votes') }}</th>
                        <th>{{ __('sites/poll.table.custom_input') }}</th>
                        <th>{{ __('messages.table.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($answers as $answer)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $answer['title'] }}</td>
                            @if($answer['useUnlimitedVotes'])
                                <td>
                                    <span class="badge badge-success">{{ __('messages.unlimited') }}</span>
                                </td>
                            @else
                                <td>{{ $answer['maxVotes'] }}</td>
                            @endif
                            <td>{{ $answer['useCustomInput'] ? __('messages.yes') : __('messages.no') }}</td>
                            <td><i class="icon-trash-2 cursor-pointer text-red-600"
                                   wire:click="deleteAnswer('{{ $loop->index }}')"></i></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="divider mt-4"></div>
            @if(config('captcha.disabled') === false)
                <div class="gap-3 md:flex space-y-3">
                    <img src="{{ $captchaImg }}" alt="Captcha" class="h-20">

                    <x-input label="{{ __('messages.captcha') }}"
                             required
                             class="input-bordered w-1/2" wire:model="captcha"/>
                </div>
            @endif

            <div class="mt-2 flex justify-start gap-3">
                <x-button class="btn btn-success" label="{{ __('sites/poll.create_poll.buttons.create_poll') }}"
                          type="submit" spinner="createPoll">
                </x-button>
            </div>
        </x-form>
    </div>

</div>
