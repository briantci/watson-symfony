/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import './bootstrap.js';

// Import Bootstrap CSS and JavaScript
import 'bootstrap/dist/css/bootstrap.min.css';
import * as bootstrap from 'bootstrap';

// Make bootstrap available globally
window.bootstrap = bootstrap;

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
