# Relative Url
[English](README.md) | [简体中文](README.zh-CN.md)

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/huoxin/relative-url.svg)](https://packagist.org/packages/huoxin/relative-url) [![Total Downloads](https://img.shields.io/packagist/dt/huoxin/relative-url.svg)](https://packagist.org/packages/huoxin/relative-url)

A [Flarum](https://flarum.org) extension that converts internal URLs to relative paths for multi-domain support.

## The Problem

When your Flarum forum setup multi-domain by editing `config.php`:
```
'url' => 'https://' . \Illuminate\Support\Arr::get($_SERVER, 'HTTP_HOST', 'forum1.org'),
```

If an user post links with absolute URLs:

```
Check out https://forum1.org/d/123
```

Another user on `forum2.org` clicks this link, they're redirected to `forum1.org`, losing their session and cookies.

## The Solution

This extension automatically converts internal URLs to relative paths:

- `https://forum1.org/d/123` → `/d/123`
- `https://forum2.org/u/username` → `/u/username`

Users stay on their current domain when clicking internal links.

## Features

- ✅ Converts regular links in post content
- ✅ Converts mention URLs (workaround for https://github.com/flarum/framework/issues/4226 )

## Installation

Install with composer:

```sh
composer require huoxin/relative-url:"*"
```

## Configuration

1. Go to **Admin → Extensions → Relative Url**
2. Add your internal domains (one per line):

```
forum1.org
forum2.org
forum.example.com
```

## Updating

```sh
composer update huoxin/relative-url:"*"
php flarum migrate
php flarum cache:clear
```

## Links

- [Packagist](https://packagist.org/packages/huoxin/relative-url)
- [GitHub](https://github.com/huoxin233/flarum-ext-relative-url)
- [Discuss](https://discuss.flarum.org/d/38532-relative-url)
