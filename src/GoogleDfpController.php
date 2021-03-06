<?php

namespace Fractas\GoogleDfp;

use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;

use Fractas\GoogleDfp\GoogleDfpSlotHelper;

/**
 * Google DFP Controller class.
 *
 *
 * @package SilverStripe-Google-DFP
 * @copyright 2017 Fractas Labs
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/fractaslabs/silverstripe-google-dfp
 */
class GoogleDfpController extends Extension
{
    /**
     * Renders a banners HTML to template using $id as identifier
     *
     *
     * @param $id
     */
    public function GoogleDfpSlotByID($id = false)
    {
        $data = GoogleDfpSlotHelper::slot_by_id($id);

        return $data ? $data->renderWith('GoogleDfpSlot') : false;
    }

    /**
     * Renders a banners HTML to template using $alias as identifier
     *
     *
     * @param $alias
     */
    public function GoogleDfpSlotByAlias($alias = false)
    {
        $data = GoogleDfpSlotHelper::slot_by_alias($alias);

        return $data ? $data->renderWith('GoogleDfpSlot') : false;
    }

    /**
     * Fills a javascript with data array needed to initialize a banner show
     *
     */
    public function GoogleDfpSlotList()
    {
        return GoogleDfpSlotHelper::slot_list()->filter(array('Layout' => Controller::curr()->ClassName));
    }

    /**
     * Check method if is module enabled, used in GoogleDfpSlot.ss
     *
     * @return bool
     */
    public function GoogleDfpEnabled()
    {
        return GoogleDfpSlotHelper::enabled();
    }

    /**
     * Renders a javascript needed to initialize a banner show
     *
     */
    public function onAfterInit()
    {
        if (GoogleDfpSlotHelper::enabled() !== false) {
            Requirements::insertHeadTags($this->owner->renderWith('GoogleDfpHead'), 'GoogleDfpHead');
        }
    }
}
