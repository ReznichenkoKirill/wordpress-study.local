<?php

namespace App\Helpers;

/**
 * Class TemplateHelper
 * @package App\Helpers
 */
class TemplateHelper
{
    /**
     * @param $attachmentId
     * @param string $size
     * @param bool $icon
     * @param string $attr
     *
     * @return string
     */
    public function getAttachmentImg($attachmentId, $size = 'thumbnail', $icon = false, $attr = '')
    {
        return wp_get_attachment_image($attachmentId, $size, $icon, $attr);
    }

    /**
     * @param $attachmentId
     * @param string $size
     * @param bool $icon
     *
     * @return false|string
     */
    public function getAttachmentImgLink($attachmentId, $size = 'thumbnail', $icon = false)
    {
        return wp_get_attachment_image_url($attachmentId, $size, $icon);
    }

    /**
     * @param $link
     * @param array $classes
     * @param string $alt
     * @return string
     */
    public function getLazyLoadedImg($link, $classes = [], $alt = '')
    {
        return '<img data-src="' . $link . '" class="lazy-load-image ' . implode(' ',
                $classes) . '" alt="' . $alt . '">';
    }
}
