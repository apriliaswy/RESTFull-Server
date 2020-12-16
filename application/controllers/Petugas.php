<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
   
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


    class Petugas extends REST_Controller 
    {
            function __construct()
             {
                parent::__construct();
                $this->load->model('Petugas_model', 'pts');
            }

        public function index_get()
        {
            $id = $this->get('id');
            if ($id == null) 
            {
                $petugas = $this->pts->getPetugas();
            }
            else
            {
                $petugas = $this->pts->getPetugas($id);
            }
            if($petugas)
            {
                $this->response([
                    'status' => true,
                    'data' => $petugas
                ], REST_Controller::HTTP_OK);
            }
            else
            {
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        public function index_delete()
        {
            $id = $this->delete('id');
            if($id == null)
            {
                $this->response([
                    'status' => false,
                    'message' => 'provide an id'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
            else
            {
                if($this->pts->deletePetugas($id)> 0)
                {
                    $this->response([
                        'status' => true,
                        'id' => $id,
                        'message' => 'delete success'
                    ], REST_Controller::HTTP_NO_CONTENT);
                }
                else
                {
                    $this->response([
                        'status' => false,
                        'message' =>'id not found'
                    ], REST_Controller::HTTP_NOT_FOUND);
                }

            }
        }

        public function index_post()
        {
            $data = [
                'id_petugas' => $this->post('id_petugas'),
                'driver' => $this->post('driver'),
                'nopol' => $this->post('nopol')
            ];
            if ($this->pts->createPetugas($data) > 0) 
            {
                $this->response([
                    'status' => true,
                    'message' => 'new mahasiswa has been created'
                ], REST_Controller::HTTP_CREATED);
            }
            else
            {
                $this->response([
                    'status' => false,
                    'message' => 'failed create data'
                ], REST_Controller::HTTP_NOT_FOUND);

            }
        }

        public function index_put()
        {
            $id = $this->put('id');
            $data = [
                'id_petugas' => $this->put('id_petugas'),
                'driver' => $this->put('driver'),
                'nopol' => $this->put('nopol')
            ];
            if ($this->pts->updatePetugas($data, $id) > 0)
            {
                $this->response([
                    'status' => true,
                    'message' => 'update petugas has been updated'
                ], REST_Controller::HTTP_NO_CONTENT); 
            }
            else
            {
                $this->response([
                    'status' => false,
                    'message' => 'failed to update data'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
?>