<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 10/17/18
 * Time: 1:22 PM
 */

namespace Michaelbovee\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
/**This is an abbreviated example of what is potentially stored about a user on a site like Flickr. This is a top-level entity and holds keys about other entities, such as photographs and comments.
 *
 * @author Michael Bovee <michael.j.bovee@gmail.com>
 * @version 1.0.0
 */

class Profile{
	use ValidateUuid;
	/**
	 * id for this profile; this is the primary key
	 * @var Uuid $profileId
	 */
	private $profileId;
	/**
	 * display name for this profile; this is a unique attribute
	 * @var string $profileDisplayname
	 */
	private $profileDisplayName;
	/**
	 * email address for this profile; this is a unique attribute
	 * @var string $profileEmail
	 */
	private $profileEmail;
	/**
	 * hash for the password associated with this profile
	 * @var $profileHash
	 */
	private $profileHash;
	/**
	 * real name attributed to user of this profile
	 * @var string $profileRealName
	 */
	private $profileRealName;
	/**
	 * web address associated with this profile
	 * @var string $profileWebAddress
	 */
	private $profileWebAddress;
	/**
	 * constructor for this profile
	 *
	 * @param string|Uuid $newProfileId if this profile is null or if a new profile
	 * @param string $newProfileDisplayName display name of profile
	 * @param string $newProfileEmail email address associated with this account
	 * @param string $newProfileHash hash for password associated with this account
	 * @param string $newProfileRealName real name of profile user
	 * @param string $newProfileWebAddress web address associated with accout
	 * @throws \InvalidArgumentException if data types aren't valid
	 * @throws \RangeException if data values are incorrect lengths
	 * @throws \TypeError if data values are not the right type
	 * @throws \Exception for any other mysqli_sql_exception
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 */
	public function __construct($newProfileId, $newProfileDisplayName, $newProfileEmail, $newProfileHash, $newProfileRealName, $newProfileWebAddress) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileDisplayName($newProfileDisplayName);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileHash($newProfileHash);
			$this->setProfileRealName($newProfileRealName);
			$this->setProfileWebAddress($newProfileWebAddress);
		}
		// determine if/what exception(s) was/were thrown
		catch(\InvalidArgumentException | \RangeException | \TypeError | \Exception $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for profile id
	 *
	 * @return Uuid value of profile id - this will be null if new profile
	 */
	public function getProfileId(): Uuid {
		return($this->profileId);
	}
	/**
	 * mutator method for profile id
	 *
	 * @param Uuid|string $newProfileId value of new profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if the profile Id is not Uuid|string
	 */
	public function setProfileId($newProfileId): void {
		// see if the new profile uuid is valid
		try {
			$uuid = self::validateUuid($newProfileId);
		// throw error if Uuid is not valid
		} catch(\RangeException | \InvalidArgumentException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// store new profile id
		$this->profileId = $uuid;
	}
	/**
	 *accessor method for profile display name
	 *
	 * @return string value of profile display name
	 */
	public function getProfileDisplayName() : ?string {
		return ($this->profileDisplayName);
	}
	/**
	 * mutator method for profile display name
	 *
	 * @param string $newProfileDisplayName value of new profile display name
	 * @throws \InvalidArgumentException if display name is not a string or if it's insecure
	 * @throws \RangeException if length of display name is greater than 32 characters
	 * @throws \TypeError if display name is not a string
	 */
	public function setProfileDisplayName(string $newProfileDisplayName) : void {
		$newProfileDisplayName = trim($newProfileDisplayName);
		$newProfileDisplayName = filter_var($newProfileDisplayName,FILTER_SANITIZE_STRING);
		// verify that the new display name is a string
		if($newProfileDisplayName === false) {
			throw(new \InvalidArgumentException("new profile display name is not a string or is insecure"));
		}
		// verify that the new display name is not too long
		if(strlen($newProfileDisplayName) > 32) {
			throw(new \RangeException("new profile display name is too long"));
		}
		// store the new profile display name
		$this->profileDisplayName = $newProfileDisplayName;
	}
	/**
	 *accessor method for profile email
	 *
	 *@return string value of profile email
	 */
	public function getProfileEmail() : ?string {
		return($this->profileEmail);
	}
	/**
	 * mutator method for profile email
	 *
	 * @param string $newProfileEmail new value of profile email
	 * @throws \InvalidArgumentException if email is not a valid email address or if it's insecure
	 * @throws \RangeException if email string length is greater than 128 characters
	 */
	public function setProfileEmail(string $newProfileEmail): void {
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail, FILTER_VALIDATE_EMAIL);
		// verify email is a valid address
		if($newProfileEmail === false) {
			throw(new \InvalidArgumentException("That is not a valid email address"));
		}
		// verify email is not too long
		if(strlen($newProfileEmail > 128)) {
			throw(new \RangeException("That email address is too long"));
		}
		// store the new email
		$this->profileEmail = $newProfileEmail;
	}
	/**
	 * accessor method for profileHash
	 *
	 * @return string value of hash
	 */
	public function getProfileHash() : string {
		return $this->profileHash;
	}
	/**
	 * mutator method for profile hash
	 *
	 * @param string $newProfileHash  new string value for profile hash
	 * @throws \InvalidArgumentException if hash is not secure
	 * @throws \RangeException if length of hash is not equal to 97 characters
	 */
	public function setProfileHash(string $newProfileHash): void {
		// check hash to make sure it is formatted correctly
		$newProfileHash = trim($newProfileHash);
		if($newProfileHash === false) {
			throw(new \InvalidArgumentException("Profile hash is empty or insecure"));
		}
		// verify the hash is an argon hash
		//$profileHashInfo = password_get_info($newProfileHash);
		//if($profileHashInfo["algoName"] !== "argon2i") {
		//	throw(new \InvalidArgumentException("profile hash is not a valid hash"));
		//}
		// check string length
		if(strlen($newProfileHash) !== 97) {
			throw(new \RangeException("Profile hash must be 97 characters"));
		}
		// store new hash
		$this->profileHash = $newProfileHash;
	}
	/**
	 * accessor method for profile real name
	 *
	 * @return string value of profile real name
	 */
	public function getProfileRealName() : ?string {
		return ($this->profileRealName);
	}
	/**
	 * mutator method for profile real name
	 *
	 * @param string $newProfileRealName new value of profile real name
	 * @throws \InvalidArgumentException if display name is not a string or if it's insecure
	 * @throws \RangeException if length of display name is greater than 32 characters
	 */
	public function setProfileRealName(string $newProfileRealName) : void {
		$newProfileRealName = trim($newProfileRealName);
		$newProfileRealName = filter_var($newProfileRealName, FILTER_SANITIZE_STRING);
		// verify that the new real name is a string
		if($newProfileRealName === false) {
			throw(new \InvalidArgumentException("new profile real name is not a string or is insecure"));
		}
		// verify that the new real name is not too long
		if(strlen($newProfileRealName) > 32) {
			throw(new \RangeException("new profile real name is too long"));
		}
		// store the new real profile name
		$this->profileRealName = $newProfileRealName;
	}
	/**
	 * accessor method for profile web address
	 *
	 * @return string value of profile web address
	 */
	public function getProfileWebAddress() : ?string {
		return ($this->profileWebAddress);
	}
	/**
	 * mutator method for profile web address
	 *
	 * @param string $newProfileWebAddress new value of profile web address
	 * @throws \InvalidArgumentException if web address is not a string or if it's insecure
	 * @throws \RangeException if length of web address is greater than 128 characters
	 */
	public function setProfileWebAddress(string $newProfileWebAddress) : void {
		$newProfileWebAddress = trim($newProfileWebAddress);
		$newProfileWebAddress = filter_var($newProfileWebAddress, FILTER_VALIDATE_URL);
		// verify new web address is valid url
		if($newProfileWebAddress === false) {
			throw(new \InvalidArgumentException("That is not a valid web address"));
		}
		// verify web address isn't too long
		if (strlen($newProfileWebAddress) > 128) {
			throw(new \RangeException("That url is too long"));
		}
		// store new web address
		$this->profileWebAddress = $newProfileWebAddress;
	}

	/**
	 * insert this profile into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors happen
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) : void {
		// create template for query
		$query = "INSERT INTO profile(profileId, profileDisplayName, profileEmail, profileHash, profileRealName, profileWebAddress) VALUES (:profileId, :profileDisplayName, :profileEmail, :profileHash, :profileRealName, :profileWebAddress)";
		$statement = $pdo->prepare($query);

		// wire variables up to their place holders in the template
		$parameters =["profileId" => $this->profileId->getBytes(), "profileDisplayName" => $this->profileDisplayName, "profileEmail" => $this->profileEmail, "profileHash" => $this->profileHash, "profileRealName" => $this->profileRealName, "profileWebAddress" => $this->profileWebAddress];
		$statement->execute($parameters);
	}
	/**
	 * deletes this profile from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a connection object
	 */
	public function delete(\PDO $pdo) : void {
		// create template for query
		$query = "DELETE FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		//wire up variable to place holder in template
		$parameters = ["profileId" => $this->profileId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this profile in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
 	 * @throws \TypeError if $pdo is not a connection object
	 */
	public function update(\PDO $pdo) : void {
		// create template for query
		$query = "UPDATE profile SET profileId = :profileId, profileDisplayName = :profileDisplayName, profileEmail = :profileEmail, profileHash = :profileHash, profileRealName = :profileRealName, profileWebAddress = :profileWebAddress";
		$statement = $pdo->prepare($query);

		//wire up variables to place holders in query
		$parameters =["profileId" => $this->profileId->getBytes(), "profileDisplayName" => $this->profileDisplayName, "profileEmail" => $this->profileEmail, "profileHash" => $this->profileHash, "profileRealName" => $this->profileRealName, "profileWebAddress" => $this->profileWebAddress];
		$statement->execute($parameters);
	}
	/**
	 * get profile by profile id
	 *
	 * @param \PDO $pdo connection object
	 * @param Uuid|string $profileId profile id used in query
	 * @return Profile|null - profile if there's a result, null if there isn't
	 * @throws \PDOException when mySQL errors occur
	 * @throws \TypeError when variables are not correct data type
	 */
	public static function getProfileByProfileId(\PDO $pdo, $profileId) : ?Profile {
		// sanitize string / Uuid
		try {
			$profileId = self::validateUuid($profileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create template for new query
		$query = "SELECT profileId, profileDisplayName, profileEmail, profileHash, profileRealName, profileWebAddress FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		// wire up variable (profile Id) to query
		$parameters = ["profileId" => $profileId->getBytes()];
		$statement->execute($parameters);

		// grab profile from mySQL
		try {
			$profile = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$profile = new Profile($row["profileId"], $row["profileDisplayName"], $row["profileEmail"], $row["profileHash"], $row["profileRealName"], $row["profileWebAddress"]);
			}
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($profile);
	}
	public static function getAllProfiles(\PDO $pdo) : \SplFixedArray {
		// create template for query
		$query = "SELECT profileId, profileDisplayName, profileEmail, profileHash, profileRealName, profileWebAdress FROM profile";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build array of profiles
		$profiles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$profile = new Profile($row["profileId"], $row["profileDisplayName"], $row["profileEmail"], $row["profileHash"], $row["profileRealName"], $row["profileWebAddress"]);
				$profiles[$profiles->key()] = $profile;
				$profiles->next();
			} catch(\Exception $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($profiles);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 */
	public function jsonSerialize() : array {
		$fields = get_object_vars($this);

		$fields["profileId"] = $this->profileId->toString();
		return($fields);
	}
}