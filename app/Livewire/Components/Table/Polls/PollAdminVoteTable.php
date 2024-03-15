<?php

namespace App\Livewire\Components\Table\Polls;

use App\Exports\PollVotesExport;
use App\Facades\PollManager;
use App\Models\PollVote;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PollAdminVoteTable extends DataTableComponent
{
    public int $pollId;

    public function builder(): Builder
    {
        return PollVote::query()->where('poll_id', $this->pollId);
    }

    public function bulkActions(): array
    {
        return [
            'export' => __('sites/poll.buttons.export'),
        ];
    }

    public function export(): BinaryFileResponse
    {
        $votes = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new PollVotesExport($votes), 'votes.xlsx');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.table.id'), 'id')
                ->sortable(),
            Column::make(__('sites/poll.table.name'), 'name')
                ->sortable(),
            Column::make(__('sites/poll.table.votes'), 'votes')
                ->format(function ($value) {
                    $array = json_decode($value, true);
                    $formattedString = PollManager::getPollVotesManager(PollManager::findPollById($this->pollId))
                        ->getFormattedVotes($array, '');

                    return rtrim($formattedString, ', ');
                })->html(),
            Column::make(__('messages.table.created_at'), 'created_at')
                ->sortable(),
            Column::make(__('messages.table.updated_at'), 'updated_at')
                ->sortable(),
            Column::make(__('messages.table.actions'))
                ->label(function ($row) {
                    return '<i wire:click="deleteVote(`'.$row->id.'`)" class="icon-trash-2 text-lg text-red-600 cursor-pointer"></i>';
                })->html(),
        ];
    }

    public function deleteVote($id)
    {
        PollManager::getPollVotesManager(PollManager::findPollById($this->pollId))->deleteVote($id);
    }
}
