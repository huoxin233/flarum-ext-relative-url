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

use Flarum\Extend;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__ . '/js/dist/admin.js'),

    new Extend\Locales(__DIR__ . '/locale'),

    (new Extend\Formatter)
        ->render(RelativeUrlTransformer::class),
];