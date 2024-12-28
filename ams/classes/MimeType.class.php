<?php
/**
 * PHP library for obtain headers MIME.
 *
 * @since     1.0.0
 */
namespace GRSOFTWARES\MODULE\MIMETYPE\BASE;

use GRSOFTWARES\MODULE\MIMETYPE\COLLECTION as COLLECTION;
require_once("MimeTypesCollection.class.php");

/**
 * Get MIME type and file extensions.
 */
class MimeType
{
    /**
     * Get array with all MIME types.
     *
     * @since 1.1.3
     *
     * @return array → MIME types
     */
    public static function get()
    {
        return COLLECTION\MimeTypesCollection::all();
    }

    /**
     * Get MIME type from file extension.
     *
     * @param string $ext → file extension, e.g. '.html'
     *
     * @return string|false → MIME type or false
     */
    public static function getMimeFromExtension($ext)
    {
        return COLLECTION\MimeTypesCollection::get($ext) ?: false;
    }

	/**
     * Get MIME type from file extension.
     *
     * @param string $ext → file extension, e.g. '.html'
     *
     * @return header string|false → MIME type or false
     */
    public static function getMimeFromExtensionForHeader($ext)
    {
       return "Content-Type: " . COLLECTION\MimeTypesCollection::get($ext) ?: false;
    }

    /**
     * Get file extension from MIME type.
     *
     * @param string $mime → MIME type, e.g. 'text/html'
     *
     * @return string|false → file extension or false
     */
    public static function getExtensionFromMime($mime)
    {
        return array_search($mime, COLLECTION\MimeTypesCollection::all(), true);
    }
}
