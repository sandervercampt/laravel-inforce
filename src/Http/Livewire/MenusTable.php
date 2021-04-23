<?php

namespace LLoadoutInforce\Http\Livewire;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use LLoadoutInforce\Models\Menu;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MenusTable extends DataTableComponent
{

    public function query(): Builder
    {
        return Menu::query()
            ->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%')->orWhere('route', 'like', '%'.$term.'%'));

    }

    public function columns(): array
    {

        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('Name', 'name')
                ->sortable(),
            Column::make('Route', 'route')
                ->sortable(),
        ];

    }

    public function getTableRowUrl($row): string
    {
        return route('menu', $row);
    }


}