<?php
/**
 * Author: Timur Valiev
 * Site: https://webprowww.github.io
 * 2019-02-21 01:12
 */

namespace modules\site\models;

/**
 * Interface BlockInterface
 * @package modules\site\models
 *
 * @property string $blockTitle
 * @property string $blockContent
 * @property string $blockDescription
 */
interface BlockInterface
{
    /**
     * @return string
     */
    public function getView();
    /**
     * @return string
     */
    public function getBlockTitle();

    /**
     * @return string
     */
    public function getBlockContent();

    /**
     * @return string
     */
    public function getBlockDescription();
}