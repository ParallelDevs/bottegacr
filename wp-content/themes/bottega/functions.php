<?php
// Evitar acceso directo
if (!defined('ABSPATH')) exit;

// Cargar Composer
$autoload_path = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoload_path)) {
    require_once $autoload_path;
} else {
    add_action('admin_notices', function() use ($autoload_path) {
        echo '<div class="notice notice-error"><p>No se encontró Composer autoload en: ' . esc_html($autoload_path) . '</p></div>';
    });
    return;
}

// Verificar que Timber exista
use Timber\Timber;
if (!class_exists('Timber\Timber')) {
    add_action('admin_notices', function() {
        echo '<div class="notice notice-error"><p>Timber no está disponible.</p></div>';
    });
    return;
}

// Carpeta de templates Twig
Timber::$dirname = ['templates'];

// Registrar estilos y scripts
function mi_tema_enqueue_assets() {
    wp_enqueue_style('mi-tema-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'mi_tema_enqueue_assets');

// Soporte básico del tema
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
