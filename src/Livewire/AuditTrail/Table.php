<?php

namespace XtendLunar\Addons\UserAuditTrail\Livewire\AuditTrail;

use App\Models\User;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Component;
use XtendLunar\Addons\UserAuditTrail\Models\UserAuditTrail;

class Table extends Component implements HasTable
{
    use InteractsWithTable;

    public function getTableQuery(): Builder|Relation
    {
        return UserAuditTrail::query();
    }

    public function getTableColumns(): array
    {
        return [
            IconColumn::make('user_id')
                ->options([
                    'heroicon-o-x-circle',
                    'heroicon-o-check' => fn ($state, $record): bool => $record->user_id > 0,
                ])
                ->colors([
                    'secondary',
                    'danger' => 'draft',
                    'warning' => 'reviewing',
                    'success' => 'published',
                ]),
            TextColumn::make('ip_address'),
            TextColumn::make('country'),
            TextColumn::make('device'),
            TextColumn::make('location')->wrap(),
            TextColumn::make('download_speed')
                ->label('Est. Download Speed')
                ->formatStateUsing(fn ($state, $record) => $record->estimated_download_speed . ' Mbps'),
            BadgeColumn::make('events_count')
                ->counts('events'),
        ];
    }

    public function getTableActions(): array
    {
        return [
            ViewAction::make()
                ->url(fn($record) => $record->link)
                ->modalContent(fn($record) => view('xtend-lunar-user-audit-trail::livewire.pages.user-audit-trail.detail', [
                    'userAuditTrail' => $record,
                ])),
        ];
    }

    public function render()
    {
        return view('adminhub::livewire.components.tables.base-table')
            ->layout('adminhub::layouts.base');
    }
}
