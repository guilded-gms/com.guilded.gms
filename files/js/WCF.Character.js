/**
 * Namespace for WCF.Character
*/
WCF.Character = {};

/**
 * Loads character profile previews.
 * 
 * @see	WCF.Popover
 */
WCF.Character.ProfilePreview = WCF.Popover.extend({
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
			showLoadingOverlay: false,
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

/**
 * Namespace for game
 */
WCF.Character.SelectInput = function(elementID, containerID, values, availableGames) { this.init(elementID, values, availableGames); };
WCF.Character.SelectInput.prototype = {
	/**
	 * list of available games
	 * @var	object
	 */
	_availableGames: {},

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

	/**
	 * Initializes multiple game ability for given element id.
	 * 
	 * @param	integer		elementID
	 * @param	integer		containerID
	 * @param	object		values
	 * @param	object		availableGames
	 */
	init: function(elementID, containerID, values, availableGames) {
		this._element = $('#' + $.wcfEscapeID(elementID));
		this._container = $('#' + $.wcfEscapeID(containerID));
		this._values = values;
		this._availableGames = availableGames;
		
		console.log(this._availableGames);
		
		// default to current user game
		if (this._element.length == 0) {
			console.debug("[WCF.GameSelectInput] element id '" + elementID + "' is unknown");
			return;
		}
		
		// build selection handler
		var $enableOnInit = ($.getLength(this._values) > 0) ? true : false;
		this._insertedDataAfterInit = $enableOnInit;
		this._prepareElement($enableOnInit);
		
		// listen for submit event
		this._element.parents('form').submit($.proxy(this._submit, this));

		this._didInit = true;
	},

	/**
	 * Builds game handler.
	 * 
	 * @param	boolean		enableOnInit
	 */
	_prepareElement: function(enableOnInit) {
		this._element.wrap('<div class="dropdown preInput" />');
		var $wrapper = this._element.parent();
		var $button = $('<p class="button dropdownToggle"><span>' + WCF.Language.get('wcf.game.' + this._availableGames[0] + '.title') + '</span></p>').prependTo($wrapper);
		$button.data('toggle', $wrapper.wcfIdentify()).click($.proxy(this._enable, this));
		
		// add a special class if next item is a textarea
		$button.addClass('dropdownCaption');
		
		// insert list
		this._list = $('<ul class="dropdownMenu"></ul>').insertAfter($button);
		
		// calculate top offset for menu
		this._list.css({
			top: $button.parent().outerHeight() + 10
		});
		
		// insert available games
		for (var $gameID in this._availableGames) {
			$('<li><span>' + this._availableGames[$gameID] + '</span></li>').data('gameID', $gameID).click($.proxy(this._changeGame, this)).appendTo(this._list);
		}
		
		if (enableOnInit || this._forceSelection) {
			$button.trigger('click');

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
	 * @param	jQuery		dropdown
	 * @param	string		action
	 */
	_handleAction: function(dropdown, action) {
		if (action === 'close') {
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
			var $button = $(event.currentTarget);
			if ($button.getTagName() === 'p') {
				$button = $button.children('span:eq(0)');
			}
			
			$button.addClass('active');
			
			this._isEnabled = true;
			this._insertedDataAfterInit = false;
		}
		
		// toggle list
		if (this._list.is(':visible')) {
			this._closeSelection();
		}
		else {
			this._showSelection();
		}

		// discard event
		event.stopPropagation();
	},

	/**
	 * Shows the game selection.
	 */
	_showSelection: function() {
		if (this._isEnabled) {
			// display status for each game
			this._list.children('li').each($.proxy(function(index, listItem) {
				var $listItem = $(listItem);
				var $gameID = $listItem.data('gameID');

				if ($gameID) {
					if (this._values[$gameID] && this._values[$gameID] != '') {
						$listItem.removeClass('missingValue');
					}
					else {
						$listItem.addClass('missingValue');
					}
				}
			}, this));
		}
	},

	/**
	 * Closes the game selection.
	 */
	_closeSelection: function() {
		if (!this._insertedDataAfterInit) {
			// prevent loop of death
			this._insertedDataAfterInit = true;
			
			this._disable();
		}
	},

	/**
	 * Changes the currently active game.
	 * 
	 * @param	object		event
	 */
	_changeGame: function(event) {
		var $button = $(event.currentTarget);
		this._insertedDataAfterInit = true;
		
		// save current value
		if (this._didInit) {
			this._values[this._gameID] = this._element.val();
		}
		
		// set new game
		this._gameID = $button.data('gameID');
		if (this._values[this._gameID]) {
			this._element.val(this._values[this._gameID]);
		}
		else {
			this._element.val('');
		}
		
		// update marking
		this._list.children('li').removeClass('active');
		$button.addClass('active');
		
		// update label
		this._list.prev('.dropdownCaption').children('span').text(this._availableGames[this._gameID]);
		
		// close selection and set focus on input element
		this._closeSelection();
		this._element.blur().focus();
		
		// @todo reload race, class and role edit, if exist (_linkedElements)
        this._loadOptions();
	},

    /**
	 * Loads options for creating a new character.
	 */
    _loadOptions: function() {
		// send ajax request
		new WCF.Action.Proxy({
			autoSend: true,
			data: {
				actionName: 'getOptions',
				className: 'wcf\\data\\character\\CharacterAction'
			},
			success: $.proxy(this._success, this)
		});

        //get html
        //show
        alert(this._gameID);
    },

	/**
	 * 
	 */
	_success: function (data, textStatus, jqXHR) {

	},

	/**
	 * Disables game selection for current element.
	 */
	_disable: function() {
		if (!this._list) {
			return;
		}
		
		// remove active marking
		this._list.prev('.dropdownCaption').children('span').removeClass('active').text(WCF.Language.get('wcf.global.button.disabled'));
		this._closeSelection();

		// update element value
		if (this._values[LANGUAGE_ID]) {
			this._element.val(this._values[LANGUAGE_ID]);
		}
		else {
			// no value for current game found, proceed with empty input
			this._element.val();
		}
		
		this._element.blur();
		this._isEnabled = false;
	},

	/**
	 * Prepares game variables on before submit.
	 */
	_submit: function() {
		// insert hidden form elements on before submit
		if (!this._isEnabled) {
			return 0xDEADBEAF;
		}

		// fetch active value
		if (this._gameID) {
			this._values[this._gameID] = this._element.val();
		}

		var $form = $(this._element.parents('form')[0]);
		var $elementID = this._element.wcfIdentify();

		for (var $gameID in this._values) {
			$('<input type="hidden" name="' + $elementID + '_game[' + $gameID + ']" value="' + this._values[$gameID] + '" />').appendTo($form);
		}

		// remove name attribute to prevent conflict with values
		this._element.removeAttr('name');
	}
};
