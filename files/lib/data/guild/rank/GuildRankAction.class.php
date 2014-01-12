<?php
namespace gms\data\guild\rank;
use wcf\data\AbstractDatabaseObjectAction;

/**
 * GuildRank-related actions.
 * 
 * @author	Jeffrey Reichardt
 * @copyright	{{COPYRIGHT}}
 * @package	com.guilded.gms
 * @category	{{PROJECT-CATEGORY}}
 */
class GuildRankAction extends AbstractDatabaseObjectAction {
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$className
	 */
	public $className = 'gms\data\guild\rank\GuildRankEditor';
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsCreate
	 */
	protected $permissionsCreate = array('admin.gms.guild.canManageRank');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsDelete
	 */
	protected $permissionsDelete = array('admin.gms.guild.canManageRank');
	
	/**
	 * @see	\wcf\data\AbstractDatabaseObjectAction::$permissionsUpdate
	 */
	protected $permissionsUpdate = array('admin.gms.guild.canManageRank');
}
                                                                                                                                     data/guild/GuildAction.class.php" />
      <change type="MODIFICATION" beforePath="$PROJECT_DIR$/files/lib/acp/form/GuildAddForm.class.php" afterPath="$PROJECT_DIR$/files/lib/acp/form/GuildAddForm.class.php" />
      <change type="MODIFICATION" beforePath="$PROJECT_DIR$/files/lib/system/option/guild/GuildOptionHandler.class.php" afterPath="$PROJECT_DIR$/files/lib/system/option/guild/GuildOptionHandler.class.php" />
      <change type="MODIFICATION" beforePath="$PROJECT_DIR$/language/de.xml" afterPath="$PROJECT_DIR$/language/de.xml" />
      <change type="MODIFICATION" beforePath="$PROJECT_DIR$/acptemplates/guildAdd.tpl" afterPath="$PROJECT_DIR$/acptemplates/guildAdd.tpl" />
      <change type="MODIFICATION" beforePath="$PROJECT_DIR$/acptemplates/guildList.tpl" afterPath="$PROJECT_DIR$/acptemplates/guildList.tpl" />
      <change type="MOVED" beforePath="I:\dev\guilded_2_0\com.guilded.gms\files\lib\data\character\rank\CharacterRank.class.php" afterPath="$PROJECT_DIR$/files/lib/data/guild/rank/GuildRank.class.php" />
      <change type="MOVED" beforePath="I:\dev\guilded_2_0\com.guilded.gms\files\lib\data\character\rank\CharacterRankAction.class.php" afterPath="$PROJECT_DIR$/files/lib/data/guild/rank/GuildRankAction.class.php" />
      <change type="MOVED" beforePath="I:\dev\guilded_2_0\com.guilded.gms\files\lib\data\character\rank\CharacterRankEditor.class.php" afterPath="$PROJECT_DIR$/files/lib/data/guild/rank/GuildRankEditor.class.php" />
      <change type="MOVED" beforePath="I:\dev\guilded_2_0\com.guilded.gms\files\lib\data\character\rank\CharacterRankList.class.php" afterPath="$PROJECT_DIR$/files/lib/data/guild/rank/GuildRankList.class.php" />
    </list>
    <ignored path="com.guilded.gms.iws" />
    <ignored path=".idea/workspace.xml" />
    <ignored mask="*.log" />
    <ignored mask="*.tgz" />
    <ignored mask="*.tar" />
    <ignored mask="*.gz" />
    <ignored mask="*.txt" />
    <option name="TRACKING_ENABLED" value="true" />
    <option name="SHOW_DIALOG" value="false" />
    <option name="HIGHLIGHT_CONFLICTS" value="true" />
    <option name="HIGHLIGHT_NON_ACTIVE_CHANGELIST" value="false" />
    <option name="LAST_RESOLUTION" value="IGNORE" />
  </component>
  <component name="ChangesViewManager" flattened_view="true" show_ignored="false" />
  <component name="CreatePatchCommitExecutor">
    <option name="PATCH_PATH" value="" />
  </component>
  <component name="DaemonCodeAnalyzer">
    <disable_hints />
  </component>
  <component name="ExecutionTargetManager" SELECTED_TARGET="default_target" />
  <component name="FavoritesManager">
    <favorites_list name="com.guilded.gms" />
  </component>
  <component name="FileEditorManager">
    <leaf>
      <file leaf-file-name="GuildAddForm.class.php" pinned="false" current="false" current-in-tab="false">
        <entry file="file://$PROJECT_DIR$/files/lib/acp/form/GuildAddForm.class.php">
          <provider selected="true" editor-type-id="text-editor">
            <state line="128" column="15" selection-start="3094" selection-end="3094" vertical-scroll-proportion="-15.692307" vertical-offset="1632" max-vertical-offset="2924">
              <folding />
            </state>
          </provider>
        </entry>
      </file>
      <file leaf-file-name="Game.class.php" pinned="false" current="false" current-in-tab="false">
        <entry file="file://$PROJECT_DIR$/files/lib/data/game/Game.class.php">
          <provider selected="true" editor-type-id="text-editor">
            <state line="13" column="0" selection-start="431" selection-end="727" vertical-scroll-proportion="-2.6153846" vertical-offset="0" max-vertical-offset="4794">
              <folding />
            </state>
          </provider>
        </entry>
      </file>
      <file leaf-file-name="GuildAction.class.php" pinned="false" current="false" current-in-tab="false">
        <entry file="file://$PROJECT_DIR$/files/lib/data/guild/GuildAction.class.php">
          <provider selected="true" editor-type-id="text-editor">
            <state line="56" column="53" selection-start="1496" selection-end="1533" vertical-scroll-proportion="-28.115385" vertical-offset="153" max-vertical-offset="3502">
              <folding />
            </state>
          </provider>
        </entry>
      </file>
      <file leaf-file-name="install_com.guilded.gms.php" pinned="false" current="false" current-in-tab="false">
        <entry file="file://$PROJECT_DIR$/files/acp/install_com.guilded.gms.php">
          <provider selected="true" editor-type-id="text-editor">
            <state line="4" column="0" selection-start="47" selection-end="238" vertical-scroll-proportion="-2.6153846" vertical-offset="0" max-vertical-offset="476">
              <folding />
            </state>
          </provider>
        </entry>
      </file>
      <file leaf-file-name="guildAdd.tpl" pinned="false" current="false" current-in-tab="false">
        <entry file="file://$PROJECT_DIR$/acptemplates/guildAdd.tpl">
          <provider selected="true" editor-type-id="text-editor">
            <state line="69" column="99" selection-start="2222" selection-end="2230" vertical-scroll-proportion="-23.0" vertical-offset="0" max-vertical-offset="1564">
              <folding />
            </state>
          </provider>
        </entry>
      </file>
      <file leaf-file-name="guildList.tpl" pinned="false" current="false" current-in-tab="false">
        <entry file="file://$PROJECT_DIR$/acptemplates/guildList.tpl">
          <provider selected="true" editor-type-id="text-editor">
            <state line="61" column="266" selection-start="2755" selection-end="2755" vertical-scroll-proportion="-14.384615" vertical-offset="663" max-vertical-offset="1717">
              <folding />
            </state>
          </provider>
        </entry>
      </file>
      <file leaf-file-name="Character.class.php" pinned="false" current="false" current-in-tab="false">
        <entry file="file://$PROJECT_DIR$/files/lib/data/character/Character.class.php">
          <provider selected="true" editor-type-id="text-editor">
            <state line="2" column="4" selection-start="40" selection-end="40" vertical-scroll-proportion="-1.3076923" vertical-offset="0" max-vertical-offset="2975">
              <folding>
                <element signature="e#36#70#0" expanded="true" />
              </folding>
            </state>
          </provider>
        </entry>
      </file>
      <file leaf-file-name="GuildRankAction.class.php" pinned="false" current="false" current-in-tab="false">
        <entry file="file://$PROJECT_DIR$/files/lib/data/guild/rank/GuildRankAction.class.php">
          <provider selected="true" editor-type-id="text-editor">
            <state line="31" column="57" selection-start="875" selection-end="875" vertical-scroll-proportion="-20.26923" vertical-offset="0" max-vertical-offset="663">
              <folding />
            </state>
          </provider>
        </entry>
      </file>
      <file leaf-file-name="GuildRank.class.php" pinned="false" current="true" current-in-tab="true">
        <entry file="file://$PROJECT_DIR$/files/lib/data/guild/rank/GuildRank.class.php">
          <provider selected="true" editor-type-id="text-editor">
            <state line="5" column="30" selection-start="108" selection-end="108" vertical-scroll-proportion="0.101553164" vertical-offset="0" max-vertical-offset="837">
              <folding />
            </state>
          </provider>
        </entry>
      </file>
      <file leaf-file-name="de.xml" pinned="false" current="false" current-in-tab="false">
        <entry file="file://$PROJECT_DIR$/language/de.xml">
          <provider selected="true" editor-type-id="text-editor">
            <state line="42" column="37" selection-start="2243" selection-end="2243" vertical-scroll-proportion="-18.32" vertical-offset="256" max-vertical-offset="2312">
              <folding />
            </state>
          </provider>
        </entry>
      </file>
    </leaf>
  </component>
  <component name="FindManager">
    <FindUsagesManager>
      <setting name="OPEN_NEW_TAB" value="false" />
    </FindUsagesManager>
  </component>
  <component name="Git.Settings">
    <option name="RECENT_GIT_ROOT_PATH" value="$PROJECT_DIR$" />
  </component>
  <component name="GitLogSettings">
    <option name="myDateState">
      <MyDateState />
    </option>
  </component>
  <component name="IdeDocumentHistory">
    <option name="changedFiles">
      <list>
        <option value="$PROJECT_DIR$/files/lib/system/package/plugin/GameRolePackageInstallationPlugin.class.php" />
        <option value="$PROJECT_DIR$/files/lib/data/game/Game.class.php" />
        <option value="$PROJECT_DIR$/files/lib/system/package/plugin/GameClassificationPackageInstallationPlugin.class.php" />
        <option value="$PROJECT_DIR$/files/lib/system/package/plugin/GameFactionPackageInstallationPlugin.class.php" />
        <option value="$PROJECT_DIR$/files/lib/system/package/plugin/GameRacePackageInstallationPlugin.class.php" />
        <option value="$PROJECT_DIR$/packageInstallationPlugin.xml" />
        <option value="$PROJECT_DIR$/acptemplates/guildAdd.tpl" />
        <option value="$PROJECT_DIR$/files/lib/system/option/guild/GuildOptionHandler.class.php" />
        <option value="$PROJECT_DIR$/language/de.xml" />
        <option value="$PROJECT_DIR$/files/lib/acp/form/GuildAddForm.class.php" />
        <option value="$PROJECT_DIR$/files/lib/data/guild/GuildAction.class.php" />
        <option value="$PROJECT_DIR$/files/lib/data/game/GameAction.class.php" />
        <option value="$PROJECT_DIR$/acptemplates/guildList.tpl" />
        <option value="$PROJECT_DIR$/files/lib/data/character/Character.class.php" />
        <option value="$PROJECT_DIR$/files/lib/data/guild/rank/GuildRankAction.class.php" />
        <option value="$PROJECT_DIR$/files/lib/data/guild/rank/GuildRank.class.php" />
      </list>
    </option>
  </component>
  <component name="PhpWorkspaceProjectConfiguration" backward_compatibility_performed="true">
    <include_path>
      <path value="I:\dev\wcf_2_0\WCF\wcfsetup\install\files\lib" />
      <path value="I:\dev\guilded_2_0\com.guilded.wcf.character\files\lib" />
      <path value="I:\dev\guilded_2_0\com.guilded.wcf.game\files\lib" />
    </include_path>
  </component>
  <component name="ProjectFrameBounds">
    <option name="x" value="-8" />
    <option name="y" value="-8" />
    <option name="width" value="1936" />
    <option name="height" value="1066" />
  </component>
  <component name="ProjectLevelVcsManager" settingsEditedManually="false">
    <OptionsSetting value="true" id="Add" />
    <OptionsSetting value="true" id="Remove" />
    <OptionsSetting value="true" id="Checkout" />
    <OptionsSetting value="true" id="Update" />
    <OptionsSetting value="true" id="Status" />
    <OptionsSetting value="true" id="Edit" />
    <ConfirmationsSetting value="2" id="Add" />
    <ConfirmationsSetting value="0" id="Remove" />
  </component>
  <component name="ProjectReloadState">
    <option name="STATE" value="0" />
  </component>
  <component name="ProjectView">
    <navigator currentView="ProjectPane" proportions="" version="1" splitterProportion="0.5">
      <flattenPackages />
      <showMembers />
      <showModules />
      <showLibraryContents ProjectPane="true" />
      <hideEmptyPackages />
      <abbreviatePackageNames />
      <autoscrollToSource />
      <autoscrollFromSource />
      <sortByType />
    </navigator>
    <panes>
      <pane id="Scope" />
      <pane id="ProjectPane">
        <subPane>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="language" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="system" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="system" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="package" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="plugin" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="system" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="option" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="system" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="option" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="guild" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="system" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="option" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="character" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="system" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="menu" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="system" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="menu" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="character" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="profile" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="system" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="event" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="system" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="event" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="credit" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="system" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="credit" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="form" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATx+)JMU011e040031Qp�H,JL.I-rLIq�/��K�I,.�+�(`�}AB}�m#�k!=�l���7~���5%�M[��i�6�v���t���1a��������J2��|2��5vJ��-f��I=�g|�7�N����ٵ,5��9�$5=��ӵ|%2r���Rj7I�V��9�����_���Ƈ���M�n;��D�4T�{ifN
�e�K���L�_zjjH�_����D�u`����"D0ϛU��z�J��]N k�$j;�]�s�{�#������=�� f�4                                                                                                                                                                                                                                                <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="data" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="guild" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="data" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="guild" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="rank" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="data" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="character" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="acp" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="lib" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="acp" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="form" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="files" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="acp" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
          <PATH>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.ProjectViewProjectNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="com.guilded.gms" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
            <PATH_ELEMENT>
              <option name="myItemId" value="acptemplates" />
              <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
            </PATH_ELEMENT>
          </PATH>
        </subPane>
      </pane>
    </panes>
  </component>
  <component name="PropertiesComponent">
    <property name="options.splitter.main.proportions" value="0.3" />
    <property name="WebServerToolWindowFactoryState" value="false" />
    <property name="options.lastSelected" value="fileTemplates" />
    <property name="last_opened_file_path" value="$PROJECT_DIR$/../com.guilded.gms.game.wow" />
    <property name="FullScreen" value="false" />
    <property name="options.searchVisible" value="true" />
    <property name="options.splitter.details.proportions" value="0.2" />
  </component>
  <component name="PublishConfig">
    <servers>
      <server id="081f0a20-1958-41e3-ba4d-a5aac61c288d">
        <serverdata>
          <mappings>
            <mapping local="$PROJECT_DIR$" />
          </mappings>
        </serverdata>
      </server>
      <server id="93623c1c-fa65-4323-a801-6ac5e1247f76">
        <serverdata />
      </server>
    </servers>
  </component>
  <component name="RecentsManager">
    <key name="CopyFile.RECENT_KEYS">
      <recent name="I:\dev\guilded_2_0\com.guilded.gms\files\lib\system\package\plugin" />
      <recent name="I:\dev\guilded_2_0\com.guilded.gms\files\lib\system\option" />
      <recent name="I:\dev\guilded_2_0\com.guilded.gms\files\lib\system\cache\builder" />
      <recent name="I:\dev\guilded_2_0\com.guilded.gms\files\images" />
      <recent name="I:\dev\guilded_2_0\com.guilded.gms\acptemplates" />
    </key>
    <key name="MoveFile.RECENT_KEYS">
      <recent name="I:\dev\guilded_2_0\com.guilded.gms\files\lib\data\guild" />
      <recent name="I:\dev\guilded_2_0\com.guilded.gms\files\images" />
    </key>
  </component>
  <component name="RunManager">
    <configuration default="true" type="PHPUnitRunConfigurationType" factoryName="PHPUnit">
      <TestRunner />
      <method />
    </configuration>
    <configuration default="true" type="PhpLocalRunConfigurationType" factoryName="PHP Console">
      <method />
    </configuration>
    <configuration default="true" type="JavascriptDebugType" factoryName="JavaScript Debug" singleton="true">
      <method />
    </configuration>
    <configuration default="true" type="PhpUnitRemoteRunConfigurationType" factoryName="PHPUnit on Server">
      <method />
    </configuration>
    <list size="0" />
  </component>
  <component name="ShelveChangesManager" show_recycled="false" />
  <component name="SvnConfiguration" maxAnnotateRevisions="500" myUseAcceleration="nothing" myAutoUpdateAfterCommit="false" cleanupOnStartRun="false" SSL_PROTOCOLS="all">
    <option name="USER" value="" />
    <option name="PASSWORD" value="" />
    <option name="mySSHConnectionTimeout" value="30000" />
    <option name="mySSHReadTimeout" value="30000" />
    <option name="LAST_MERGED_REVISION" />
    <option name="MERGE_DRY_RUN" value="false" />
    <option name="MERGE_DIFF_USE_ANCESTRY" value="true" />
    <option name="UPDATE_LOCK_ON_DEMAND" value="false" />
    <option name="IGNORE_SPACES_IN_MERGE" value="false" />
    <option name="CHECK_NESTED_FOR_QUICK_MERGE" value="false" />
    <option name="IGNORE_SPACES_IN_ANNOTATE" value="true" />
    <option name="SHOW_MERGE_SOURCES_IN_ANNOTATE" value="true" />
    <option name="FORCE_UPDATE" value="false" />
    <option name="IGNORE_EXTERNALS" value="false" />
    <myIsUseDefaultProxy>false</myIsUseDefaultProxy>
  </component>
  <component name="TaskManager">
    <task active="true" id="Default" summary="Default task">
      <changelist id="a3ff116e-dbb5-4fbb-936b-b98260c54a26" name="Default" comment="" />
      <created>1371073209195</created>
      <updated>1371073209195</updated>
    </task>
    <task id="LOCAL-00001" summary="Fixed setup">
      <created>1372283613493</created>
      <updated>1372283613493</updated>
    </task>
    <task id="LOCAL-00002" summary="added license information">
      <created>1376146560740</created>
      <updated>1376146560740</updated>
    </task>
    <task id="LOCAL-00003" summary="fixed language path">
      <created>1376180135016</created>
      <updated>1376180135016</updated>
    </task>
    <task id="LOCAL-00004" summary="small changes">
      <created>1385770496003</created>
      <updated>1385770496003</updated>
    </task>
    <task id="LOCAL-00005" summary="merged packages">
      <created>1387121336994</created>
      <updated>1387121336994</updated>
    </task>
    <task id="LOCAL-00006" summary="merged other packages, some fixes">
      <created>1387133395224</created>
      <updated>1387133395224</updated>
    </task>
    <task id="LOCAL-00007" summary="Added GameProviderData cronjob for auto updates.">
      <created>1387135951352</created>
      <updated>1387135951352</updated>
    </task>
    <task id="LOCAL-00008" summary="fixed option handle and templateListener">
      <created>1387145597315</created>
      <updated>1387145597315</updated>
    </task>
    <task id="LOCAL-00009" summary="changed logo">
      <created>1387146997616</created>
      <updated>1387146997616</updated>
    </task>
    <task id="LOCAL-00010" summary="fixed table names">
      <created>1387404173802</created>
      <updated>1387404173802</updated>
    </task>
    <task id="LOCAL-00011" summary="some changes">
      <created>1387749916998</created>
      <updated>1387749916998</updated>
    </task>
    <task id="LOCAL-00012" summary="small changes">
      <created>1387752032169</created>
      <updated>1387752032169</updated>
    </task>
    <task id="LOCAL-00013" summary="massive fixes">
      <created>1387828895117</created>
      <updated>1387828895117</updated>
    </task>
    <task id="LOCAL-00014" summary="option fix">
      <created>1387829840358</created>
      <updated>1387829840358</updated>
    </task>
    <task id="LOCAL-00015" summary="application fix, added GuildOptionCacheBuilder">
      <created>1387830188231</created>
      <updated>1387830188231</updated>
    </task>
    <task id="LOCAL-00016" summary="some changes">
      <created>1387833610153</created>
      <updated>1387833610153</updated>
    </task>
    <task id="LOCAL-00017" summary="small changes">
      <created>1387922645028</created>
      <updated>1387922645028</updated>
    </task>
    <task id="LOCAL-00018" summary="Added character rank">
      <created>1388160139317</created>
      <updated>1388160139317</updated>
    </task>
    <task id="LOCAL-00019" summary="small changes">
      <created>1388780087019</created>
      <updated>1388780087019</updated>
    </task>
    <task id="LOCAL-00020" summary="fixed gitignore">
      <created>1388780145999</created>
      <updated>1388780145999</updated>
    </task>
    <task id="LOCAL-00021" summary="some clean up, game pips added">
      <created>1388960917127</created>
      <updated>1388960917127</updated>
    </task>
    <task id="LOCAL-00022" summary="fixed pip installation">
      <created>1389033756020</created>
      <updated>1389033756020</updated>
    </task>
    <task id="LOCAL-00023" summary="added guild select">
      <created>1389101290899</created>
      <updated>1389101290899</updated>
    </task>
    <task id="LOCAL-00024" summary="fixed pip installation">
      <created>1389117562854</created>
      <updated>1389117562854</updated>
    </task>
    <task id="LOCAL-00025" summary="added faction pip">
      <created>1389214770317</created>
      <updated>1389214770317</updated>
    </task>
    <option name="localTasksCounter" value="26" />
    <servers />
  </component>
  <component name="TodoView" selected-index="0">
    <todo-panel id="selected-file">
      <are-packages-shown value="false" />
      <are-modules-shown value="false" />
      <flatten-packages value="false" />
      <is-autoscroll-to-source value="false" />
    </todo-panel>
    <todo-panel id="all">
      <are-packages-shown value="false" />
      <are-modules-shown value="false" />
      <flatten-packages value="false" />
      <is-autoscroll-to-source value="false" />
    </todo-panel>
    <todo-panel id="default-changelist">
      <are-packages-shown value="false" />
      <are-modules-shown value="false" />
      <flatten-packages value="false" />
      <is-autoscroll-to-source value="false" />
    </todo-panel>
  </component>
  <component name="ToolWindowManager">
    <frame x="-8" y="-8" width="1936" height="1066" extended-state="6" />
    <editor active="true" />
    <layout>
      <window_info id="Changes" active="false" anchor="bottom" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.18351649" sideWeight="0.5" order="7" side_tool="false" content_ui="tabs" />
      <window_info id="Terminal" active="false" anchor="bottom" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.33" sideWeight="0.5" order="8" side_tool="false" content_ui="tabs" />
      <window_info id="TODO" active="false" anchor="bottom" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.18969299" sideWeight="0.5" order="6" side_tool="false" content_ui="tabs" />
      <window_info id="Find" active="false" anchor="bottom" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.24615385" sideWeight="0.5" order="1" side_tool="false" content_ui="tabs" />
      <window_info id="Database" active="false" anchor="right" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.33" sideWeight="0.5" order="3" side_tool="false" content_ui="tabs" />
      <window_info id="Structure" active="false" anchor="left" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.25" sideWeight="0.5" order="1" side_tool="false" content_ui="tabs" />
      <window_info id="Project" active="false" anchor="left" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="true" weight="0.2678762" sideWeight="0.75384617" order="0" side_tool="false" content_ui="combo" />
      <window_info id="Debug" active="false" anchor="bottom" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.4" sideWeight="0.5" order="3" side_tool="false" content_ui="tabs" />
      <window_info id="Favorites" active="false" anchor="left" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.33" sideWeight="0.5" order="2" side_tool="true" content_ui="tabs" />
      <window_info id="Event Log" active="false" anchor="bottom" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.33" sideWeight="0.5" order="7" side_tool="true" content_ui="tabs" />
      <window_info id="Run" active="false" anchor="bottom" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.33" sideWeight="0.5" order="2" side_tool="false" content_ui="tabs" />
      <window_info id="Version Control" active="false" anchor="bottom" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.32894737" sideWeight="0.5" order="7" side_tool="false" content_ui="tabs" />
      <window_info id="Documentation" active="false" anchor="right" auto_hide="false" internal_type="DOCKED" type="FLOATING" visible="false" weight="0.33" sideWeight="0.5" order="3" side_tool="false" content_ui="tabs" x="92" y="92" width="1736" height="866" />
      <window_info id="Cvs" active="false" anchor="bottom" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.25" sideWeight="0.5" order="4" side_tool="false" content_ui="tabs" />
      <window_info id="Message" active="false" anchor="bottom" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.33" sideWeight="0.5" order="0" side_tool="false" content_ui="tabs" />
      <window_info id="Ant Build" active="false" anchor="right" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.25" sideWeight="0.5" order="1" side_tool="false" content_ui="tabs" />
      <window_info id="Messages" active="false" anchor="bottom" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.32894737" sideWeight="0.5" order="7" side_tool="false" content_ui="tabs" />
      <window_info id="Commander" active="false" anchor="right" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.4" sideWeight="0.5" order="0" side_tool="false" content_ui="tabs" />
      <window_info id="Hierarchy" active="false" anchor="right" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.25" sideWeight="0.5" order="2" side_tool="false" content_ui="combo" />
      <window_info id="Inspection" active="false" anchor="bottom" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.3991228" sideWeight="0.5" order="5" side_tool="false" content_ui="tabs" />
    </layout>
  </component>
  <component name="VcsContentAnnotationSettings">
    <option name="myLimit" value="2678400000" />
  </component>
  <component name="VcsManagerConfiguration">
    <option name="myTodoPanelSettings">
      <TodoPanelSettings />
    </option>
    <MESSAGE value="Fixed setup" />
    <MESSAGE value="added license information" />
    <MESSAGE value="fixed language path" />
    <MESSAGE value="merged packages" />
    <MESSAGE value="merged other packages, some fixes" />
    <MESSAGE value="Added GameProviderData cronjob for auto updates." />
    <MESSAGE value="fixed option handle and templateListener" />
    <MESSAGE value="changed logo" />
    <MESSAGE value="fixed table names" />
    <MESSAGE value="massive fixes" />
    <MESSAGE value="option fix" />
    <MESSAGE value="application fix, added GuildOptionCacheBuilder" />
    <MESSAGE value="some changes" />
    <MESSAGE value="Added character rank" />
    <MESSAGE value="small changes" />
    <MESSAGE value="fixed gitignore" />
    <MESSAGE value="some clean up, game pips added" />
    <MESSAGE value="added guild select" />
    <MESSAGE value="fixed pip installation" />
    <MESSAGE value="added faction pip" />
    <option name="LAST_COMMIT_MESSAGE" value="added faction pip" />
  </component>
  <component name="XDebuggerManager">
    <breakpoint-manager />
  </component>
  <component name="editorHistoryManager">
    <entry file="file://$PROJECT_DIR$/files/lib/system/option/character/CharacterOptionHandler.class.php">
      <provider selected="true" editor-type-id="text-editor">
        <state line="68" column="39" selection-start="1791" selection-end="1791" vertical-scroll-proportion="-5.576923" vertical-offset="875" max-vertical-offset="2618">
          <folding />
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/files/lib/system/option/guild/GuildOptionHandler.class.php">
      <provider selected="true" editor-type-id="text-editor">
        <state line="68" column="22" selection-start="1641" selection-end="1648" vertical-scroll-proportion="-10.807693" vertical-offset="875" max-vertical-offset="2771">
          <folding>
            <element signature="e#41#64#0" expanded="true" />
          </folding>
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/language/de.xml">
      <provider selected="true" editor-type-id="text-editor">
        <state line="42" column="37" selection-start="2243" selection-end="2243" vertical-scroll-proportion="-18.32" vertical-offset="256" max-vertical-offset="2312">
          <folding />
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/../../wcf_2_0/WCF/wcfsetup/install/files/lib/data/option/Option.class.php">
      <provider selected="true" editor-type-id="text-editor">
        <state line="16" column="6" selection-start="399" selection-end="399" vertical-scroll-proportion="-0.7931548" vertical-offset="771" max-vertical-offset="3247">
          <folding />
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/files/acp/install_com.guilded.gms.php">
      <provider selected="true" editor-type-id="text-editor">
        <state line="4" column="0" selection-start="47" selection-end="238" vertical-scroll-proportion="-2.6153846" vertical-offset="0" max-vertical-offset="476">
          <folding />
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/../../wcf_2_0/WCF/wcfsetup/install/files/lib/data/AbstractDatabaseObjectAction.class.php">
      <provider selected="true" editor-type-id="text-editor">
        <state line="240" column="25" selection-start="6075" selection-end="6087" vertical-scroll-proportion="0.4374034" vertical-offset="3678" max-vertical-offset="8857">
          <folding />
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/../../wcf_2_0/WCF/wcfsetup/install/files/lib/data/IToggleAction.class.php">
      <provider selected="true" editor-type-id="text-editor">
        <state line="14" column="10" selection-start="388" selection-end="388" vertical-scroll-proportion="0.35416666" vertical-offset="0" max-vertical-offset="672">
          <folding />
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/files/lib/data/game/Game.class.php">
      <provider selected="true" editor-type-id="text-editor">
        <state line="13" column="0" selection-start="431" selection-end="727" vertical-scroll-proportion="-2.6153846" vertical-offset="0" max-vertical-offset="4794">
          <folding />
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/files/lib/data/game/GameAction.class.php">
      <provider selected="true" editor-type-id="text-editor">
        <state line="12" column="25" selection-start="373" selection-end="373" vertical-scroll-proportion="-0.30357143" vertical-offset="408" max-vertical-offset="1088">
          <folding>
            <element signature="e#31#73#0" expanded="true" />
          </folding>
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/files/lib/acp/form/GuildAddForm.class.php">
      <provider selected="true" editor-type-id="text-editor">
        <state line="128" column="15" selection-start="3094" selection-end="3094" vertical-scroll-proportion="-15.692307" vertical-offset="1632" max-vertical-offset="2924">
          <folding />
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/files/lib/data/guild/GuildAction.class.php">
      <provider selected="true" editor-type-id="text-editor">
        <state line="56" column="53" selection-start="1496" selection-end="1533" vertical-scroll-proportion="-28.115385" vertical-offset="153" max-vertical-offset="3502">
          <folding />
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/acptemplates/guildAdd.tpl">
      <provider selected="true" editor-type-id="text-editor">
        <state line="69" column="99" selection-start="2222" selection-end="2230" vertical-scroll-proportion="-23.0" vertical-offset="0" max-vertical-offset="1564">
          <folding />
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/acptemplates/guildList.tpl">
      <provider selected="true" editor-type-id="text-editor">
        <state line="61" column="266" selection-start="2755" selection-end="2755" vertical-scroll-proportion="-14.384615" vertical-offset="663" max-vertical-offset="1717">
          <folding />
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/files/lib/data/character/Character.class.php">
      <provider selected="true" editor-type-id="text-editor">
        <state line="2" column="4" selection-start="40" selection-end="40" vertical-scroll-proportion="-1.3076923" vertical-offset="0" max-vertical-offset="2975">
          <folding>
            <element signature="e#36#70#0" expanded="true" />
          </folding>
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/files/lib/data/guild/rank/GuildRankAction.class.php">
      <provider selected="true" editor-type-id="text-editor">
        <state line="31" column="57" selection-start="875" selection-end="875" vertical-scroll-proportion="-20.26923" vertical-offset="0" max-vertical-offset="663">
          <folding />
        </state>
      </provider>
    </entry>
    <entry file="file://$PROJECT_DIR$/files/lib/data/guild/rank/GuildRank.class.php">
      <provider selected="true" editor-type-id="text-editor">
        <state line="5" column="30" selection-start="108" selection-end="108" vertical-scroll-proportion="0.101553164" vertical-offset="0" max-vertical-offset="837">
          <folding />
        </state>
      </provider>
    </entry>
  </component>
</project>

                                                                                                                                                                                                                                                                                                                                                                                                         ��          ���
lc?�w��Z��0ow� 
option.xml        O@8    R��              ��          ��Y�����ں�lȶl�36H- package.xml       R���    R��              ��          *UJN��x����I:hW��= packageInstallationPlugin.xml     R�Ŗ    R�m�              ��          ���l[H�;�3��0#"� pageMenu.xml      P��    R�(�              ��          �7pT�ݎ��|$ZL��h=k�� templateListener.xml      R�(6    R�(p              ��           wUR�-as��KҸ���I�� templates/__copyright.tpl R�(6    R�(d              ��           �r���d���V6�/�<��HDu templates/__headerLogo.tpl        R�(6    R�(P              ��           �@�-�b�����@�\�]�e !templates/__javascriptInclude.tpl R��0    R���              ��          ʷ6.�v@@pH,ܤ=}�.��- templates/character.tpl   R��0    R��^              ��          2�=GT@M$����\j}w`� templates/characterAdd.tpl        R��0    P��:              ��           d(Q�ѽ���fG�y�g�L�  templates/characterBBCodeTag.tpl  R��0    R�L              ��          -K�rC�����'$@n�� "templates/characterInformation.tpl        R��0    R���              ��          ���2I��ݜ
��M��lܾ� templates/characterList.tpl       R��0    R���              ��          "=�H��ҳ�w�PA��A襐 templates/characterListItem.tpl   R��0    R���              ��          ���o� �"�K=�������{ !templates/characterManagement.tpl R��0    R���              ��          ����,��F���Qo.0m��0 templates/characterOptions.tpl    R��0    R��               ��          c�$s�~�^�'���^i templates/characterPanel.tpl      R��0    R���              ��           �S�������BZ׼29�z� #templates/characterProfileAbout.tpl       R��1    Rx�              ��          U��^�>7���۲��W#�� -templates/characterProfileOptionFieldList.tpl     R��1    R��               ��          dz���(#�E����<H��� %templates/characterProfilePreview.tpl     R��1    R��j              ��          sG*3OĪ��|�נ�8aT templates/characterSidebar.tpl    R��'    R�Ć              ��          _��ԟG�|�DL�q��
� *templates/dash