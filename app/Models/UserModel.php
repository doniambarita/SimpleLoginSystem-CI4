<?php 

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'users';
  // Krn created_at  secara otomatis saat kita registrasi di waktu tertentu , mk tidak perlu di masukan allowed_fields
  // bgtu juga dengan updated_at , krn dia akan di updated secara otomatis saat di halaman profile , krn yg gw 
  // allowed di bawah ini adalah field yg gw bolehin di isi secara manual oleh gw 
  protected $allowedFields = ['firstname', 'lastname', 'email', 'password'];
  // Krn gw pke fitur created_at dan updated_at secara otomatis, mk gw butuh $useTimestamps yg nilainya true, krn kalo
  // nilainya false maka gw jdanya kga butuh created_at dan updated_at secara otomatis
  // protected $useTimestamps = true;
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];


  // Jadi sebelum melakukan save / insert data jlnkan dulu method beforeInsert 
  protected function beforeInsert(array $newData){
    // Hash password sebelum di di insert 
    $newData = $this->passwordHash($newData);
    // Nah key data ini menurut gw masuknya ke sini dulu : ['beforeInsert'] , jadi nya array nya 3 dimensi , secara 
    // otomatis kynya array bagian keduanya bentuknya associative dgn key data , dan array bagian ke 3 data2 nya 
    // yg di kirim dari controller
    $newData['data']['created_at'] = date('Y-m-d H:i:s');

    return $newData;
  }

  // Jadi sebelum melakukan save / update data jlnkan dulu method beforeUpdate
  protected function beforeUpdate(array $newData){
    // Hash password sebelum di update
    $newData = $this->passwordHash($newData);
    // Gw ngebuat manual timestamp nya yg nnti akan di masukkan ke dalam database
    $newData['data']['updated_at'] = date('Y-m-d H:i:s');
    return $newData;
  }

  // Agar lebih rapih, gw pisah untuk hash password nya , dengan membuat method untuk hash password
  protected function passwordHash(array $newData){
    if(isset($newData['data']['password']))
      $newData['data']['password'] = password_hash($newData['data']['password'], PASSWORD_DEFAULT);

      // Jadi kalo pada saat update password nya kosonging , mk hasil yg di kembalikan tetap ada password nya tpi pake
      // password yg sebelumnya , tpi jika ada password mk pake password nya yg baru baik di beforeinsert maupun di
      // beforeupdate
    return $newData;
  }


}