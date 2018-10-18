<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 10/17/18
 * Time: 1:22 PM
 */

/**This is an abbreviated example of what is potentially stored about a user on a site like Flickr. This is a top-level entity and holds keys about other entities, such as photographs and comments.
 *
 * @author Michael Bovee <michael.j.bovee@gmail.com>
 * @version 1.0.0
 */

class Profile {
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
	 * @throws \TypeError if the profile Id is not Uuid
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
	 * @throws \TypeError if hash is not a string
	 */
	public function setProfileHash(string $newProfileHash): void {
		// check hash to make sure it is formatted correctly
		$newProfileHash = trim($newProfileHash);
		if($newProfileHash === false) {
			throw(new \InvalidArgumentException("Profile hash is not secure"));
		}
		// Argon hash???
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
	 * @throws \TypeError if display name is not a string
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
}