<?php

namespace XtendLunar\Addons\UserAuditTrail\Livewire\AuditTrail;

use App\Models\User;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Component;

class Table extends Component implements HasTable
{
    use InteractsWithTable;

    public function getTableQuery(): Builder|Relation
    {
        return User::query();
    }

    public function getTableColumns(): array
    {
        return [

        ];
    }

    public function getTableActions(): array
    {
        return [
            ViewAction::make()->url(fn($record) => $record->link)->openUrlInNewTab(),
        ];
    }

    public function render()
    {
        return view('adminhub::livewire.components.tables.base-table')
            ->layout('adminhub::layouts.base');
    }
}
