x+)JMU0415f040031Q��O�/�,�L�(�+)�ab���X�C蔐��wx~�+�HMLI-��O��-���󖔃k&��}�o����å�6+�,�8�(���3/9�4%�E����I�-�[�:���ݑ
Ւ��X��\�ZV��Lo�X��C��Ν%���zO�+tLI�m�uq�Uy��cKLVmy��y��j����SRC��:4�^�˻~ʹ4��rKӟ��A��Y	�]+y�<��;�k�w��kr��ۋ�ؿ�$3?�l��5?t�=�s�&��90_� w�t��y�9`Ւ��*�ox�~�1�P���L\&����̜TǤ�R����]=uF����NQ���[��ڏC�en��9)pMk���.dg~���ۛ����+�j��=�(�,3��Ԫu��4��Npmݽ����Ǿ�ѵg��&%B��]L��_�Ȫ�Eej�]_��"1�>%�8#)?�(�)��=1758��,�(�$����_��~�f���O{�����`NL-K̓Âi���^�_P��ċ��%g�/�j�Z V�\���Y��!ӹ7\����:�e��U�b�r������?�_��Ʊn���K6xHE#+�\q���ଦ�1�;&���3+/��b����p�_����탸y������]�6BU���3��$1/�Y�����jl�� s�-�3Ibk䒑Ֆ��"GϲΥ�
�.�2�����S⼮���f�@�����\O����u\�[]=[�&�Yj>�Y;K�����ײ��LWT�^���3/-�(7����kY�g��2���^%�)���~"��Z���9<��oږx)]�])#��Y!r~�{�������?�6���c���td����+? 	�j������&u��[�:�Er ʺ��{L���������'催9m���Yy������Ǵ3��fk<ZU����Z�b�_1\����X/Y��mwBr��WPE�ũE���7�~�C�zƀe,�]SU��@G(                 = $this->parseSelectOptions();
			if (!isset($options[$newValue])) {
				throw new UserInputException($option->optionName, 'validationFailed');
			}
		}
	}

	/**
	 * Get possible select-options.
	 *
	 * @return	array
	 */
	public function parseSelectOptions(){
		$result = array();

		foreach (GameHandler::getGames() as $game) {
			$result[$game->gameID] = $game->getTitle();
		}
		
		return $result;
	}

	/**
	 * @see \gms\system\option\IGameOptionType::setGame()
	 */
	public function setGame(Game $game) {
		$this->game = $game;
	}
}
