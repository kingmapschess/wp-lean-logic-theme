# 🧱 Theme Architecture: Lean Logic

Lean Logic is a component-based WordPress theme built on [Timber](https://timber.github.io/docs/) and [Twig](https://twig.symfony.com/). This document explains the architectural philosophy behind the theme, how Timber and Twig work together, and the pros and cons of this approach.

```text
lean-logic/
├── Components/
│   └── Hero/
│       ├── functions.php
│       ├── style.scss
│       └── script.js
├── views/
│   └── Partials/
│       ├── banner.twig
│       ├── footer.twig
│       ├── header.twig
│       └── nav.twig
├── assets/
│   └── styles/
│       ├── _tokens.scss
│       ├── global.scss
│       └── components.scss
│   └── scripts/
│       └── dark-mode.js
```

---

## ⚙️ Dependencies

Lean Logic relies on a few key tools to stay modular, maintainable, and modern:

| Dependency | Purpose | Required Version |
|------------|---------|------------------|
| **PHP** | Core language for WordPress and Timber logic | 7.4+ |
| **WordPress** | CMS platform powering the theme | 6.0+ |
| **Composer** | PHP dependency manager used to install Timber and other libraries | 2.x |
| **Node.js** | JavaScript runtime for Sass build scripts | 16.x or 18.x |
| **npm** | Node package manager for installing Sass and scripts | Bundled with Node |
| **Timber** | WordPress plugin + Composer package that enables Twig templating | ^1.22 |
| **Twig** | Templating engine used in `.twig` files | ^3.0 |
| **Dart Sass** | Compiles SCSS to CSS via npm scripts | ^1.75 |

### 📦 Installing Dependencies

- **PHP & Composer**: Install via [php.net](https://www.php.net/) and [getcomposer.org](https://getcomposer.org/)
- **Node.js & npm**: Install via [nodejs.org](https://nodejs.org/)
- **Timber**: Add to your theme with Composer:

  ```bash
  composer require timber/timber
  ```

- **Sass**: Already included in `package.json`, just run:

  ```bash
  npm install
  ```

---

## 🪵 What Is Timber?

**Timber** is a WordPress plugin and Composer package that lets you use the **Twig** templating engine instead of mixing PHP and HTML in your theme files.

- Separates logic (PHP) from presentation (Twig)
- Exposes WordPress data as clean objects (e.g. `post.title`, `site.name`)
- Encourages reusable, testable, and readable code

Timber acts as the bridge between WordPress and Twig.

---

## 🧵 What Is Twig?

**Twig** is a fast, secure, and flexible templating language originally from Symfony. It replaces PHP in your templates with a cleaner syntax and helpful features:

- `{{ post.title }}` instead of `<?php echo $post->title; ?>`
- `{% for item in list %}` loops
- `{% include "template.twig" %}` for partials
- Filters like `|date`, `|escape`, `|length`

---

## 🧠 Why Use Timber + Twig?

Traditional WordPress themes often mix logic and markup in the same file, leading to:

- Spaghetti code
- Poor separation of concerns
- Difficult-to-maintain templates

Timber + Twig flips that model:

| Layer | Responsibility |
|-------|----------------|
| PHP (`functions.php`) | Prepare data (context) |
| Twig (`.twig`)         | Render markup using that data |

This makes your theme more like a modern MVC system, with clear boundaries and reusable components.

---

## ✅ Pros of Timber + Twig

- **Clean syntax**: Twig is readable and expressive
- **Separation of concerns**: Logic stays in PHP, markup in Twig
- **Reusable components**: Easy to build and include partials
- **Faster development**: Less boilerplate, more clarity
- **Composable context**: You control what data is passed to each view
- **Modern mindset**: Encourages DRY, testable, scalable code

---

## ⚠️ Cons of Timber + Twig

- **Learning curve**: Requires learning Twig and Timber’s API
- **Plugin dependency**: Timber must be installed and kept updated
- **Smaller community**: Fewer Stack Overflow answers than classic WP
- **Debugging**: Errors in Twig can be less familiar to PHP-only devs
- **Extra setup**: Requires Composer and a build mindset

> That said, many devs report picking up Timber + Twig in a day or two—and never looking back.

---

## 🧩 How Lean Logic Uses Timber

- `functions.php` (theme root): Loads components and builds the global context
- `views/layout.twig`: The base layout, extended by all pages
- `views/Partials/`: Header, footer, nav, and banner blocks
- `Components/`: Each UI block has its own `functions.php`, `template.twig`, and optional `style.scss`
- `assets/styles/`: SCSS tokens and global styles
- `dark-mode.js`: Adds a toggle and persists user preference

---

## 🧪 Example: Rendering a Post

```php
// lean-logic/functions.php
$context['post'] = Timber::get_post();
Timber::render('views/single.twig', $context);
```

```twig
{# views/single.twig #}
<article>
  <h1>{{ post.title }}</h1>
  <div class="content">
    {{ post.content }}
  </div>
</article>
```

---

## 🧰 Resources

- [Timber Documentation](https://timber.github.io/docs/)
- [Twig Reference](https://twig.symfony.com/doc/3.x/)
- [Timber Starter Theme](https://github.com/timber/starter-theme)
- [Lean Logic README](../README.md)

---

Want to suggest an architectural improvement? Open a pull request or file an issue.
