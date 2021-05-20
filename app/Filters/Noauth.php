<?php 
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Noauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = NULL)
    {
        // Do something here

        // Jadi jika user sudah login , maka akan gw arahkan ke halaman dashboard, tapi jika user nya tidak / belum 
        // login , maka kondisi ini di abaikan / di lewat kan, krn hasilnya hasilnya false 
        if(session()->get('isLoggedIn')){
          return redirect()->to('/dashboard');
        }

    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
        // Do something here
    }
}