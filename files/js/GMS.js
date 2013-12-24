/**
 * @author	Jeffrey Reichardt
 * @copyright	2012-2013 DevLabor UG (haftungsbeschränkt)
 * @license	Creative Commons 3.0 <BY-NC-SA> <http://creativecommons.org/licenses/by-nc-sa/3.0/deed>
 * @package	com.guilded.gms
 * @category	Guilded 2.0
 */
/**
 * Namespace for GMS
 */
GMS = {};

/**
 * Namespace for GMS.Character
*/
GMS.Character = {};

/**
 * OptionHandler for CharacterEditor.
 */
GMS.Character.OptionHandler = Class.extend({
	/**
	 * list of available games
	 * @var	object
	 */
	_availableGames: {},

	/**
	 * button element
	 * @var	jQuery
	 */
	_button: null,

	/**
	 * initialization state
	 * @var	boolean
	 */
	_didInit: false,

	/**
	 * target input element
	 * @var	jQuery
	 */
	_element: null,

	/**
	 * true, if data was entered after initialization
	 * @var	boolean
	 */
	_insertedDataAfterInit: false,

	/**
	 * enables multiple game ability
	 * @var	boolean
	 */
	_isEnabled: false,

	/**
	 * currently active game id
	 * @var	integer
	 */
	_gameID: 0,

	/**
	 * game selection list
	 * @var	jQuery
	 */
	_list: null,

	/**
	 * list of game values on init
	 * @var	object
	 */
	_values: null,

	_container: null,

	_templates: { },

	/**
	 * Initializes multiple game ability for given element id.
	 *
	 * @param	integer		elementID
	 * @param	string		containerSelector
	 * @param	object		availableGames
	 * @param	integer		selectedGameID
	 */
	init: function(elementID, containerSelector, availableGames, selectedGameID) {
		this._button = null;
		this._element = $('#' + $.wcfEscapeID(elementID));
		this._values = { };
		this._availableGames = availableGames;
		this._container = $(containerSelector);
		this._gameID = selectedGameID;

		// unescape values
		if ($.getLength(this._values)) {
			for (var $key in this._values) {
				this._values[$key] = WCF.String.unescapeHTML(this._values[$key]);
			}
		}

		// preselect game
		if (this._element.length == 0) {
			console.debug("[GMS.Character.OptionHandler] element id '" + elementID + "' is unknown");
			return;
		}

		// build selection handler
		var $enableOnInit = ($.getLength(this._values) > 0) ? true : false;
		this._insertedDataAfterInit = $enableOnInit;
		this._prepareElement($enableOnInit);

		this._didInit = true;
	},

	/**
	 * Builds game handler.
	 *
	 * @param	boolean		enableOnInit
	 */
	_prepareElement: function(enableOnInit) {
		this._element.wrap('<div class="dropdown preInput"></div>');
		var $wrapper = this._element.parent();

		// pre select game
		if (this._gameID && this._availableGames[this._gameID]) {
			this._button = $('<p class="button dropdownToggle"><span>' + this._availableGames[this._gameID].title + '</span></p>').prependTo($wrapper);
		}
		else {
			this._button = $('<p class="button dropdownToggle"><span>' + WCF.Language.get('gms.game.button.none') + '</span></p>').prependTo($wrapper);
		}

		// insert list
		this._list = $('<ul class="dropdownMenu"></ul>').insertAfter(this._button);

		// add a special class if next item is a textarea
		if (this._button.nextAll('textarea').length) {
			this._button.addClass('dropdownCaptionTextarea');
		}
		else {
			this._button.addClass('dropdownCaption');
		}

		// insert available games
		for (var $gameID in this._availableGames) {
			var imageTag = '';
			if (this._availableGames[$gameID].icon != '') {
				imageTag = '<img src="' + this._availableGames[$gameID].icon + '" title="' + this._availableGames[$gameID].title + '" alt="" /> ';
			}

			$('<li><span>' + imageTag + this._availableGames[$gameID].title + '</span></li>').data('gameID', $gameID).click($.proxy(this._changeGame, this)).appendTo(this._list);
		}

		WCF.Dropdown.initDropdown(this._button, enableOnInit);

		if (enableOnInit) {
			this._isEnabled = true;

			// pre-select current game
			this._list.children('li').each($.proxy(function(index, listItem) {
				var $listItem = $(listItem);
				if ($listItem.data('gameID') == this._gameID) {
					$listItem.trigger('click');
				}
			}, this));
		}

		WCF.Dropdown.registerCallback($wrapper.wcfIdentify(), $.proxy(this._handleAction, this));
	},

	/**
	 * Handles dropdown actions.
	 *
	 * @param	string		containerID
	 * @param	string		action
	 */
	_handleAction: function(containerID, action) {
		if (action === 'open') {
			this._enable();
		}
		else {
			this._closeSelection();
		}
	},

	/**
	 * Enables the game selection or shows the selection if already enabled.
	 *
	 * @param	object		event
	 */
	_enable: function(event) {
		if (!this._isEnabled) {
			var $button = (this._button.is('p')) ? this._button.children('span:eq(0)') : this._button;
			$button.addClass('active');

			this._isEnabled = true;
		}
	},

	/**
	 * Closes the game selection.
	 */
	_closeSelection: function() {
		this._disable();
	},

	/**
	 * Changes the currently active game.
	 *
	 * @param	object		event
	 */
	_changeGame: function(event) {
		var $button = $(event.currentTarget);
		this._insertedDataAfterInit = true;

		// set new game
		this._gameID = $button.data('gameID');

		// update marking
		this._list.children('li').removeClass('active');
		$button.addClass('active');

		// update label
		this._button.children('span').addClass('active').text(this._availableGames[this._gameID].title);

		// close selection and set focus on input element
		if (this._didInit) {
			this._element.blur().focus();
		}

		this._updateContainer();

		// @todo update hidden input with current gameID
	},

	/**
	 * Gets options template and replaces container.
	 */
	_updateContainer: function() {
		if (!this._templates[this._gameID]) {
			new WCF.Action.Proxy({
				autoSend: true,
				data: {
					actionName: 'getOptions',
					className: 'wcf\\data\\character\\option\\CharacterOptionAction',
					parameters: {
						gameID: this._gameID
					}
				},
				suppressErrors: true,
				success: function(data, textStatus, jqXHR) {
					if (data.returnValues.length && data.returnValues.template) {
						this._templates[this._gameID] = data.returnValues.template;
					}
				}
			});
		}

		this._container.html(this._templates[this._gameID]);
	},

	/**
	 * Disables game selection for current element.
	 *
	 * @param	object		event
	 */
	_disable: function(event) {
		if (event === undefined && this._insertedDataAfterInit) {
			event = null;
		}

		if (!this._list || event === null) {
			return;
		}

		// remove active marking
		this._button.children('span').removeClass('active');

		this._element.blur();

		this._insertedDataAfterInit = false;
		this._isEnabled = false;
	}
});

/**
 * Loads character profile previews.
 * 
 * @see	WCF.Popover
 */
GMS.Character.ProfilePreview = WCF.Popover.extend({
	/**
	 * action proxy
	 * @var	WCF.Action.Proxy
	 */
	_proxy: null,
	
	/**
	 * list of user profiles
	 * @var	object
	 */
	_characterProfiles: { },
	
	/**
	 * @see	WCF.Popover.init()
	 */
	init: function() {
		this._super('.characterLink');
		
		this._proxy = new WCF.Action.Proxy({
			showLoadingOverlay: false
		});
	},
	
	/**
	 * @see	WCF.Popover._loadContent()
	 */
	_loadContent: function() {
		var $element = $('#' + this._activeElementID);
		var $characterID = $element.data('characterID');
		
		if (this._characterProfiles[$characterID]) {
			// use cached user profile
			this._insertContent(this._activeElementID, this._characterProfiles[$characterID], true);
		}
		else {
			this._proxy.setOption('data', {
				actionName: 'getCharacterProfile',
				className: 'wcf\\data\\character\\CharacterProfileAction',
				objectIDs: [ $characterID ]
			});
			
			var $elementID = this._activeElementID;
			var self = this;
			this._proxy.setOption('success', function(data, textStatus, jqXHR) {
				// cache character profile
				self._characterProfiles[$characterID] = data.returnValues.template;
				
				// show character profile
				self._insertContent($elementID, data.returnValues.template, true);
			});
			this._proxy.sendRequest();
		}
	}
});

// @todo Character.TabMenu

/**
 * Namespace for GMS.Game
 */
GMS.Game = {};

/**
 * Loads game item tooltip.
 *
 * @see	WCF.Popover
 */
GMS.Game.ItemTooltip = WCF.Popover.extend({
	/**
	 * action proxy
	 * @var	WCF.Action.Proxy
	 */
	_proxy: null,

	/**
	 * list of user profiles
	 * @var	object
	 */
	_items: { },

	/**
	 * @see	WCF.Popover.init()
	 */
	init: function() {
		this._super('.itemLink');

		this._proxy = new WCF.Action.Proxy({
			showLoadingOverlay: false
		});
	},

	/**
	 * @see	WCF.Popover._loadContent()
	 */
	_loadContent: function() {
		var $element = $('#' + this._activeElementID);
		var $itemID = $element.data('itemID');

		if (this._items[$itemID]) {
			// use cached items
			this._insertContent(this._activeElementID, this._items[$itemID], true);
		}
		else {
			this._proxy.setOption('data', {
				actionName: 'getTooltip',
				className: 'wcf\\data\\game\\item\\GameItemAction',
				objectIDs: [ $itemID ]
			});

			var $elementID = this._activeElementID;
			var self = this;
			this._proxy.setOption('success', function(data, textStatus, jqXHR) {
				if (data.returnValues.length) {
					// cache user profile
					self._items[$itemID] = data.returnValues.template;

					// show user profile
					self._insertContent($elementID, data.returnValues.template, true);
				}
			});
			this._proxy.sendRequest();
		}
	}
});

/**
 * Namespace for GMS.Guild
 */
GMS.Guild = {};

/**
 * Loads character profile previews.
 *
 * @see	WCF.Popover
 */
GMS.Guild.ProfilePreview = WCF.Popover.extend({
	/**
	 * action proxy
	 * @var	WCF.Action.Proxy
	 */
	_proxy: null,

	/**
	 * list of user profiles
	 * @var	object
	 */
	_guildProfiles: { },

	/**
	 * @see	WCF.Popover.init()
	 */
	init: function() {
		this._super('.guildLink');

		this._proxy = new WCF.Action.Proxy({
			showLoadingOverlay: false
		});
	},

	/**
	 * @see	WCF.Popover._loadContent()
	 */
	_loadContent: function() {
		var $element = $('#' + this._activeElementID);
		var $guildID = $element.data('guildID');

		if (this._guildProfiles[$guildID]) {
			// use cached user profile
			this._insertContent(this._activeElementID, this._guildProfiles[$guildID], true);
		}
		else {
			this._proxy.setOption('data', {
				actionName: 'getGuildProfile',
				className: 'wcf\\data\\guild\\GuildProfileAction',
				objectIDs: [ $guildID ]
			});

			var $elementID = this._activeElementID;
			var self = this;
			this._proxy.setOption('success', function(data, textStatus, jqXHR) {
				// cache guild profile
				self._guildProfiles[$guildID] = data.returnValues.template;

				// show guild profile
				self._insertContent($elementID, data.returnValues.template, true);
			});
			this._proxy.sendRequest();
		}
	}
});

// @todo Guild.TabMenu
