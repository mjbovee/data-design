<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 10/18/18
 * Time: 10:35 AM
 */
/**
 * Trait to validate Uuid
 * Trait will accept Uuids in the following formats:
 * 	1. Binary string
 * 	2. Human readable string
 * 	3. Ramsey\Uuid object
 *
 * @author Michael Bovee <michael.j.bovee@gmail.com> - referencing trait originally authored by Dylan McDonald
 * @documentation https://bootcamp-coders.cnm.edu/class-materials/object-oriented/object-oriented-php.php
 */
trait ValidateUuid {
/**
 * validates Uuid string values and objects
 *
 * @param string|Uuid value $newUuid uuid to validate
 * @return validated uuid string
 * @throws \InvalidArgumentException if $newUuid is not valid
 * @throws \RangeException if $newUuid is not valid uuid v4 length
 */

}