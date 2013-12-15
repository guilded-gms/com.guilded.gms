<?php
namespace gms\system\game\item\tooltip;
use gms\data\game\item\GameItem;

interface IGameItemTooltip {
	/**
	 * Initializes this tooltip.
	 * 
	 * @param	\gms\data\game\item\GameItem	$item
	 */
	public function init(GameItem $item);
	
	/**
	 * Returns parsed tooltip template.
	 * 
	 * @return	string
	 */
	public function getTemplate();	
}