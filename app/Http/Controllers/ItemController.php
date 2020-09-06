<?php

namespace App\Http\Controllers;

use DB;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ItemController extends Controller {
	private $item_md;

	public function __construct(Item $item_md) {
		$this->item = $item_md;
	}

	public function index() {
		session(['id' => '']);
		$items = $this->item->itemAllGet();
		return view('items.index', compact('items'));
	}

	public function detail($id) {
		session(['id' => $id]);
		$desc = $this->item->itemFind($id);
		if (is_null($desc)) {
			abort(404);
		}
		return view('items.detail', ['item' => $desc]);
	}

}
