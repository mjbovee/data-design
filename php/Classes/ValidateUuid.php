<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 10/18/18
 * Time: 10:35 AM
 */
namespace Michaelbovee\DataDesign;
require_once(dirname(__DIR__, 2) . "../vendor/autoload.php");
use Ramsey\Uuid\Uuid;
/**
 * Trait to validate Uuid
 * Trait will accept Uuids in the following formats:
 * 	1. Binary string
 * 	2. Human readable string
 * 	3. Ramsey\Uuid\Uuid object
 *
 * @author Michael Bovee <michael.j.bovee@gmail.com> - referencing trait originally authored by Dylan McDonald
 * @documentation https://bootcamp-coders.cnm.edu/class-materials/object-oriented/object-oriented-php.php
 */
trait ValidateUuid {
/**
 * validates Uuid string values and objects
 *
 * @param string|Uuid value $newUuid uuid to validate
 * @return Uuid object with valid uuid
 * @throws \InvalidArgumentException if $newUuid is not valid
 * @throws \RangeException if $newUuid is not valid uuid version 4
 */
	private static function validateUuid($newUuid) : Uuid {
		// verify string uuid
		if(gettype($newUuid) === "string") {
			// if string is binary (16 characters), convert it to a human readable string
			if(strlen($newUuid) === 16) {
				$newUuid = bin2hex($newUuid);
			}
			// validate uuid if it's a human readable string
			if(strlen($newUuid) === 32) {
				if(Uuid::isValid($newUuid) === false) {
					throw(new \InvalidArgumentException("invalid uuid"));
				}
				$uuid = Uuid::fromString($newUuid);
			} else {
				throw(new \InvalidArgumentException("invaid uuid"));
			}
		} else if(gettype($newUuid) === "object" && get_class($newUuid) === "Ramsey\\Uuid\\Uuid") {
			// if already valid uuid, just move on
			$uuid = $newUuid;
		} else {
			// if the 'uuid' isn't any of the above, we don't want it, throw exception
			throw(new \InvalidArgumentException("invalid uuid"));
		}
		// make sure uuid is version 4
		if($uuid->getVersion() !== 4) {
			throw(new \RangeException("uuid is incorrect version"));
		}
		return($uuid);

	}
}