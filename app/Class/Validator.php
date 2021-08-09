<?php 
namespace App\Class;

use App\Database\Database;

class Validator {

    private array $data = [];
    private array $errors;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    private function getInput(string $input): string|null
    {
        if (!isset($this->data[$input])) {
            return null;
        }
        return $this->data[$input];
    }

    public function alphaNumeriQ(string $input, string $errorMessage): void
    {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $this->getInput($input))) {
            $this->errors[$input] = $errorMessage;
        }
    }

    public function uniq(string $input, Database $db, string $table, string $errorMessage): void
    {
        $record = $db->query("SELECT id FROM $table WHERE $input = ?", [$this->getInput($input) ])->fetch();
        if ($record) {
            $this->errors[$input] = $errorMessage;
        }
    }

    public function email(string $input, string $errorMessage): void
    {
        if (!filter_var($this->getInput($input), FILTER_VALIDATE_EMAIL)) {
            $this->errors[$input] = $errorMessage;
        }
    }

    /**
     * Vérification du password and passwordConfirm
     */
    public function confirmedPassword(string $input, string $errorMessage)
    {
        $value = $this->getInput($input);
        if (empty($value) || $value != $this->getInput($input . '_confirm')){
            $this->errors[$input] = $errorMessage;
        }
    }

    public function isValid(): bool
    {
        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

}