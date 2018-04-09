<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    /**
	 * Displays datatables front end view
	 *
	 * @return \Illuminate\View\View
	 */

	public function index()
	{
	    return view('datatables.index');
	}

	/**
	 * Process datatables ajax request.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getDatos()
	{
	    return Datatables::of(User::query())
											->addColumn('action', function ($user) {
											                return '<a href="#edit-'.$user->id.'" class="alineado_imagen_centro"><i class="fa fa-trash"></i> </a>'
											                		;
											            })
			    							->setRowClass(function ($user) {
									                return $user->id % 2 == 0 ? '' : 'table-active';
									            })
			    							->setRowAttr([
									                'color' => 'red',
									            ])	
	    									->make(true);
	}


}
