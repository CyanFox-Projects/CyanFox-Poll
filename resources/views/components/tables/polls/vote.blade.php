<button class="btn btn-success"
        @if($poll->end_date < now())
            disabled
        @else
            wire:click="$dispatch('openModal', { component: 'components.modals.polls.add-poll-vote', arguments: { viewSecret: '{{ $poll->view_secret }}' }})"
    @endif>
    @if($poll->end_date < now())
        {{ __('sites/poll.vote.poll_ended') }}
    @else
        {{ __('sites/poll.vote.buttons.vote') }}
    @endif
</button>
