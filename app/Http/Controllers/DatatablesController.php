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
				
			                return '
			                	<a  id='.$user->id.' href="'. route('borrarUser',['id'=>$user->id]) .'" class="btn-delete alineado_imagen_centro"><i class="fa fa-trash"></i> </a>'
			                		;			                
			            })
			->setRowClass(function ($user) {
			         //return $user->id % 2 == 0 ? '' : 'table-active';
					 //return 'table-striped';
			     })
			->setRowAttr([
			         'color' => 'red',
			     ])	
	    	->make(true);
	}
	public function deleteRow(Request $request)
	{
		if($request->ajax()){
			$idRow=$request->input('idRow');
			$user = User::find($idRow);
			$user->delete();
			$user_total = User::all()->count();

			return response()->json([
				'total'=> $user_total,
				'message'=> $user->name . '  fue eliminado correctamente'
			]);
		}else return "esto no es ajax";
	}

}
/*
return 
	{!! Form::open(['route' => ['borrarUser',$user->id], 'method' => 'delete']) !!}
	"<a href='#edit-'".$user->id." class='btn-delete alineado_imagen_centro'>"
		<i class='fa fa-trash'></i> 
	</a>
	{!! Form::close() !!}
;
*/