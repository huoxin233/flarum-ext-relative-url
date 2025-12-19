# Relative Url
[English](README.md) | [简体中文](README.zh-CN.md)

![License](https://img.shields.io/badge/license-MIT-blue.svg) [![Latest Stable Version](https://img.shields.io/packagist/v/huoxin/relative-url.svg)](https://packagist.org/packages/huoxin/relative-url) [![Total Downloads](https://img.shields.io/packagist/dt/huoxin/relative-url.svg)](https://packagist.org/packages/huoxin/relative-url)

本扩展用于在 **多域名部署** 场景下，将站内的**绝对 URL 自动转换为相对路径**。

## 问题背景

当你的 Flarum 论坛通过修改 `config.php` 配置为 **多域名访问**：
```
'url' => 'https://' . \Illuminate\Support\Arr::get($_SERVER, 'HTTP_HOST', 'forum1.org'),
```

如果用户在帖子中发布了**绝对链接**：

```
肯德基疯狂星期四，速速查看：https://forum1.org/d/123
```

那么当另一位用户在 `forum2.org` 上点击该链接时，会被重定向到 `forum1.org`，从而**丢失当前域名下的登录状态和 Cookie**。

## 解决方案

本扩展会自动将**站内链接**转换为**相对路径**：

- `https://forum1.org/d/123` → `/d/123`
- `https://forum2.org/u/username` → `/u/username`

这样，用户在点击站内链接时，始终会停留在当前访问的域名上。

## 功能

- ✅ 转换帖子内容中的普通链接
- ✅ 转换提及（Mention）生成的链接 (修复 https://github.com/flarum/framework/issues/4226 )

## 安装

使用 Composer 安装：

```sh
composer require huoxin/relative-url:"*"
```

## 配置

1. 前往 **管理后台** → **扩展** → **Relative Url**
2. 添加站内域名（每行一个）：

```
forum1.org
forum2.org
forum.example.com
```

## 更新

```sh
composer update huoxin/relative-url:"*"
php flarum migrate
php flarum cache:clear
```

## 相关链接

- [Packagist](https://packagist.org/packages/huoxin/relative-url)
- [GitHub](https://github.com/huoxin233/flarum-ext-relative-url)
- [Discuss](https://discuss.flarum.org/d/38532-relative-url)
