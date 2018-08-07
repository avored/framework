<?php

namespace AvoRed\Framework\User\Widget;

use AvoRed\Framework\Models\Database\User;
use AvoRed\Framework\Widget\Contracts\Widget as WidgetContract;

class TotalUserWidget implements WidgetContract
{
    /**
     * Widget View Path.
     *
     * @var string
     */
    protected $view = 'avored-framework::widget.total-user';

    /**
     * Widget Label.
     *
     * @var string
     */
    protected $label = 'Total User';

    /**
     * Widget Type.
     *
     * @var string
     */
    protected $type = 'dashboard';

    /**
     * Widget unique identifier.
     *
     * @var string
     */
    protected $identifier = 'total-user';

    public function view()
    {
        return $this->view;
    }

    /*
     * Widget unique identifier
     *
     */
    public function identifier()
    {
        return $this->identifier;
    }

    /*
    * Widget unique identifier
    *
    */
    public function label()
    {
        return $this->label;
    }

    /*
    * Widget unique identifier
    *
    */
    public function type()
    {
        return $this->type;
    }

    /**
     * View Required Parameters.
     *
     * @return array
     */
    public function with()
    {
        $totalUser = User::all()->count();

        return ['totalRegisteredUser' => $totalUser];
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $view = view($this->view())->with($this->with());

        return $view->render();
    }
}
