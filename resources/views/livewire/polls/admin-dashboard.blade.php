<div class="md:mx-20 md:my-10 sm:m-10">
    <div class="card-body">
        <span class="font-bold text-xl">{{ __('sites/poll.admin_dashboard.title', ['title' => $poll->title]) }}</span>
        <div class="divider"></div>

        <x-form wire:submit="updatePoll">
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

                <x-input label="{{ __('sites/poll.admin_dashboard.public_link') }}" disabled
                         class="input input-bordered w-full" wire:model="publicLink">
                    <x-slot:append>
                        <x-button class="btn-neutral rounded-l-none" onclick="copyToClipboard('{{ $publicLink }}')"><i
                                class="icon-clipboard-copy"></i> {{ __('sites/poll.admin_dashboard.buttons.copy_to_clipboard') }}
                        </x-button>
                    </x-slot:append>
                </x-input>
                <x-input label="{{ __('sites/poll.admin_dashboard.admin_link') }}" disabled
                         class="input input-bordered w-full" wire:model="adminLink">
                    <x-slot:append>
                        <x-button class="btn-neutral rounded-l-none" onclick="copyToClipboard('{{ $adminLink }}')"><i
                                class="icon-clipboard-copy"></i> {{ __('sites/poll.admin_dashboard.buttons.copy_to_clipboard') }}
                        </x-button>
                    </x-slot:append>
                </x-input>
            </div>

            <div class="divider"></div>

            <div role="tablist" class="tabs tabs-boxed">
                <a role="tab" class="tab @if($tab == 'answers') tab-active @endif"
                   wire:click="$set('tab', 'answers')">{{ __('sites/poll.admin_dashboard.tabs.answers') }}</a>
                <a role="tab" class="tab @if($tab == 'votes') tab-active @endif"
                   wire:click="$set('tab', 'votes')">{{ __('sites/poll.admin_dashboard.tabs.votes') }}</a>
            </div>

            @if($tab == 'answers')
                <div class="mt-4 overflow-x-auto">
                    <button type="button" class="btn btn-primary"
                            wire:click="$dispatch('openModal', { component: 'components.modals.polls.add-poll-answer' })">
                        {{ __('sites/poll.buttons.add_answer') }}
                    </button>
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('sites/poll.table.title') }}</th>
                                <th>{{ __('sites/poll.table.votes') }}</th>
                                <th>{{ __('sites/poll.table.unlimited_votes') }} / {{ __('sites/poll.table.max_votes') }}</th>
                                <th>{{ __('sites/poll.table.custom_input') }}</th>
                                <th>{{ __('messages.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($answers as $answer)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $answer->title }}</td>
                                    <td>{{ $answer->votes }}</td>
                                    @if($answer->unlimited_votes === 1)
                                        <td>
                                            <span class="badge badge-success">{{ __('messages.unlimited') }}</span>
                                        </td>
                                    @else
                                        <td>{{ $answer->max_votes }}</td>
                                    @endif
                                    <td>{{ $answer['useCustomInput'] ? __('messages.yes') : __('messages.no') }}</td>
                                    <td>
                                        <i class="icon-trash-2 cursor-pointer text-red-600"
                                           wire:click="deleteAnswer('{{ $loop->index }}', '{{ $answer->id }}')"></i>

                                        <i class="icon-pen cursor-pointer text-blue-600"
                                           wire:click="$dispatch(`openModal`, { component: `components.modals.polls.update-poll-answer`,
                        arguments: { answerId: '{{ $answer->id }}', pollId: '{{ $poll->id }}' } })"></i>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if($tab == 'votes')
                <livewire:components.table.polls.poll-admin-vote-table :pollId="$poll->id"/>
            @endif

            <div class="divider mt-4"></div>

            <div class="mt-2 flex justify-start gap-3">
                <x-button class="btn btn-success" label="{{ __('sites/poll.admin_dashboard.buttons.update_poll') }}"
                          type="submit" spinner="updatePoll">
                </x-button>
                <x-button class="btn btn-error" label="{{ __('sites/poll.admin_dashboard.buttons.delete_poll') }}"
                          type="button" wire:click="deletePoll" spinner>
                </x-button>
            </div>
        </x-form>
    </div>

    <script>
        function copyToClipboard(text) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).then(function () {
                    new FilamentNotification()
                        .title('{{ __('sites/poll.admin_dashboard.notifications.copied_to_clipboard') }}')
                        .success()
                        .send();
                });
            } else {
                try {
                    const textArea = document.createElement("textarea");
                    document.body.appendChild(textArea);
                    textArea.value = text;
                    textArea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textArea);

                    new FilamentNotification()
                        .title('{{ __('sites/poll.admin_dashboard.notifications.copied_to_clipboard') }}')
                        .success()
                        .send();
                } catch (err) {
                    console.error('Fallback copy to clipboard failed', err);
                }
            }
        }
    </script>
</div>
