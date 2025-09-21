/**
 * Bootstrap the application
 * 
 * This file is intentionally minimal since we're using CDN Bootstrap
 * and don't need additional JavaScript functionality for this e-commerce app.
 */

// CSRF token setup for forms
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
