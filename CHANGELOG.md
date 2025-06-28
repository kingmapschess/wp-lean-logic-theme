# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),  
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [Unreleased]

### Added
- Initial draft of this changelog file for tracking release history.

---

## [1.0.0] – 2025-06-28

### Added
- **Theme structure** scaffolded: `views/`, `Components/`, `assets/`
- **SCSS pipeline** with Dart Sass and modular `base.scss` tokens
- **Dark mode toggle** using `html.dark` class and `localStorage` preference
- **Component blocks**:
  - `Hero`
  - `FeatureList`
  - `AuthorBio`
  - `SocialLinks`
  - `AnnouncementBanner`
- **Layout partials**: modular `header`, `footer`, `nav`, and `banner.twig`
- **Navigation block** using Timber and WordPress Menu API
- **Typography tokens**: using `"Segoe UI", Tahoma, Geneva, Verdana, sans-serif` stack
- **Minimal styling system** based on CSS custom properties and spacing tokens
- **Elementor override support** via `elementor_theme_do_location()` (optional)

---

## [0.1.0] – 2025-06-24

### Added
- Sass build scripts and `package.json`
- Base file structure seeded and Timber activated
- Initial layout.twig with static content

---

