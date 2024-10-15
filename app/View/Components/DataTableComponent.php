<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTableComponent extends Component
{
    public string $tableId;
    public string $ajaxRoute;
    public int $totalProducts;
    public array $columns;

    /**
     * Create a new component instance.
     *
     * @param string $tableId
     * @param string $ajaxRoute
     * @param int $totalProducts
     * @param array $columns
     */
    public function __construct(string $tableId, string $ajaxRoute, int $totalProducts, array $columns)
    {
        $this->tableId = $tableId;
        $this->ajaxRoute = $ajaxRoute;
        $this->totalProducts = $totalProducts;
        $this->columns = $columns;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.data-table-component');
    }
}
