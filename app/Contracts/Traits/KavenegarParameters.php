<?php

namespace Modules\Notifier\Contracts\Traits;

use Illuminate\Contracts\Support\Arrayable;

readonly class KavenegarParameters implements Arrayable
{
    public function __construct(
        private string $token = '',
        private string $token2 = '',
        private string $token3 = '',
        private string $token10 = '',
        private string $token20 = '',
    ) {}

    public static function make(array $parameters): self
    {
        $instance = new static;
        foreach ($parameters as $parameter) {
            if (property_exists($instance, $parameter)) {
                $instance->{$parameter} = $parameter;
            }
        }

        return $instance;
    }

    public function parameters(): array
    {
        return [$this->token, $this->token2, $this->token3, $this->token10, $this->token20];
    }

    public function setToken(string $token): static
    {
        return tap($this, fn () => $this->token = $token);
    }

    public function setToken2(string $token2): static
    {
        return tap($this, fn () => $this->token2 = $token2);
    }

    public function setToken3(string $token3): static
    {
        return tap($this, fn () => $this->token3 = $token3);
    }

    public function setToken10(string $token10): static
    {
        return tap($this, fn () => $this->token10 = $token10);
    }

    public function setToken20(string $token20): static
    {
        return tap($this, fn () => $this->token20 = $token20);
    }

    public function toArray(): array
    {
        return $this->parameters();
    }
}
