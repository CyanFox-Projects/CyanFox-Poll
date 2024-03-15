<button class="btn btn-success"
        wire:click="$dispatch('openModal', { component: 'components.modals.polls.add-poll-vote', arguments: { viewSecret: '{{ $viewSecret }}' }})">
    {{ __('sites/poll.vote.buttons.vote') }}</button>
