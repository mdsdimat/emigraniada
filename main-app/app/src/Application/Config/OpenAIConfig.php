<?php

declare(strict_types=1);

namespace App\Application\Config;

use Spiral\Core\InjectableConfig;

class OpenAIConfig extends InjectableConfig
{
    public const CONFIG = 'openai';

    protected array $config = ['open_ai_key' => ''];

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->config['open_ai_key'];
    }
}
