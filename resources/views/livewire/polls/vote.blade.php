<div class="md:mx-20 md:my-10 sm:m-10">
    <div class="card-body">
        <span class="font-bold text-xl">{{ __('sites/poll.vote.title', ['title' => $poll->title]) }}</span>

        <div class="divider"></div>

        <div class="mt-4">
            <livewire:components.table.polls.poll-vote-table :pollId="$poll->id"/>
        </div>
    </div>
</div>
