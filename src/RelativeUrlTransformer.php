<?php

/*
 * This file is part of huoxin/relative-url.
 *
 * Copyright (c) 2025 huoxin.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Huoxin\RelativeUrl;

use Flarum\Settings\SettingsRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use s9e\TextFormatter\Renderer;
use s9e\TextFormatter\Utils;

class RelativeUrlTransformer
{
    protected static ?array $prefixes = null;

    public function __construct(protected SettingsRepositoryInterface $settings)
    {
    }

    public function __invoke(Renderer $renderer, mixed $context, string $xml, ?ServerRequestInterface $request): string
    {
        $prefixes = $this->getPrefixes();

        if (empty($prefixes)) {
            return $xml;
        }

        $xml = $this->transformUrl($xml, $prefixes);
        $this->transformMention($renderer, $prefixes);

        return $xml;
    }

    protected function transformUrl(string $xml, array $prefixes): string
    {
        if (strpos($xml, '<URL') === false) {
            return $xml;
        }

        return Utils::replaceAttributes($xml, 'URL', function (array $attributes) use ($prefixes) {
            if (isset($attributes['url'])) {
                $attributes['url'] = $this->toRelative($attributes['url'], $prefixes);
            }
            return $attributes;
        });
    }

    protected function transformMention(Renderer $renderer, array $prefixes): void
    {
        $profileUrl = $renderer->getParameter('PROFILE_URL');
        $discussionUrl = $renderer->getParameter('DISCUSSION_URL');

        if ($profileUrl) {
            $renderer->setParameter('PROFILE_URL', $this->toRelative($profileUrl, $prefixes));
        }
        if ($discussionUrl) {
            $renderer->setParameter('DISCUSSION_URL', $this->toRelative($discussionUrl, $prefixes));
        }
    }

    protected function toRelative(string $url, array $prefixes): string
    {
        foreach ($prefixes as $prefix) {
            $prefixLen = strlen($prefix);
            // Case-insensitive prefix check
            if (strncasecmp($url, $prefix, $prefixLen) === 0) {
                // Ensure the match is exact or followed by a slash (prevents partial domain match)
                $rest = substr($url, $prefixLen);

                if ($rest === '' || str_starts_with($rest, '/')) {
                    return $rest ?: '/';
                }
            }
        }
        return $url;
    }

    protected function getPrefixes(): array
    {
        if (self::$prefixes === null) {
            $config = trim($this->settings->get('huoxin-relative-url.internal_domains', ''));
            self::$prefixes = [];

            foreach ($config ? array_filter(array_map('trim', explode("\n", $config))) : [] as $domain) {
                self::$prefixes[] = 'https://' . $domain;
                self::$prefixes[] = 'http://' . $domain;
            }
        }

        return self::$prefixes;
    }
}
