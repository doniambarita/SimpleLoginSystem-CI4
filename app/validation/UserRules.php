<?php
namespace App\Validation;
use App\Models\UserModel;

class UserRules
{

  public function validateUser(string $str, string $fields, array $data){
    // Instansiasi class UserModel
    $model = new UserModel();

    // Jadi kode di dalam variabel user itu adalah dia akan mencari data email , nah data email nya dpt dari $data , 
    // dan nnti akan di cek data email nya ke dalam field email yg ada di dalam database , dan nnti yg akan di tangkap
    // adalah hasil 1 set row baris dari where yg di buat , knp 1 baris ? krn ada first()
    $user = $model->where('email', $data['email'])->first();

    // Penulisan nya bisa ky di atas atau bisa ky di bawah ini
    // $user = $model->where(['email' => $data['email']])->first();

    // Jadi jika hasil dari $user adalah null / false , maka gw akan mereturn false ke validateUser
    if($user == null)
      return false;

    // Jika $user berisi hasil 1 baris data, maka gw akan mengecek apakah sama data pass yg dimasukkan dengan data pass
    // yg ada di database 
    return password_verify($data['password'], $user['password']);
  }
}