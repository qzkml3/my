<?php

	class Framework
	{
		static function getController() {
			$controller = $_SERVER["SCRIPT_FILENAME"];
			$controller = str_replace(".html", ".php", $controller);
			if (file_exists($controller)) {
				return $controller;
			}
		}

		static function getDocTitle() {
			if (DOC_TITLE) {
				echo DOC_TITLE . " : " . Setting::SITE_TITLE_ADMIN;
			} else {
				echo SITE_TITLE;
			}
		}
		
		static function hasHeaderRemove() {
			if (StringUtil::startsWith(phpversion(), "5.2.12")) { //office apm
				return false;
			} else {
				return true;
			}
		}
		
		static function headerRemove($name) {
			if (function_exists("header_remove")) {
				header_remove($name);
			} else {
				header($name . ":");
			}
		}
		
		static function setSession() {
			session_start();
			
			self::headerRemove("Cache-Control");
			self::headerRemove("Pragma");
			self::headerRemove("Expires");
		}
	}
?>