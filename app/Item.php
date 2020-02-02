<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	public $timestamps = false;

	public function rules() {
		return [
			'name' => ['required', 'string'],
			'descrip' => ['required', 'string'],
			'price' => ['required', 'integer'],
			'stock' => ['required', 'integer']
		];
	}

	protected $fillable = ['name', 'descrip', 'price', 'stock'];
	protected $table = 'items';

	public function createDb($request) {
		$name = $request->input('name');
		$descrip = $request->input('descrip');
		$price = $request->input('price');
		$stock = $request->input('stock');
		$this->create(compact('name', 'descrip', 'price', 'stock'));
	}
	public function updateDb($id, $request) {
		$item = $this->findOrFail($id);
		$item->name = $request->input('name');
		$item->descrip = $request->input('descrip');
		$item->stock = $request->input('stock');
		$item->save();
	}
}
