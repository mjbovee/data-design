<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 10/18/18
 * Time: 10:27 AM
 */
namespace Foo\Bar\DataDesign;
/**
 * Trait to validate a mySQL date
 *
 * This will validate a mySQL style date and convert string representations into DateTime objects (or throw an exception)
 *
 * @author Michael Bovee <michael.j.bovee@gmail.com> - referencing trait originally authored by Dylan McDonald
 * @version 1.0.0
 */
trait ValidateDate {
	/**
	 * custom filter for mySQL date
	 *
	 * converts string to DateTime object - designed to be used within a mutator method
	 *
	 * @param \DateTime|string $newDate - date to validate
	 * @return \DateTime DateTime object containing validated date
	 * @see http://php.net/manual/en/class.datetime.php PHP's DateTime class
	 * @throws \InvalidArgumentException if date is in invalid format
	 * @throws \RangeException if date is not compliant with Gregorian calendar
	 * @throws \TypeError when type hints fail
	 */
}