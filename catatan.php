<?php 



/*

Jadi jika user belum login , mk gw tidak akan memberikan akses ke halaman dashboard ataupun halaman login,
CI4 sudah menyediakan auth dengan menggunakan filters



filer adalah class yg simple , filter ini meng implements dari interface FilterInterface, untuk lebih jelas
lihat dokumentasi nya di bagian Controller Filters

Jadi filter ini akan di jalankan sebelum atau stelah controller di jalankan

Jai gw buat filter itu di dalam folder app/filters , nah di dalam folder filters ini bisa gw buat file2 untuk nge 
filter url2 nya



Nah langkah pertama cara menggunakan filter nya adalah gw menambahkan di dalam file routes.php , jadi tinggal tambahin
ajh di parameter ketiga nya , contoh ky di bawah ini : 
$routes->match(['get', 'post'],'/profile', 'Users::profile', ['filter' => 'auth']);

Jadi route di atas bacanya adalah : kalo gw mengarah ke controller /profile , yg dimana controller memperbolehkan 
profile ini bisa dgn get sebelum melakukan update data , atau post sesudah melakukan update , Nah untuk parameter 
ketiga nya kan ada ['filter' => 'auth'] , nah itu adalah jika si user mau masuk ke dalam controller /profile , maka
terlebih dahulu akan melakukan filter menggunakan aliases auth di dalam app/config/filters.php , ngga cuman 
sebelum , sesudah juga di lakukan , jika gw membuat logic nya , krn gw buat logic nya hanya pada sebelum , maka 
sebelum di jalankan controller nya , maka gw lakukan filter





Jadi file UsersCheck itu gw posisikan untuk semua url , jadi di halaman apapun , kalo misal mau akses url yg segment 1 nya
users atau Users dari halaman apapun, mk otomatis filter di UserCheck.php akan di jalnkan







































































*/

?>