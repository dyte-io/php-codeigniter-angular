<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Meeting extends ResourceController
{

    protected $format    = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        // TODO: implement
        return $this->respond("Hello world", 200);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        return $this->fail(['error' => 'Method not implemented'], 404);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        return $this->fail(['error' => 'Method not implemented'], 404);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $body = json_decode($this->request->getBody(), true);
        // add org id and api key information from https://dev.dyte.io/apikeys
        $orgId = "";
        $apiKey = "";
        $token = "Basic " . base64_encode("$orgId:$apiKey");

        // Initialize HTTP client
        $client = \Config\Services::curlrequest();

        $result = null;

        // Make API call
        try {
            $response = $client->request('POST', 'https://api.dyte.io/v2/meetings', [
                'headers' => [
                    'Authorization' => $token,
                    'Content-Type' => 'application/json',
                ],
                'json' => ['title' => $body['title']]
            ]);

            // Check if request was successful
            if ($response->getStatusCode() === 201) {
                // Get response body
                $result = $response->getBody();
            }
        } catch (\Exception $e) {
            // Handle exception...
        }

        // Return response
        return $this->response->setJSON($result);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        return $this->fail(['error' => 'Method not implemented'], 404);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        return $this->fail(['error' => 'Method not implemented'], 404);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        return $this->fail(['error' => 'Method not implemented'], 404);
    }
}
