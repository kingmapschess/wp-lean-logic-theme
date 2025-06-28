# FUTURE.md — Lean Logic: Roadmap & Ideas

A running list of enhancements and upcoming feature strategies for the Lean Logic WordPress theme.

---

## Design Token System via YAML

Goal: Replace _tokens.scss with structured tokens.yaml as the single source of truth.

Benefits:
- Write once → export to SCSS, CSS, theme.json, Tailwind, Figma
- Improved Git diffs and schema validation
- Flexible across platforms and outputs

Tasks:
- [ ] Create tokens.yaml structure
- [ ] Write script to generate:
  - _tokens.scss
  - :root CSS variables
  - theme.json color + font settings
- [ ] Hook into build script for automation
- [ ] Add optional Tailwind or PostCSS config output

---

## Automated theme.json Sync

Goal: Ensure tokens are always reflected in the editor and compatible builders.

Features:
- Parses _tokens.scss or tokens.yaml
- Writes/updates theme.json:
  - settings.color.palette[]
  - settings.typography.fontFamilies[]

Tasks:
- [x] Initial script: SCSS → theme.json palette
- [ ] Add font family sync
- [ ] Improve theme.json merging (preserve unrelated keys)
- [ ] Add build log output (tokens added/changed)

---

## Nimble Builder Compatibility (Defer + Bridge)

Goal: Add conditional Nimble support without forking the theme.

Defer Strategy:
- Use `class_exists('Nimble_Sections_Engine')`
- If present, bypass component rendering and run:
  - `do_action('nimble_before_main_content')`
  - `the_content()`
  - `do_action('nimble_after_main_content')`

Bridging the Styling Gap:
- Write _nimble.scss overrides:
  - Map SCSS tokens to `.nimble_section`, `.nimble_text_module`, etc.
- Ensure CSS loads after Nimble styles
- Sync tokens to theme.json for use in Nimble color/typography pickers

Enhancements:
- [ ] Create NimbleBridgeService.php
- [ ] Add template-nimble.php as full-width layout option
- [ ] Add toggle or detection wrapper in theme config

---

## Additional Ideas

- [ ] Auto-generate components.scss with glob importer
- [ ] Add spacing + utility classes from YAML token input
- [ ] CLI commands:
  - `create-component`
  - `generate-palette`
  - `generate-theme.json`
- [ ] Extend dark-mode.scss with light/dark token mapping
- [ ] Add preview environment or style guide from tokens.yaml

---

## Philosophy

Keep things modular, observable, and focused on clarity. Lean Logic’s future should scale without bloat, accommodate both developer and editor workflows, and stay consistent across environments.
