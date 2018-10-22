<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 10/22/18
 * Time: 10:44 AM
 */
namespace Michaelbovee\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
/**This is an example of what is potentially stored about a like on a site like Flickr.
 *
 * @author Michael Bovee <michael.j.bovee@gmail.com>
 * @version 1.0.0
 */

class Comment {
	use ValidateDate;
	use ValidateUuid;
	/**
	 * id for this comment; this is the primary key
	 * @var Uuid $commentId
	 */
	private $commentId;
	/**
	 * id for the photo that was commented on; this is a foreign key and an index
	 * @var Uuid $commentPhotoId
	 */
	private $commentPhotoId;
	/**
	 * id for the user that commented on the photo; this is a foreign key and an index
	 * @var Uuid $commentProfileId
	 */
	private $commentProfileId;
	/**
	 * actual string content of this comment
	 * @var string $commentContent
	 */
	private $commentContent;
	/**
	 * date and time this comment occurred, in a PHP DateTime object
	 * @var \DateTime $commentDate
	 */
	private $commentDate;
	/**
	 * accessor method for commentId
	 *
	 * @return Uuid value of commentId
	 */
	public function getCommentId() : Uuid {
		return ($this->commentId);
	}
	/**
	 * mutator method for commentId
	 *
	 *@param Uuid|string $newCommentId new value of comment id
	 *@throws \RangeException if $newCommentId is not positive
	 *@throws \TypeError if $newCommentId is not Uuid or string
	 */
	public function setCommentId() : void {
		try {
			$uuid = self::validateUuid($newCommentId);
		} catch(\RangeException | \InvalidArgumentException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->commentId = $newCommentId;
	}
}