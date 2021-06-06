<?php

namespace App\Responses;

class HttpResponse extends AbstractResponse
{
    private int $statusCode;
    private string $view;
    private string $template;
    private array $data;

    const HTTP_CODE = [
        200 => 'OK',
        400 => 'Bad Request'
    ];

    /**
     * __construct
     * @param  int $statusCode
     * @param  string $view
     * @param  string $template
     * @param  array $data
     * @return void
     */
    public function __construct(int $statusCode, string $view, string $template, array $data = [])
    {
        $this->statusCode = $statusCode;
        $this->view = $view;
        $this->template = $template;
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
     * @return mixed
     */
    public function render(): mixed
    {
        extract($this->data);

        ob_start();
        require __DIR__ . "/../Views/{$this->view}.php";
        $content = ob_get_clean();

        ob_start();
        require __DIR__ . "/../Views/Layouts/{$this->template}.php";
        $finalContent = ob_get_clean();

        header(self::HTTP_CODE[$this->statusCode], true, $this->statusCode);
        echo $finalContent;

        return true;
    }
}
