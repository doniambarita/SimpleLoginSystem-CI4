<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
// Jadi gw nge use 3 class baru di bawah ini
use App\Filters\Auth;
use App\Filters\Noauth;
use App\Filters\UsersCheck;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
		// Nah 3 class yg gw use di paling atas, gw pake untuk membuat aliases ky di bawah ini , nah nama key nya itu 
		// boleh bebas , tetapi gw bikin dia sesuai dengan nama class nya ajh dgn huruf kecil semua
		'auth' 	   => Auth::class,
		'noauth'   => Noauth::class,
		'userscheck' => UsersCheck::class,
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			// jadi filter di bawah ini akan di jalankan secara otomatis, sebelum mengakses controller / halaman, jadi 
			// filter ini akan di terapkan di semua route, di ingatkan lagi ini diterapkan sebelum controller dijalankan
			'userscheck', 
			// 'honeypot',
			// 'csrf',
		],
		'after'  => [
			'toolbar',
			// 'honeypot',
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [];
}
