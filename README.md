# CG Framework

A modular custom WordPress theme foundation for client websites.

## Requirements
- WordPress 6.4+
- PHP 8.1+
- WooCommerce and Elementor are optional integrations (install separately).

## Install
1. In WordPress, go to **Appearance → Themes → Add New → Upload Theme**.
2. Upload `cg-framework.zip`, install and activate.
3. Visit **Settings → Permalinks** and save once.
4. Configure the Primary and Footer menus and upload your logo.

## Included features
- Responsive theme templates, Gutenberg support, custom logo, menus and featured images.
- WooCommerce theme support and native hook wrappers; no copied WooCommerce templates.
- Elementor theme support and core Theme Builder location registration. Elementor V4 Atomic Elements remain under Elementor's own styling and rendering.
- Shortcodes: `[gcf_button url="https://example.com"]Learn more[/gcf_button]`, `[gcf_alert type="success" title="Success"]Message[/gcf_alert]`, and `[gcf_option field="phone" type="link"]` for Website Information.
- Shortcode Generator at **Appearance → Shortcode Generator**.
- Custom post type/taxonomy manager at **Appearance → Content Types**.
- Theme guide at **Appearance → Theme Guide**.

## Elementor
Install Elementor Free/Pro separately. Assign Header, Footer, Single, Archive and other templates in Elementor Theme Builder as appropriate. The theme registers Elementor's core locations and removes its own content padding on Elementor pages. Elementor V4/Atomic Elements are designed to be controlled by Elementor; this theme deliberately avoids selectors that target Elementor's internal atomic markup.

Elementor Pro is required for some Theme Builder and WooCommerce builder features. This theme does not bundle Elementor or Elementor Pro.

## WooCommerce
Install and activate WooCommerce separately. Product, cart, checkout and account functionality is provided by WooCommerce. The theme adds gallery support and a content wrapper while retaining WooCommerce's template and hook system. This avoids maintaining stale template overrides.

## Custom post types
Use **Appearance → Content Types** to register basic public post types and optional hierarchical taxonomies. Definitions are stored in the WordPress options table. For advanced capabilities (custom capabilities, REST controller customization, complex rewrite rules, migrations), use a site-specific plugin.

**Content portability note:** WordPress content remains in the database when switching themes, but custom post type registrations should live in a site-specific plugin for long-term portability. Export/migrate registrations before changing themes.

## Updating
- Update `Version` in `style.css` and `GCF_VERSION` in `functions.php` together.
- Add release notes to `CHANGELOG.md`.
- Keep custom client functionality in a child theme or site-specific plugin; this package itself is the parent theme framework.
- Test against the current WordPress, WooCommerce and Elementor releases on staging before production updates.
- Back up the database and files before upgrading.

## QA checklist
- Activate on a clean WordPress installation and check for PHP errors.
- Test menus, logo, featured images, search, archives, single posts, pages and 404.
- Test keyboard navigation and mobile menu.
- Test WooCommerce shop, product, cart, checkout and account flows with a payment sandbox.
- Test Elementor Theme Builder locations and Elementor V4 Atomic Elements.
- Test shortcode output in Gutenberg and Elementor's Shortcode widget.
- Test CPT archive/single URLs and save Permalinks after changing registrations.
- Run PHP linting and WordPress coding standards checks in CI.

## Scope and honest compatibility statement
This is a functional theme framework, not a guarantee of compatibility with every future WordPress/plugin release. Future versions cannot be certified before they exist. Run the QA checklist against each supported release. Elementor Pro, WooCommerce and WordPress are not bundled.


## Website Information Customizer
Go to **Appearance → Customize → Website Information** to set Phone Number, Email Address and Physical Address. These are stored as theme modifications (`theme_mod`) and are available through `[gcf_option]`.

Examples:
- `[gcf_option field="phone"]` — formatted phone text.
- `[gcf_option field="phone" type="link"]` — `tel:` link with punctuation removed from the URI.
- `[gcf_option field="email" type="link"]` — `mailto:` link with `antispambot()` display obfuscation.
- `[gcf_option field="address" type="link"]` — Google Maps search link.

## Elementor v3 compatibility toggle
Go to **Appearance → Customize → Elementor Compatibility** and enable **Enable Elementor v3 Compatibility**. The theme conditionally loads `assets/css/elementor-v3-compatibility.css` only when Elementor is active. The stylesheet is intentionally conservative and is a safe extension point for site-specific layout adjustments. PHP integrations can hook into `gcf_elementor_v3_compatibility_init`; use the `gcf_elementor_v3_compatibility_enabled` filter to override the toggle programmatically.

This toggle does not replace Elementor's own compatibility requirements or guarantee behavior across all Elementor releases. Verify the actual site templates and widgets after updates.
