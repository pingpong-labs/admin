<?php namespace Pingpong\Admin\Menus\Presenters;

use Pingpong\Admin\Menus\MenuItem;

abstract class Presenter implements PresenterInterface {

    /**
     * Get child menus.
     *
     * @param MenuItem $item
     * @return string
     */
    public function getChilds(MenuItem $item)
    {
        $result = $this->getHeaderChildTag($item);

        $result .= $this->getOpenChildTag($item);

        foreach ($item->getChilds() as $child)
        {
            if ($child->isDivider())
            {
                $result .= $this->getDividerTag();
            }
            elseif ($child->hasChilds())
            {
                $result .= $this->getChilds($child);
            }
            else
            {
                $result .= $this->getListTag($child);
            }
        }

        $result .= $this->getCloseChildTag();

        $result .= $this->getFooterChildTag();

        return $result;
    }
}