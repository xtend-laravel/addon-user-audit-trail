<?php

namespace XtendLunar\Addons\UserAuditTrail\Livewire\AuditTrail;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
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
            TextColumn::make('ip_address')->searchable(),
            TextColumn::make('country'),
            TextColumn::make('region')
                ->formatStateUsing(fn ($state, $record) => $record->region === 'N/A' ? '--' : $record->region),
            TextColumn::make('device'),
            TextColumn::make('location')->wrap(),
            TextColumn::make('download_speed')
                ->label('Est. Download Speed')
                ->formatStateUsing(fn ($state, $record) => $record->estimated_download_speed . ' Mbps'),
            TextColumn::make('avg_site_duration')
                ->label('Avg. Site duration')
                ->formatStateUsing(fn ($state, $record) => $this->getTotalSiteDuration($record)),
            BadgeColumn::make('events_count')
                ->counts('events'),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            Filter::make('created_at')
                ->form([
                    DatePicker::make('created_from')->default(now()->subDays(7)),
                    DatePicker::make('created_until')->default(now()),
                ]),
            TernaryFilter::make('download_speed')
                ->placeholder('Connection speed')
                ->trueLabel('Slow connection speed')
                ->falseLabel('Fast connection speed')
                ->queries(
                    true: fn (Builder $query) => $query
                        ->where('estimated_download_speed', '>', 0)
                        ->where('estimated_download_speed', '<', 50),
                    false: fn (Builder $query) => $query
                        ->where('estimated_download_speed', '>', 50),
                    blank: fn (Builder $query) => $query
                        ->where('estimated_download_speed', '>', 0),
                ),
            SelectFilter::make('country')
                ->options(fn () => UserAuditTrail::query()->distinct()->pluck('country', 'country')->toArray()),

            SelectFilter::make('region')
                ->options(fn () => UserAuditTrail::query()->distinct()->pluck('region', 'region')->toArray()),
        ];
    }

    protected function getTotalSiteDuration(UserAuditTrail $record): string
    {
        $routes = $record->route_tracking;

        if (!$routes) {
            return '0s';
        }

        $totalDuration = 0;

        foreach ($routes as $route) {
            $totalDuration += $route['totalDuration'];
        }

        return $totalDuration . 's';
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
