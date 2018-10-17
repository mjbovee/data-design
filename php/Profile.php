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
	 * @param string $profileDisplayName
	 * @throws \InvalidArgumentException if display name is not a string or is insecure
	 * @throws \RangeException if display name is > 32 characters
	 * @throws \TypeError if display name is not a string
	 */
	public function setProfileDisplayName(string $newProfileDisplayName) : void {
		$newProfileDisplayName = trim($newProfileDisplayName);
		$newProfileDisplayName = filter_var($newProfileDisplayName,FILTER_SANITIZE_STRING);
		// verify that the new display name is a string
		if($newProfileDisplayName === false) {
			throw new \InvalidArgumentException("new profile name is not a string or is insecure")
		}
		// verify that the new display name is not too long
		if(strlen($newProfileDisplayName) > 32) {
			throw new \RangeException("Your new profile name is too long")
		}
		$this->profileDisplayName = $newProfileDisplayName;
	}
}