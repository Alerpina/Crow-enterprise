<?php

namespace App\Services;

use App\Services\Bling\DTOs\ProductDTO;
use App\Services\Bling\DTOs\StockDTO;
use App\Services\Bling\Enums\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Bling
{
    private string $base_url = "https://www.bling.com.br/Api/v3/";
    private string $auth_url;
    public $access_token;
    public $refresh_token;

    private string $client_id;
    private string $client_secret;
    private string $state;

    public function __construct(string $access_token = null, string $refresh_token = null)
    {
        $this->auth_url = $this->base_url . "oauth/";
        $this->client_id = config('services.bling.id');
        $this->client_secret = config('services.bling.secret');
        $this->state = config('services.bling.state');
        $this->access_token = $access_token;
        $this->refresh_token = $refresh_token;
    }

    public function authorize(): RedirectResponse
    {
        $params = [
            'response_type' => 'code',
            'client_id' => $this->client_id,
            'state' => $this->state,
        ];

        return redirect()->away($this->auth_url . 'authorize?' . http_build_query($params));
    }

    public function generateTokens(string $code): void
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->client_id . ':' . $this->client_secret)
        ])->post($this->auth_url . 'token', [
            'grant_type' => 'authorization_code',
            'code' => $code,
        ])->collect();

        $this->access_token = $response->get('access_token');
        $this->refresh_token = $response->get('refresh_token');
    }

    public function isValidState(string $state)
    {
        return $this->state === $state;
    }

    public function refreshAccessToken(): void
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->client_id . ':' . $this->client_secret)
        ])->post($this->auth_url . 'token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->refresh_token,
        ])->collect();

        $this->access_token = $response->get('access_token');
    }

    private function isSetAccessToken(): void
    {
        if (!$this->access_token) {
            throw new \Exception("The access token isn't defined");
        }
    }

    #Category section
    /**
     * @param string $name The name of category
     * @return int The id of category in Bling!
     */
    public function createCategory(string $name): int
    {
        $this->isSetAccessToken();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token
        ])->asJson()->post($this->base_url . 'categorias/produtos', [
            'descricao' => $name
        ])->collect();

        return $response->get('data')['id'];
    }

    /**
     * @param string $name The name of category
     * @param int $id The id of category in Bling!
     */
    public function updateCategory(string $name, int $id): void
    {
        $this->isSetAccessToken();

        Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token
        ])->asJson()->put($this->base_url . 'categorias/produtos/' . $id, [
            'descricao' => $name
        ]);
    }

    /**
     * @param int $id The id of category in Bling!
     */
    public function deleteCategory(int $id): void
    {
        $this->isSetAccessToken();

        Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token
        ])->delete($this->base_url . 'categorias/produtos/' . $id);
    }

    #Product section
    /**
     * @param ProductDTO $product The product data
     * @return int The id of category in Bling!
     */
    public function createProduct(ProductDTO $product): int
    {
        $this->isSetAccessToken();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token
        ])->asJson()->post($this->base_url . 'produtos', $product->toArray())->collect();

        return $response->get('data')['id'];
    }

    /**
     * @param ProductDTO $product The product data
     * @param int $id The id of product in Bling!
     */
    public function updateProduct(ProductDTO $product, int $id): void
    {
        $this->isSetAccessToken();

        Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token
        ])->asJson()->put($this->base_url . 'produtos/' . $id, $product->toArray());
    }

    /**
     * @param int $id The id of product in Bling!
     * @param App\Services\Bling\Enums\Status $status The status to change
     */
    public function changeProductStatus(int $id, Status $status): void
    {
        $this->isSetAccessToken();

        Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token
        ])->asJson()->patch($this->base_url . 'produtos/' . $id . '/situacoes', [
            'situacao' => $status->value,
        ]);
    }

    /**
     * @param int $id The id of product in Bling!
     */
    public function deleteProduct(int $id): void
    {
        $this->isSetAccessToken();

        Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token
        ])->delete($this->base_url . 'produtos/' . $id);
    }

    #Warehouse section
    /**
     * @return array Response data of request
     */
    public function getWarehouses(): array
    {
        $this->isSetAccessToken();

        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token
        ])->get($this->base_url . 'depositos')->collect()->toArray();
    }

    #Stock section
    /**
     * 
     * @param App\Services\Bling\DTOs\StockDTO $stock Data of stock
     */
    public function createStock(StockDTO $stock): void
    {
        $this->isSetAccessToken();

        Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token
        ])->post($this->base_url . 'estoques', $stock->toArray());
    }

    /**
     * @param array $ids The ids of products
     * @return array
     */
    public function getStocks(array $ids): array
    {
        $this->isSetAccessToken();

        $query = http_build_query(['idsProdutos' => $ids]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->access_token
        ])->get($this->base_url . 'estoques/saldos?', preg_replace('/\%5B\d+\%5D/', '%5B%5D', $query))->collect();

        return $response->get('data');
    }
}
