<?php

namespace App\Controllers;

use App\Models\ProductModel as Product;
use CodeIgniter\RESTful\ResourceController;

class ProductController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $product = new Product();
        return $this->respond($product->findAll(), 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $product = new Product();
        $data = $product->find($id);
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound('No Product found with id ' . $id);
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $product = new Product();
        $data = [
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
        ];
        $data = json_decode(file_get_contents("php://input"));
        $id = $product->insert($data);
        $data->id = $id;
        return $this->respondCreated($data);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $product = new Product();
        if (!$product->find($id)) {
            return $this->failNotFound('No Product found with id ' . $id);
        }

        $json = $this->request->getJSON();
        $data = [];
        if ($json) {
            $data = [
                'name' => $json->name,
                'description' => $json->description,
                'price' => $json->price,
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'name' => $input['name'],
                'description' => $input['description'],
                'price' => $input['price'],
            ];
        }
        $product->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Product updated successfully'
            ]
        ];
        return $this->respondUpdated($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $product = new Product();
        $data = $product->find($id);
        if ($data) {
            $product->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Product deleted successfully'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Product found with id ' . $id);
        }
    }
}
