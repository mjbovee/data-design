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
	private static function validateDate($newDate) : \DateTime {
		// check to see if date is already a DateTime object - if so, return object
		if(is_object($newDate) === true && get_class($newDate) === "DateTime") {
			return($newDate);
		}
		// treat date object as a mySQL date string: Y-M-D
		$newDate = trim($newDate);
		// perform regex match - pattern states 'string that starts with a digit value consisting of four places, followed by a digit value consisting of two places, followed by a digit value consisting of two places
		if((preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $newDate, $matches)) !== 1) {
			throw(new \InvalidArgumentException("date is not a valid date"));
		}
		// verify the date is a real calendar date
		$year = intval($matches[1]);
		$month = intval($matches[2]);
		$day = intval($matches[3]);
		if(checkdate($year, $month, $day) === false) {
			throw(new \RangeException("date is not a valid Gregorian date"));
		}
		// at this point in method, the date is clean
		$newDate = \DateTime::createFromFormat("Y-m-d H:i:s", $newDate . " 00:00:00");
		return($newDate);
	}
	/**
	 * custom filter for mySQL style dates
	 *
	 * converts string to a DateTime object - designed to be used within a mutator method
	 *
	 * @param mixed $newDateTime date to validate
	 * @return \DateTime DateTime object containing the validated date
	 * @see http://php.net/manual/en/class.datetime.php PHP's DateTime class
	 * @throws \InvalidArgumentException if the date is in an invalid format
	 * @throws \RangeException if the date is not compliant with Gregorian calendar
	 * @throws \TypeError when type hints fail
	 * @throws \Exception if there are other errors
	 */
	private static function validateDateTime($newDateTime) : \DateTime {
		// check to see if date is valid DateTime object - if so, return object
		if(is_object($newDateTime) === true && get_class($newDateTime) === "DateTime") {
			return($newDateTime);
		}
		// try and catch block
		try {
			list($date, $time) = explode(" ", $newDateTime);
			$date = self::validateDate($date);
			$time = self::validateTime($time);
			list($hour, $minute, $second) = explode(":", $time);
			list($second, $microseconds) = explode(".", $second);
			$date->setTIme($hour, $minute, $second, $microseconds);
			return($date);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
}