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

class Foo {
	use ValidateUuid;
	/**
	 * id for this profile
	 * @var Uuid $profileId
	 */
	private $profileId;
	/**
	 * display name for this profile
	 * @var string $profileDisplayname
	 */
	private $profileDisplayName;
	/**
	 * email address for this profile
	 * @var string $profileEmail
	 */
	private $profileEmail;
	/**
	 * hash for this profile
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
	 * @param
	 */
	public function setProfileId() {

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
	 * @param string value of profileDisplayName
	 * @throws \InvalidArgumentException if display name is not a string or if it's insecure
	 * @throws \RangeException if display name is > 32 characters
	 * @throws \TypeError if display name is not a string
	 */
	public function setProfileDisplayName(string $newProfileDisplayName) : void {
		$newProfileDisplayName = trim($newProfileDisplayName);
		$newProfileDisplayName = filter_var($newProfileDisplayName,FILTER_SANITIZE_STRING);
		// verify that the new display name is a string
		if($newProfileDisplayName === false) {
			throw new \InvalidArgumentException("Your new profile display name is not a string or is insecure");
		}
		// verify that the new display name is not too long
		if(strlen($newProfileDisplayName) > 32) {
			throw new \RangeException("Your new profile display name is too long");
		}
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
	 * @para string value of profile email
	 * @throws \InvalidArgumentException if email is not a valid email address or if it's insecure
	 * @throws \RangeException if email is >
	 *
	 */
	/**
	 * @param string $profileEmail
	 */
	public function setProfileEmail(string $newProfileEmail): void {
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail, FILTER_VALIDATE_EMAIL);
		// verify email is a valid address
		if($newProfileEmail === false) {
			throw new \InvalidArgumentException("That is not a valid email address");
		}
		// verify email is not too long
		if(strlen($newProfileEmail > 128)) {
			throw new \RangeException("That email address is too long");
		}
		$this->profileEmail = $newProfileEmail;
	}

	/**
	 *accessor method for profile real name
	 *
	 * @return string value of profile real name
	 */
	public function getProfileRealName() : ?string {
		return ($this->profileRealName);
	}
	/**
	 * mutator method for profile real name
	 *
	 * @param string value of profile real name
	 * @throws \InvalidArgumentException if display name is not a string or if it's insecure
	 * @throws \RangeException if display name is > 32 characters
	 * @throws \TypeError if display name is not a string
	 */
	public function setProfileRealName(string $newProfileRalName) : void {
		$newProfileRealName = trim($newProfileRealName);
		$newProfileRealName = filter_var($newProfileRealName,FILTER_SANITIZE_STRING);
		// verify that the new real name is a string
		if($newProfileRealName === false) {
			throw new \InvalidArgumentException("Your new profile real name is not a string or is insecure");
		}
		// verify that the new real name is not too long
		if(strlen($newProfileRealName) > 32) {
			throw new \RangeException("Your new profile real name is too long");
		}
		$this->profileRealName = $newProfileRealName;
}