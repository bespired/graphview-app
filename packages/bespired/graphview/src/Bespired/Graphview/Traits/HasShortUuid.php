<?php

namespace Bespired\Graphview\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait HasShortUuid {

	protected static $local;

	protected static function bootHasShortUuid() {
		static::creating(function (Model $model) {
			if ($model->{$model->getKeyName()}) {
				return;
			}
			$prefix = isset($model->prfx) ? strtolower($model->prfx) : '';
			//$model->{$model->getKeyName()} = $prefix . static::encodeUuid(Uuid::uuid1());
			$model->{$model->getKeyName()} = $prefix . static::uuid();
		});
	}

	public static function convBase($val, $pad) {
		$toStr = str_split('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz');
		$c = count($toStr);
		$r = '';
		do {
			$r = $toStr[$val % $c] . $r;
			$val = (int) ($val / $c);
		} while ($val > 0);
		return str_pad($r, $pad, '0', STR_PAD_LEFT);
	}

	public static function baseConv($str, $max) {
		$r = 0;
		foreach (str_split($str) as $chr) {
			$r = 8 * (($r + ord($chr)) % $max);
		}
		return $r;
	}

	public static function uuid() {
		list($usec, $sec) = explode(" ", microtime());

		if (!self::$local) {
			self::$local = str_random(2);
		}
		$code = '';
		$code .= self::convBase(self::baseConv($_SERVER['HTTP_USER_AGENT'], 60), 3);
		$code .= self::convBase(date('z') . date('y'), 3);
		$code .= self::convBase($sec % 60, 1);
		$code .= '-';
		$code .= self::$local;
		$code .= str_random(2);
		$code .= self::convBase(date('B'), 2);
		$code .= self::convBase(date('h') . date('i'), 2);
		$code .= '-';
		$code .= str_random(2);
		$code .= self::convBase((int) (10000 * $usec), 3);
		$code .= self::convBase(self::baseConv($_SERVER['REQUEST_TIME'], 60), 3);

		return ($code);
	}

	public function getRouteKeyName() {
		return 'suid';
	}

	public function getIncrementing() {
		return false;
	}

}
