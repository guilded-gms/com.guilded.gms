<?php
namespace gms\system\game\item\tooltip;
use gms\data\game\item\GameItem;
use wcf\system\WCF;

abstract class AbstractGameItemTooltip implements IGameItemTooltip {
	/**
	 * template name
	 * @var	string
	 */
	protected $templateName = 'gameItemTooltip';

	/**
	 * item object
	 * @var \gms\data\game\item\GameItem
	 */
	protected $item = null;
	
	/**
	 * @see	\wcf\system\game\tooltip\IGameItemTooltip::init()
	 */
	public function init(GameItem $item) {
		$this->item = $item;
	}
	
	/**
	 * @see	\wcf\system\game\tooltip\IGameItemTooltip::getTemplate()
	 */
	public function getTemplate() {
		$template = $this->render();

		if (empty($template)) {
			return '';
		}
		
		WCF::getTPL()->assign(array(
			'tooltip' => $this,
			'template' => $template
		));
		
		return WCF::getTPL()->fetch('gameItemPreview');
	}
	
	/**
	 * Renders tooltip output.
	 * 
	 * @return	string
	 */
	protected function render() {
		if (empty($this->templateName)) {
			return '';
		}

		if ($this->item === null || !$this->item->itemID) {
			return WCF::getLanguage()->get('gms.game.item.notFound');
		}

		WCF::getTPL()->assign(array(
			'item' => $this->item
		));

		return WCF::getTPL()->fetch($this->templateName);
	}

	/**
	 * Returns item of tooltip.
	 * 
	 * @return	\gms\data\game\item\GameItem
	 */
	public function getItem() {
		return $this->item;
	}
}
