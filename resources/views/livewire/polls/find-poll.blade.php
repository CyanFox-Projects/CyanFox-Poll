<div class="md:mx-20 md:my-10 sm:m-10">
    <div class="card-body">
        <span class="font-bold text-xl">{{ __('sites/poll.find_poll.title') }}</span>
        <div class="divider"></div>

        <x-form wire:submit="searchPoll">
            @csrf

            <x-input label="{{ __('sites/poll.email') }}"
                     class="input input-bordered w-full" wire:model="email" required/>

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
                <x-button class="btn btn-success" label="{{ __('sites/poll.find_poll.buttons.search') }}"
                          type="submit" spinner="searchPoll">
                </x-button>
            </div>
        </x-form>

        @if($polls)
            <div class="divider mt-4"></div>

            <table class="table table-zebra">
                <!-- head -->
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('sites/poll.table.title') }}</th>
                    <th>{{ __('sites/poll.table.description') }}</th>
                    <th>{{ __('sites/poll.table.end_date') }}</th>
                    <th>{{ __('messages.table.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($polls as $poll)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $poll->title }}</td>
                        <td>{{ $poll->description }}</td>
                        <td>{{ date('d.m.Y', strtotime($poll->end_date)) }}</td>
                        <td>
                            <a href="{{ route('polls.view', ['viewSecret' => $poll->view_secret]) }}" target="_blank"><i
                                    class="icon-eye cursor-pointer text-blue-600"></i></a>
                            <a href="{{ route('polls.admin', ['adminSecret' => $poll->admin_secret]) }}"
                               target="_blank"><i class="icon-settings cursor-pointer text-orange-600"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>
