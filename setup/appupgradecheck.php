    <?php
    
    require_once('../approot.inc.php');
    
    function AppUpgradeCheckInstall() {
	
		if ((version_compare(ITOP_VERSION, '3.0.0')<0) || (version_compare(ITOP_VERSION, '3.1.0')>=0)) {
			throw new Exception(ITOP_APPLICATION.' 3.0.2-1 cannot be installed automatically on '.ITOP_APPLICATION.' '.ITOP_VERSION.'. Please perform upgrade manually.');
		}
    }