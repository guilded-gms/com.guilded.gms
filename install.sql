<?xml version="1.0" encoding="utf-8"?>
<data xmlns="http://www.guilded.eu" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.guilded.eu http://www.guilded.eu/XSD/characterOption.xsd">
	<import>
		<categories>
			<category name="profile">
				<showorder>1</showorder>
			</category>
			
			<!-- profile -->
			<category name="profile.general">
				<parent>profile</parent>
			</category>
			<category name="profile.details">
				<parent>profile</parent>
			</category>
			<!-- /profile -->
		</categories>

		<options>
			<!-- system -->
			<option name="level">
				<categoryname>profile.general</categoryname>
				<optiontype>integer</optiontype>
				<visible>15</visible>
				<editable>3</editable>
			</option>
			<option name="classes">
				<categoryname>profile.general</categoryname>
				<optiontype>gameClassSelect</optiontype>
				<outputclass>gms\system\option\character\CharacterOptionOutputSelectOptions</outputclass>
				<visible>15</visible>
				<editable>3</editable>
			</option>
			<option name="races">
				<categoryname>profile.general</categoryname>
				<optiontype>gameRaceSelect</optiontype>
				<outputclass>gms\system\option\character\CharacterOptionOutputSelectOptions</outputclass>
				<visible>15</visible>
				<editable>3</editable>
			</option>
			<option name="roles">
				<categoryname>profile.general</categoryname>
				<optiontype>gameRoleSelect</optiontype>
				<outputclass>gms\system\option\character\CharacterOptionOutputSelectOptions</outputclass>
				<visible>15</visible>
				<editable>3</editable>
			</option>
			<option name="guildID">
				<categoryname>profile.general</categoryname>
				<optiontype>guildSelect</optiontype>
				<visible>15</visible>
				<editable>3</editable>
			</option>
			<!-- /system -->

			<!-- details -->
			<option name="about">
				<categoryname>profile.details</categoryname>
				<optiontype>message</optiontype>
				<outputclass>gms\system\option\character\CharacterOptionOutputMessage</outputclass>
				<visible>15</visible>
				<editable>3</editable>
			</option>
			<option name="rankTitle">
				<categoryname>profile.details</categoryname>
				<optiontype>text</optiontype>
				<outputclass>gms\system\option\character\CharacterOptionOutputRankTitle</outputclass>
				<visible>15</visible>
				<editable>3</editable>
			</option>
			<option name="gender">
				<categoryname>profile.details</categoryname>
				<optiontype>radioButton</optiontype>
				<outputclass>gms\system\option\character\SelectOptionsCharacterOptionOutput</outputclass>
				<selectoptions><![CDATA[0:wcf.global.noDeclaration
1:gms.character.gender.male
2:gms.character.gender.female]]>
				</selectoptions>
				<defaultvalue>0</defaultvalue>
				<visible>15</visible>
				<editable>3</editable>
			</option>
			<!-- /details -->
		</options>
	</import>
</data>
                                                                                                                                                        <option name="myItemType" value="com.intellij.ide.projectView.impl.nodes.PsiDirectoryNode" />
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
      <recent name="I:\dev\guilded_2_0\com.guilded.gms\files\lib\acp\page" />
      <recent name="I:\dev\guilded_2_0\com.guilded.gms\files\lib\system\package\plugin" />
      <recent name="I:\dev\guilded_2_0\com.guilded.gms\files\lib\system\option" />
      <recent name="I:\dev\guilded_2_0\com.guilded.gms\files\lib\system\cache\builder" />
      <recent name="I:\dev\guilded_2_0\com.guilded.gms\files\images" />
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
      <window_info id="Ant Build" active="false" anchor="right" auto_hide="false" internal_type="DOCKED" type="DOCKED" visible="false" weight="0.25" sideWeight="0.5" order="1" side_tool="false" content_ui="tabs" 