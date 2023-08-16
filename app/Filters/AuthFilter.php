<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        try {

            helper('jwt');

            $authHeader = $request->getServer('HTTP_AUTHORIZATION');
            $jwt = getJWT($authHeader);
    
            if (empty($jwt))
                return \Config\Services::response()->setJSON([
                    'code' => 401,
                    'msg' => 'No ha proveido un token'
                ])->setStatusCode(401);

            $decoded = getJWTdecoded($jwt);

            $nom_usuario = $decoded->data->nom_usuario;

            $model = model(\App\Models\UsuarioModel::class);
            $usuario = $model->where('nom_usuario', $nom_usuario)->first();

            if (!isset($usuario))
                return \Config\Services::response()->setJSON([
                    'code' => 401,
                    'msg' => 'No tienes autorizacion',
                ])->setStatusCode(401);
        }
        catch (\Firebase\JWT\ExpiredException $ee) {
            return \Config\Services::response()->setJSON([
                'code' => 500,
                'msg' => 'Token expirado',
            ])->setStatusCode(500);
        }
        catch (\Firebase\JWT\SignatureInvalidException $sie) {
            return \Config\Services::response()->setJSON([
                'code' => 500,
                'msg' => 'Token invalido',
            ])->setStatusCode(500);   
        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
