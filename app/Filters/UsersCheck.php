<?php 
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UsersCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = NULL)
    {

        // Jadi filter UsersCheck ini adalah untuk membuat jika user mengakses lewat users/ atau Users/ , nah antara
        // 2 itu akan gw cegah , krn bisa ajah user nya akses segment pertama nya ky 2 contoh di atas

        // If segment 1 == users || segment 1 == Users
        // akan gw redirect ke segment ke 2
        $uri = service('uri');
        if($uri->getSegment(1) == 'users' || $uri->getSegment(1) == 'Users'){
          // Cek segment ke 2 nya apakah kosong atau tidak, jika tidak ada maka akan di redirect halaman utama, jika
          // ada maka akan di redirect ke halaman utama slash (/) segment ke 2 nya
          if($uri->getSegment(2) == '')
            $segment = '/';
          else
            $segment = '/'.$uri->getSegment(2);

          return redirect()->to($segment);

        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
        // Do something here
    }
}