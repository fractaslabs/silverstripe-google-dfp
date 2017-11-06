<?php

/**
 * Google DFP Slot Helper class
 *
 *
 * @package SilverStripe-Google-DFP
 * @copyright 2017 Fractas Labs
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/fractaslabs/silverstripe-google-dfp
 */
class GoogleDfpSlotHelper extends Object
{
    private static $id;

    private static $enable_in_dev = false;

    public function GoogleDfpID()
    {
        return Config::inst()->get('GoogleDfpSlotHelper', 'publisher_id');
    }

    public static function enable_in_dev()
    {
        return Config::inst()->get('GoogleDfpSlotHelper', 'enable_in_dev');
    }

    /**
     * Check if ads should be enabled
     * By default they are enabled in "live" enviroment
     *
     * @return boolean
     */
    public static function enabled()
    {
        if (Director::isLive()) {
            return true;
        } elseif (Director::isDev() && self::enable_in_dev()) {
            return true;
        }

        return false;
    }

    /**
     *
     * ID - unique identifier of banner
     * Layout - Controller ClassName where banner should be rendered
     * Alias - name of banner (used to distinguish )
     * AdUnitPath - Full path of the ad unit with the network code and ad unit code.
     * Size - An exact size of banner creative
     * OutOfPage - if banner is "wallpaper" or "floater" type specify as "true"
     * DfpTargetPage - current Page ID
     * DfpTargetCategory - Parent Title of current Page ID
     * DfpTargetCategoryParent - GrandParent Title of current Page ID (if has)
     *
     * @return mixed
     */
    public static function slot_list()
    {
        $list = Config::inst()->get('GoogleDfpSlotHelper', 'layouts');
        if (!is_array($list)) {
            return false;
        }

        $out = ArrayList::create();
        $controller = Controller::curr();
        $dfpTargetArticle = $controller->ID;
        $dfpTargetCategory = $controller->Parent()->Title ? $controller->Parent()->Title : $controller->Title;
        $dfpTargetCategoryParent = $controller->Parent()->Parent()->Title ? $controller->Parent()->Parent()->Title : null;

        foreach ($list as $key => $item) {
            foreach ($item as $slotKey => $slot) {
                $out->add(ArrayData::create(array(
                    'ID' => $slotKey,
                    'Layout' => $key,
                    'Alias' => isset($slot['alias']) ? $slot['alias'] : null,
                    'AdUnitPath' => isset($slot['adUnitPath']) ? $slot['adUnitPath'] : null,
                    'Size' => isset($slot['size']) ? $slot['size'] : null,
                    'OutOfPage' => isset($slot['outOfPage']) ? $slot['outOfPage'] : false,
                    'DfpTargetPage' => $dfpTargetPage,
                    'DfpTargetCategory' => $dfpTargetCategory,
                    'DfpTargetCategoryParent' => $dfpTargetCategoryParent,
                    'DfpTargetRos' => $key,
                )));
            }
        }

        return $out;
    }

    /**
     * Get one banner by ID
     *
     *
     * @param $id
     */
    public static function slot_by_id($id = false)
    {
        return self::slot_list()
                ->filter(array('ID' => $id, 'Layout' => Controller::curr()->ClassName))
                ->first();
    }

    /**
     * Get one banner by Alias name
     *
     *
     * @param $alias
     */
    public static function slot_by_alias($alias = false)
    {
        return self::slot_list()
                ->filter(array('Alias' => $alias, 'Layout' => Controller::curr()->ClassName))
                ->first();
    }
}
