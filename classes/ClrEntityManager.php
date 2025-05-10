<?php

namespace Clr;

use Clr\PostType\ClrProduct;
use Clr\PostType\ClrIngredient;

class ClrEntityManager {

	public static function init() {
		self::setup_post_types();
	}
	public static function setup_post_types() {
		ClrProduct::setup();
		ClrIngredient::setup();
	}
}