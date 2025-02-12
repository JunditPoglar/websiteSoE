<?php

use AcyMailing\Classes\AutomationClass;
use AcyMailing\Classes\FormClass;
use AcyMailing\Classes\ListClass;
use AcyMailing\Classes\UserClass;
use AcyMailing\Helpers\RegacyHelper;

defined('_JEXEC') or die('Restricted access');

class plgSystemAcymtriggers extends JPlugin
{
    var $oldUser = null;
    var $formToDisplay = [];

    public function initAcy()
    {
        $isInstalling = !empty($_REQUEST['option']) && $_REQUEST['option'] === 'com_installer' && !empty($_REQUEST['task']) && $_REQUEST['task'] === 'install.install';

        if ($isInstalling) {
            return false;
        }

        if (function_exists('acym_getVar')) {
            return true;
        }

        $ds = DIRECTORY_SEPARATOR;
        $helperFile = rtrim(JPATH_ADMINISTRATOR, $ds).$ds.'components'.$ds.'com_acym'.$ds.'helpers'.$ds.'helper.php';
        if (!file_exists($helperFile) || !include_once $helperFile) {
            return false;
        }

        return true;
    }

    public function onUserBeforeSave($user, $isnew, $new)
    {
        if (is_object($user)) {
            $user = get_object_vars($user);
        }
        $this->oldUser = $user;

        return true;
    }

    public function onUserAfterSave($user, $isnew, $success, $msg)
    {
        if (is_object($user)) {
            $user = get_object_vars($user);
        }
        if ($success === false || empty($user['email']) || !$this->initAcy()) {
            return true;
        }

        $userClass = new UserClass();
        if (!method_exists($userClass, 'synchSaveCmsUser')) {
            return true;
        }
        $userClass->synchSaveCmsUser($user, $isnew, $this->oldUser);

        return true;
    }

    public function onUserAfterDelete($user, $success, $msg)
    {
        if (is_object($user)) {
            $user = get_object_vars($user);
        }
        if ($success === false || empty($user['email']) || !$this->initAcy()) {
            return true;
        }


        $userClass = new UserClass();
        if (!method_exists($userClass, 'synchDeleteCmsUser')) {
            return true;
        }
        $userClass->synchDeleteCmsUser($user['email']);

        return true;
    }

    public function plgVmOnUpdateOrderPayment($orderData)
    {
        $this->handleVirtuemartOrderCreateUpdate($orderData);
    }

    public function plgVmOnUserOrder($orderData)
    {
        $this->handleVirtuemartOrderCreateUpdate($orderData);
    }

    private function handleVirtuemartOrderCreateUpdate($orderData)
    {
        static $alreadyTriggerVirtuemart = false;
        if (empty($orderData->virtuemart_user_id) || !$this->initAcy() || $alreadyTriggerVirtuemart) {
            return;
        }
        $alreadyTriggerVirtuemart = true;

        $userID = acym_loadResult(
            'SELECT `user`.`id` 
            FROM `#__acym_user` AS `user` 
            JOIN `#__virtuemart_order_userinfos` AS `vmuser` ON `vmuser`.`email` = `user`.`email` 
            WHERE `vmuser`.`virtuemart_user_id` = '.intval($orderData->virtuemart_user_id)
        );
        if (empty($userID)) {
            return;
        }

        $automationClass = new AutomationClass();
        $automationClass->trigger('vmorder', ['userId' => $userID]);
    }

    public function onAfterOrderCreate(&$order, &$send_email)
    {
        return $this->onAfterOrderUpdate($order, $send_email);
    }

    public function onAfterOrderUpdate(&$order, &$send_email)
    {
        if (!$this->initAcy()) {
            return;
        }

        acym_trigger('onAfterOrderUpdate', [&$order], 'plgAcymHikashop');
    }

    public function onAfterCartSave(&$element)
    {
        if (!$this->initAcy()) {
            return;
        }

        acym_trigger('onAfterCartSave', [&$element], 'plgAcymHikashop');
    }

    public function onBeforeCompileHead()
    {
        if (!empty($_REQUEST['tmpl']) && in_array($_REQUEST['tmpl'], ['component', 'raw'])) {
            return;
        }
        if (!empty($_REQUEST['acym_preview'])) {
            return;
        }

        $app = JFactory::getApplication();
        if ($app->getName() != 'site') {
            return;
        }

        if (!$this->initAcy()) {
            return;
        }

        $menu = acym_getMenu();
        if (empty($menu)) {
            return;
        }

        $formClass = new FormClass();
        $forms = $formClass->getAllFormsToDisplay();
        if (empty($forms)) {
            return;
        }

        foreach ($forms as $form) {
            if (!empty($form->pages) && (in_array($menu->id, $form->pages) || in_array('all', $form->pages))) {
                $this->formToDisplay[] = $formClass->renderForm($form);
            }
        }

        if (!empty($this->formToDisplay)) {
            acym_initModule();
        }
    }

    private function displayForms()
    {
        if (empty($this->formToDisplay)) {
            return;
        }

        $buffer = JFactory::getApplication()->getBody();

        $buffer = preg_replace('/(<body.*>)/Ui', '$1'.implode('', $this->formToDisplay), $buffer);

        JFactory::getApplication()->setBody($buffer);
    }

    public function onAfterRender()
    {
        $this->displayForms();
        $this->applyRegacy();
    }

    private function applyRegacy()
    {
        $db = JFactory::getDBO();
        $db->setQuery('SELECT `value` FROM #__acym_configuration WHERE `name` LIKE "%regacy" OR `name` LIKE "%\_sub"');
        $regacyOptions = $db->loadColumn();

        $regacyNeeded = false;
        foreach ($regacyOptions as $oneOption) {
            if (!empty($oneOption)) {
                $regacyNeeded = true;
                break;
            }
        }
        if (!$regacyNeeded) {
            return;
        }

        $option = $this->getVar('cmd', 'option');
        if (empty($option)) {
            return;
        }

        if (!$this->initAcy()) {
            return;
        }


        $config = acym_config();
        if ($config->get('regacy', 0)) {
            $components = [
                'com_users' => [
                    'view' => ['registration', 'profile', 'user'],
                    'edittasks' => ['profile', 'user'],
                    'email' => ['jform[email2]', 'jform[email1]'],
                    'password' => ['jform[password2]', 'jform[password1]'],
                    'checkLayout' => ['profile' => 'edit'],
                    'lengthafter' => ACYM_J40 ? 500 : 200,
                    'containerClass' => 'control-group',
                    'labelClass' => 'control-label',
                    'valueClass' => 'controls',
                    'baseOption' => 'regacy',
                ],
            ];
        } else {
            $components = [];
        }

        acym_trigger('onRegacyAddComponent', [&$components]);
        if (!isset($components[$option])) {
            return;
        }


        $viewVar = ['view'];
        if (!empty($components[$option]['viewvar'])) $viewVar = $components[$option]['viewvar'];

        $isvalid = false;
        foreach ($viewVar as $oneVar) {
            $view = acym_getVar('cmd', $oneVar, acym_getVar('cmd', 'task', acym_getVar('cmd', 'view')));
            if (in_array($view, $components[$option]['view'])) {
                $isvalid = true;
                break;
            }
        }
        if (!$isvalid) {
            return;
        }


        $regacyHelper = new RegacyHelper();
        if (!$regacyHelper->prepareLists($components[$option])) {
            return;
        }

        $this->includeRegacyLists($components[$option], $regacyHelper->label, $regacyHelper->lists);
    }

    function getVar($type, $name)
    {
        $jversion = preg_replace('#[^0-9\.]#i', '', JVERSION);
        if (version_compare($jversion, '4.0.0', '>=')) {
            $acyapp = JFactory::getApplication();
            $input = $acyapp->input;
            $sourceInput = $input->__get('REQUEST');

            if ($acyapp->isClient('administrator')) {
                $result = $sourceInput->get($name, null, $type);
            } else {
                $result = $sourceInput->get($name, $input->get($name, null, $type), $type);
            }
        } else {
            $result = JRequest::getVar($name, null, 'REQUEST', $type);
        }

        if (is_string($result)) {
            return JComponentHelper::filterText($result);
        }

        return $result;
    }

    private function includeRegacyLists($options, $label, $lists)
    {
        $config = acym_config();
        if (ACYM_J40) {
            $body = JFactory::getApplication()->getBody(false);
        } else {
            $body = JResponse::getBody();
        }

        $listsPosition = $config->get('regacy_listsposition', 'password');

        if ($options['baseOption'] != 'regacy') {
            $listsPosition = $config->get($options['baseOption'].'_regacy_listsposition', 'password');
        }

        if ('custom' === $listsPosition) {
            $customOptionName = $options['baseOption'] == 'regacy' ? 'regacy_listspositioncustom' : $options['baseOption'].'_regacy_listspositioncustom';
            $listAfter = explode(';', str_replace(['\\[', '\\]'], ['[', ']'], $config->get($customOptionName)));
            $after = empty($listAfter) ? $options['password'] : $listAfter;
        } elseif (!empty($options[$listsPosition])) {
            $after = $options[$listsPosition];
        } else {
            $after = [$listsPosition == 'email' ? 'email' : 'password2'];
        }

        $i = 0;
        while ($i < count($after)) {
            $lengthAfterMin = empty($options['lengthaftermin']) ? 0 : $options['lengthaftermin'];
            $lengthAfter = $options['lengthafter'];

            $regex = '#(name *= *"'.preg_quote($after[$i]).'".{'.$lengthAfterMin.','.$lengthAfter.'}</tr>)#Uis';
            if (preg_match($regex, $body)) {
                $lists = '<tr class="acym__regacy">
                        <td class="acym__regacy__label" style="padding-top:5px; vertical-align: top;">'.$label.'</td>
                        <td class="acym__regacy__values">'.$lists.'</td>
                    </tr>';
                $body = preg_replace($regex, '$1'.$lists, $body, 1);
                if (ACYM_J40) {
                    JFactory::getApplication()->setBody($body);
                } else {
                    JResponse::setBody($body);
                }

                return;
            }

            $containerClass = empty($options['containerClass']) ? '' : $options['containerClass'];
            $labelClass = empty($options['labelClass']) ? '' : $options['labelClass'];
            $valueClass = empty($options['valueClass']) ? '' : $options['valueClass'];

            $customHtmlElement = $config->get('regacy_customhtmlelement', '');

            switch ($customHtmlElement) {
                case 'li':
                    $formats = ['li' => ['li', 'li']];
                    break;
                case 'div':
                    $formats = ['div' => ['div', 'div']];
                    break;
                case 'p':
                    $formats = ['p' => ['div', 'div']];
                    break;
                case 'dd':
                    $formats = ['dd' => ['dt', 'div']];
                    break;
                default:
                    $formats = ['li' => ['li', 'li'], 'div' => ['div', 'div'], 'p' => ['div', 'div'], 'dd' => ['dt', 'div']];
            }

            for ($j = 0 ; $j < 2 ; $j++) {
                foreach ($formats as $oneFormat => $dispall) {
                    if (0 === $j) {
                        $regex = '#(name *= *"'.preg_quote($after[$i]).'".{'.$lengthAfterMin.','.$lengthAfter.'}</'.$oneFormat.'>)(?!\s*</'.$oneFormat.'>)#Uis';
                    } else {
                        $regex = '#(name *= *"'.preg_quote($after[$i]).'"((?!</'.$oneFormat.'>).)*</'.$oneFormat.'>)#Uis';
                    }
                    if (!preg_match($regex, $body)) continue;

                    if ($oneFormat == 'dd') {
                        $lists = '<dt class="'.$containerClass.'">
                                            <label class="acym__regacy__label '.$labelClass.'">'.$label.'</label>
                                        </dt>
                                        <dd class="acym__regacy__values '.$valueClass.'">'.$lists.'</dd>';
                    } else {
                        $lists = '<'.$dispall[0].' class="acym__regacy '.$containerClass.'">
                            <label class="acym__regacy__label '.$labelClass.'">'.$label.'</label>
                            <div class="acym__regacy__values '.$valueClass.'">'.$lists.'</div>
                        </'.$dispall[1].'>';
                    }
                    $body = preg_replace($regex, '$1'.$lists, $body, 1);
                    if (ACYM_J40) {
                        JFactory::getApplication()->setBody($body);
                    } else {
                        JResponse::setBody($body);
                    }

                    return;
                }
            }

            $i++;
        }
    }

    public function onAfterRoute()
    {
        if (!empty($_REQUEST['author']) && 'acymailing' === $_REQUEST['author'] && !empty($_REQUEST['task']) && 'file.upload' === $_REQUEST['task'] && !empty($_REQUEST['option']) && 'com_media' === $_REQUEST['option']) {
            $session = JFactory::getSession();
            $session->set('com_media.return_url', 'index.php?option=com_media&view=images&tmpl=component');
        }

        if (!$this->initAcy()) return true;
        acym_trigger('onRegacyAfterRoute', []);

        if (empty($_GET['code']) || empty($_GET['state'])) {
            return;
        }

        if ($_GET['state'] === 'acymailing') {
            acym_redirect(acym_completeLink('configuration&code='.$_GET['code'], false, true));
        }
    }

    function onAfterUserCreate(&$element)
    {
        if (!$this->initAcy()) {
            return true;
        }

        $formData = acym_getVar('array', 'data', []);
        $listData = acym_getVar('array', 'hikashop_visible_lists_checked', []);

        acym_trigger('onAfterHikashopUserCreate', [$formData, $listData, $element]);
    }

    public function onAfterInitialise()
    {
        $this->handleCron();
        $this->handleAutologin();
    }

    private function handleCron()
    {
    }

    private function getAcyConf($conf)
    {
        static $db;
        if (empty($db)) {
            $db = JFactory::getDBO();
        }

        $db->setQuery('SELECT `value` FROM #__acym_configuration WHERE `name` = '.$db->quote($conf));

        return $db->loadResult();
    }

    function handleAutologin()
    {
        $subId = $this->getVar('int', 'autoSubId');
        $subKey = $this->getVar('string', 'subKey');

        if (empty($subId) || empty($subKey)) {
            return;
        }

        if (!$this->initAcy()) {
            return;
        }

        $currentUrl = acym_currentURL();
        $cleanedUrl = substr($currentUrl, 0, strpos($currentUrl, 'autoSubId') - 1);

        $cmsId = acym_loadResult('SELECT `cms_id` FROM #__acym_user WHERE `id` = '.intval($subId).' AND `key` = '.acym_escapeDB($subKey));
        if (empty($cmsId)) {
            acym_redirect($cleanedUrl);

            return;
        }

        if ($cmsId === acym_currentUserId()) {
            return;
        }

        $username = acym_loadResult('SELECT `username` FROM #__users WHERE `id` = '.intval($cmsId));
        if (empty($username)) {
            acym_redirect($cleanedUrl);

            return;
        }

        acym_loadJoomlaPlugin('user');

        $options = ['action' => 'core.login.site'];
        $response = ['username' => $username];
        acym_triggerCmsHook('onUserLogin', [$response, $options]);

        acym_redirect($cleanedUrl);
    }

}
