<?php 
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = NULL)
    {
        // Do something here

        // Jadi jika user tidak login , maka akan gw arahkan ke halaman utama yaitu login, tapi jika user nya sudah 
        // login , maka kondisi ini di abaikan / di lewat kan , krn hasilnya false
        if(! session()->get('isLoggedIn')){
          return redirect()->to('/');
        }

    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
        // Do something here
    }
}