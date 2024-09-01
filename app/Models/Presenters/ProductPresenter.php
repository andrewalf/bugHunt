<?php


namespace App\Models\Presenters;


class ProductPresenter extends Presenter
{
    public function name()
    {
        return $this->model->name;
    }

    public function id()
    {
        return $this->model->id;
    }

    public function description()
    {
        return $this->model->description;
    }

    public function price()
    {
        return $this->model->price;
    }

    public function stock()
    {
        return $this->model->stock;
    }

    public function is_visible()
    {
        return $this->model->is_visible == 1 ? "Да" : "нет";
    }
    public function created_at()
    {
        return $this->model->created_at;
    }
}