# Lean Logic

A DRY, component-based WordPress theme for independent publishing. Built with Timber, Twig, and SCSS. Inspired by the ethos of *Independent Publisher*, but stripped down to the bone: no plugin fluff, no mixed logic, and no visual noise—just clean architecture for writers and developers who value clarity.

---

## ⚠️ Requirements

- PHP 7.4+
- WordPress 6.0+
- Composer (PHP package manager)
- Node.js 16.x or 18.x
- npm (bundled with Node)
- Timber plugin (via Composer)
- Sass (compiled via Dart Sass)

> See [`docs/architecture.md`](docs/architecture.md) for an in-depth look at Timber, Twig, and Lean Logic’s architecture.

---

## 🧠 Philosophy

- **Reader-first**: Typography, rhythm, and clarity above all.
- **Modular**: Every UI block is a component: isolated, reusable, and logical.
- **DRY**: Logic lives in PHP, presentation in Twig. No duplication. No mess.
- **Native**: Zero plugin dependencies. Clean WordPress output.

---

## 🏁 Installation

```bash
git clone git@github.com:kingmapschess/lean-logic-wptheme.git wp-content/themes/lean-logic
cd wp-content/themes/lean-logic

# Install PHP deps (Timber)
composer install

# Install Node deps (Sass)
npm install

# Compile styles
npm run build:css
```

Then activate from **Appearance → Themes** in WordPress.

---

## 📦 File Structure

```
lean-logic/
├── Components/
│   └── [Component]/
│       ├── functions.php       # Context for the component
│       ├── template.twig       # Component HTML structure
│       └── style.scss          # Optional styles
├── views/
│   ├── layout.twig             # Global layout wrapper
│   └── Partials/               # Layout partials
│       ├── header.twig
│       ├── nav.twig
│       ├── banner.twig
│       └── footer.twig
├── assets/
│   ├── styles/
│   │   ├── base.scss           # Design tokens + dark mode variables
│   │   └── main.scss           # Sass entry point
│   └── scripts/
│       └── dark-mode.js        # Dark mode toggle logic
├── functions.php               # Theme bootstrap + context wiring
├── style.css                   # Compiled output
├── README.md
└── package.json
```

---

## 🔦 Components

Lean Logic follows a structured component approach. Each component is self-contained.

### Included

- `Hero`
- `FeatureList`
- `AuthorBio`
- `SocialLinks`
- `AnnouncementBanner`

Each lives in its own folder under `Components/`. You register the component’s `functions.php` in the root `functions.php`, and include its Twig file wherever needed.

---

## 🌓 Dark Mode

Dark mode is implemented with:

- A toggle button that applies `html.dark`
- CSS variables that adapt to light or dark context
- JavaScript that saves the user’s preference in `localStorage`
- Tokens defined in `base.scss` for maximum clarity

---

## 🔠 Typography

Uses a native Windows-friendly system sans-serif stack:

```
"Segoe UI", Tahoma, Geneva, Verdana, sans-serif
```

You can override it via `--font-sans` in `base.scss`.

---

## 🧪 Development

### Compile styles:

```bash
npm run build:css
```

### Watch styles in dev mode:

```bash
npm run watch:css
```

### Optional: Timber context inspection

In any `.twig` file, use `{{ dump() }}` to debug the current context.

---

## 💡 Customization

- Add a new component: Copy a component folder, modify the context/template, wire it in via `functions.php`.
- Add a nav item: Use WordPress Menus in Admin and assign to `primary`.
- Update dark mode: Modify variables in `base.scss` and the button in `header.twig`.
- Update announcement: Edit `banner.twig`, or hook it into a post/CPT/option later.

---

## 📈 Changelog

See [`CHANGELOG.md`](CHANGELOG.md)

---

## 🧱 Architecture

See [`docs/architecture.md`](docs/architecture.md) for:

- How Timber and Twig work together
- Dependency breakdown
- Pros and cons of the stack
- Example rendering logic

---

## 📸 Screenshots

Coming soon—see [#1](https://github.com/yourusername/lean-logic/issues/1) for the gallery backlog.

---

## 🧰 License & Credits

MIT License.  
Crafted by [@yourusername](https://github.com/yourusername)  
Inspired by [Independent Publisher](https://wordpress.org/themes/independent-publisher/) 

---
