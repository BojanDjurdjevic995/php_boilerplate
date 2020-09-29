<?php


namespace App\Controllers;

use Illuminate\Pagination\LengthAwarePaginator as MainLengthAwarePaginator;
use Illuminate\Support\HtmlString;

class LengthAwarePaginator extends MainLengthAwarePaginator
{
    /**
     * Render the paginator using the given view.
     *
     * @param  string|null  $view
     * @param  array  $data
     * @return \Illuminate\Support\HtmlString
     */
    public function render($view = null, $data = [])
    {
        return new HtmlString($this->viewFactoryMake($this, $this->elements(), $view));
    }

    public function viewFactoryMake($paginator, $elemets, $view)
    {
        if (!$view)
            $view = 'bootstrap-paginate';
        return view('paginate/' . $view, ['paginator' => $paginator, 'elemets' => $elemets]);
    }
}