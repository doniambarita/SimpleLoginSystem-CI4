<?php

namespace App\Controllers;
use App\Models\UserModel;

class Users extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Halaman Login'
		];
		helper(['form']);
		
		// Jadi kalo misal gw ke halaman login kan itu method nya masih get , mk if di bawah ini akan di lewati dan 
		// lnsgun mengarah ke halaman login nya , jika di halaman login gw sudah menekan button , maka akan mengarah ke 
		// method index dan if di bawah ini akan di jalankan, krn button yg gw pencet itu masuknya ke form post 
		if ($this->request->getMethod() == 'post') {
			// lakukan validation di sini
			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
			];
			// Jadi gw buat method bari namanya validateUser[email,password] , yg di dalam nya ada 2 parameter, kedua
			// parameter nya adalah nama field inputannya yg ada di form login
			// Nah krn gw buat method sendiri yaitu validateUser[email,password] , yg dimana method yg gw buat ini tidak di
			// sediakan oleh CI , maka method ini akan gw buat sendiri di dalam folder app/validation/userrules 

			$errors = [
				// Krn gw nge custom validateUser, mk CI tidak punya error , maka di sini gw harus buat pesan 
				// error sendiri sprti di bawah ini
				'password' => [
					'validateUser' => 'Email or Password don\'t match'
				]
			];

			if (!$this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();
				
				// Jadi gw ambil data 1 baris untuk email yg tadi sudah tervalidasi, yg nnti akan di pake di dashboard
				$user = $model->where('email', $this->request->getVar('email'))
											->first();

				// Jadi kalo hasilnya tervalidasi , maka gw akan membuat session untuk user, yg nnti method session 
				// untuk user nya gw buat terpisah , dan di bawah ini gw ngirim data user ke method setUserSession
				$this->setUserSession($user);

				// Jika session di atas sudah selesai di set maka lempar / arahkan ke halaman dashboard
				return redirect()->to('/dashboard');

			}
		}

		echo view('templates/header', $data);
		echo view('login');
		echo view('templates/footer');
	}

	private function setUserSession($user){
		
		$data = [
			'id' => $user['id'],
			'firstname' => $user['firstname'],
			'lastname' => $user['lastname'],
			'email' => $user['email'],
			'isLoggedIn' => true, // Untuk memastikan kalo masuk ke dashboard, isLoggedIn nya harus bernilai true
		];

		// Set session nya dengan mengirimkan array $data , yg nntinya akan di get di halaman dashboard
		session()->set($data);
		
		// Krn di buat session user nya, cukup return true saja agar di else method index , si redirect dashboard 
		// nya di jalankan
		return true;
	}

    public function register()
    {
        $data = [
			'title' => 'Halaman Register'
		];
		// Agar bisa menggunakan set_value , maka harus di perlukan helper untuk form ,dan code helper nya di bagian atas
		// Jadi sebelum memakai set_value di halaman register , maka harus di muat dulu terlebih dahulu fungsi helper buat 
		// formnya
        helper(['form']);

		// Jadi cek jika form register itu menggunakan method post maka gw buat rules utk memberi aturan pada isian formnya
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
				'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
				'password' => 'required|min_length[8]|max_length[255]',
				'password_confirm' => 'matches[password]',
			];
			
			// Jadi jika tidak valid maka akan gw lempar ke halaman register dgn mengirimkan variabel yg berisi error,
			// yg nntinya akan di tampilkan/dipakai di halaman regsiter
			if (!$this->validate($rules)) {
				// Tapi biasanya kalo lu udh make withInput(), mk yg validation(), dan validator itu ga perlu,
				// krn udh ad withInput
				// Jd ini gw ngambil dulu pesan error nya, trus simpen ke variabel , nnti baru di pake di view register
				$data['validation'] = \Config\Services::validation(); 
				// atau bisa juga ky di bawah ini
				// $data['validation'] = $this->validator;
			}else{
				$model = new UserModel();

				$newData = [
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
				];
				$model->save($newData);
				// session nya di simpan variabel dulu juga bisa ky di bawah ini atau juga bisa lnsugn di pake juga bisa
				// $session = session();
				// $session->setFlashdata('success', 'Successful Registration');
				session()->setFlashdata('success', 'Successful Registration');
				return redirect()->to('/');

			}
    	}
		echo view('templates/header', $data);
		echo view('register');
		echo view('templates/footer');

	}

	public function profile(){
		
		$data = [
			'title' => 'Halaman Profile'
		];
		helper(['form']);

		// instansiasi class UserModel untuk mengupdate data , dan mengambil 1 baris data berdasarkan id
		$model = new UserModel();

		if ($this->request->getMethod() == 'post') {
			// lakukan validation di sini

			// Buat rules untuk firstname dan lastname terlebih dhulu
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
				];
			
			// Cek jika data password yg di kirim oleh form nya tidak sama dengan kosong, maka gw akan membuat rules
			// untuk password dan password_confirm yg di masukkan ke dalm variabel $rules.
			if($this->request->getPost('password') != ''){
				$rules['password'] = 'required|min_length[8]|max_length[255]';
				$rules['password_confirm'] = 'matches[password]';
			}

			// Jadi jika hasil di atas false maka, akan masuk ke dalam if di bawah ini, tpi klo true akan masuk ke else
			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				// Nah getPost ini adalah untuk mengambil inputan form yg method nya khusus post , nah kalo getVar() itu
				// lebih mudah krn dia bisa buat form post atau get tpi disini gw coba yg getPost agar lebih spesifik
				$newData = [
					// Krn di dalam controller index gw sudah ngeset session nya , dan juga kan profile dan dashboard itu
					// masih 1 halaman , cuman beda nya di content doang , nah kan session di kirim ke dashboard , 
					// sedangkan dashboard di susun dengan header dan footer , brrti header dan footer nerima session juga
					// kan, nah krn header dan footer nerima seession, trus si profile masih dalam 1 header dan footer dgn
					// dashboard , mka si method profile masih bisa juga pake session juga. Semoga Paham
					'id' => session()->get('id'),
					'firstname' => $this->request->getPost('firstname'),
					'lastname' => $this->request->getPost('lastname'),
					];

					// Jadi jika password nya tidak kosong maka akan gw masukkan ke dalam variabel $newData
					if($this->request->getPost('password') != ''){
						$newData['password'] = $this->request->getPost('password');
					}
				
				// Jadi save ini sangat pinter , krn jika gw menggunakan save dan data yg di kirim kan di dalam parameter
				// itu terdapat data id nya , mk save ini akan melakukan update , tetapi jika data yg dikirim lewat parameter
				// nya tidak terdapat id , mk save akan melakukan insert
				$model->save($newData);

				// Buat session untuk flashdata
				session()->setFlashdata('success', 'Successfuly Updated');

				// Redirect ini lsngung menuju ke folder views bisa lnsung mengarah ke '/profile'
				return redirect()->to('/profile');

			}
		}

		// Ambil 1 baris data yg tadi digunakan untuk login berdasarkan id nya, di ingatkan lagi, id di dapat dari session
		// data user nnti akan di dalam halaman profile
		$data['user'] = $model->where('id', session()->get('id'))->first();

		echo view('templates/header', $data);
		echo view('profile');
		echo view('templates/footer');
	}

	public function logout(){
		// Jadi jika pencet tombol logout, maka semua session yg ada akan di hapus dan akan di arahkan ke halaman login
		session()->destroy();
		return redirect()->to('/');
	}


}
