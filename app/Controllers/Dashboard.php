<?php

namespace App\Controllers;

use App\Models\CoronaModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $model = new CoronaModel();
        $data = [
            'corona' => $model->asObject()->paginate(10),
            'pager' => $model->pager
        ];
        echo view('dashboard', $data);
    }
}
