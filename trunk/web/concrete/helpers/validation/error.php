<?
/**
 * @package Helpers
 * @subpackage Validation
 * @author Andrew Embler <andrew@concrete5.org>
 * @copyright  Copyright (c) 2003-2008 Concrete5. (http://www.concrete5.org)
 * @license    http://www.concrete5.org/license/     MIT License
 */

/**
 * Helper elements for dealing with errors in Concrete
 * @package Helpers
 * @subpackage Validation
 * @author Andrew Embler <andrew@concrete5.org>
 * @copyright  Copyright (c) 2003-2008 Concrete5. (http://www.concrete5.org)
 * @license    http://www.concrete5.org/license/     MIT License
 */
 	defined('C5_EXECUTE') or die(_("Access Denied."));
	class ValidationErrorHelper {
	
		protected $error = array();
		
		/** 
		 * Adds an error object or exception to the internal error array
		 * @param Exception | string $e
		 * @return void
		 */
		public function add($e) {
			if (is_object($e) && ($e instanceof Exception)) {
				$this->error[] = $e->getMessage();
			} else {
				$this->error[] = $e;
			}
		}
		
		/** 
		 * Returns a list of errors in the error helper
		 * @return array
		 */
		public function getList() {
			return $this->error;
		}
		
		/** 
		 * Returns whether or not this error helper has more than one error registered within it.
		 * @return bool
		 */
		public function has() {
			return (count($this->error) > 0);
		}

	}
	
?>