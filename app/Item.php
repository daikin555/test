<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

	public function updateImg($request, int $item_id) {
		$data = Item::find($item_id);
		if (Storage::exists('public/image/' .  $data->image)) {
			Storage::delete('public/image/' . $data->image);
		}
		$path = $request->file('image_file')->store('public/image');
		$item = $this->findOrFail($item_id);
		$item->image = basename($path);
		$item->save();
	}
}
