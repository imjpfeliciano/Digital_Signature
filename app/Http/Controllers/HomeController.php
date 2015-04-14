<?php namespace App\Http\Controllers;


use App\Archivo;
use App\Compartido;
use App\User;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Input;
use Response;
use Crypt;
use Hash;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}

	public function upload_get(){
		return view('client/upload');
	}

	public function upload_post(){
		if(Input::hasFile('data')){
			$file = new Archivo;
			$data = Input::file('data');

			$file->filename 	= Input::get('filename');
			$file->type 		= Input::get('opcion');
			$file->description 	= Input::get('description');
			$file->data 		= base64_encode(file_get_contents($data->getRealPath()));
			$file->mime 		= $data->getMimeType();
			$file->size 		= $data->getSize();
			$file->created_by 	= Auth::user()->id;
			$file->save();

			return Redirect('success');
		
		}
	}

	public function download($id){
		$file = DB::table('files')->where('id', $id)->first();
	
		$response = Response::make(base64_decode($file->data), 200, [
			'Content-Type' => $file->mime,
			'Content-Length' => $file->size, 
			'Content-Disposition' => 'attachment;',
			]);
		//$response->header('Content-Disposition', 'attachment');
		return $response;
	}

	public function success(){
		return view('success');
	}

	public function share($id){
		if(Auth::user()->type == '1' )
			$vecinos = DB::select('select id, username from users where parent = ?;', [Auth::user()->id]);
		else
			$vecinos = DB::select('select id, username from users where parent = ? and id != ?;', [Auth::user()->parent, Auth::user()->id]);

		return view('client/share',['vecinos' => $vecinos, 'archivo' => $id]);
	}

	public function myfiles(){
		$myfiles	= DB::select('select * from files where created_by = ?;', [Auth::user()->id]);
		$shared 	= DB::select('select distinct * from files where id in (select id_file from sharedwith where id_to = ?);', [Auth::user()->id]);

		return view('client/misarchivos', ['myfiles' => $myfiles, 'sharedwithme' => $shared]);
	}

	public function sharewith(){
		if(Auth::user()->type == '1' )
			$vecinos = DB::select('select id, username from users where parent = ?;', [Auth::user()->id]);
		else
			$vecinos = DB::select('select id, username from users where parent = ? and id != ?;', [Auth::user()->parent, Auth::user()->id]);
		
		foreach ($vecinos as $vecino) {
			if(Input::get($vecino->id) === '1'){
				$shared = new Compartido;
				$shared->id_to 		= $vecino->id;
				$shared->id_file 	= Input::get('_file');	
				$shared->save();	
			}
		}

		return Redirect('misArchivos');
	}

	public function create_get(){
		return (Auth::user()->type == 1) ? view('admin/create') : view('errors/403');
	}

	public function create_post(){
		$usuario 			= new User;
		$usuario->username 	= Input::get('username');
		$usuario->email 	= Input::get('email');
		$usuario->password 	= Hash::make(Input::get('password'));
		$usuario->type 		= 0;		//Cliente
		$usuario->parent 	= Auth::user()->id;
		$usuario->save();
		return Redirect('home');
	}
}
