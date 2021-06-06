<?php

namespace App\Responses;

class JsonResponse extends AbstractResponse
{
    private int $statusCode;
    private array $data;

    /**
     * __construct
     *
     * @param  int $statusCode
     * @param  array $data
     * @return void
     */
    public function __construct(int $statusCode, array $data = [])
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    /**
     * statusCode
     *
     * @return int
     */
    public function statusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * render
     *
     * @return mixed json
     */
    public function render(): mixed
    {
        header('Content-Type: application/json');
        header(HttpResponse::HTTP_CODE[$this->statusCode], true, $this->statusCode);
        echo json_encode($this->data);

        return true;
    }
}
