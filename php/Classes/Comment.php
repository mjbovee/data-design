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
	 * constructor for this comment
	 *
	 * @param string|Uuid $newCommentId if this comment is null or a new comment
	 * @param string|Uuid $newCommentPhotoId if this comment is null or a new comment
	 * @param string|Uuid $newCommentProfileId if this comment is null or a new comment
	 * @param string $newCommentContent for content of comment
	 * @param \DateTime $newCommentDate for datetime of comment
	 * @throws \InvalidArgumentException if data types aren't valid
	 * @throws \RangeException if data values are incorrect lengths
	 * @throws \TypeError if data values are wrong type
	 * @throws \Exception for any others
	 */
	public function __construct($newCommentId, $newCommentPhotoId, $newCommentProfileId, $newCommentContent, $newCommentDate) {
		try {
			$this->setCommentId($newCommentId);
			$this->setCommentPhotoId($newCommentPhotoId);
			$this->setCommentProfileId($newCommentProfileId);
			$this->setCommentContent($newCommentContent);
			$this->setCommentDate($newCommentDate);
		}
		catch(\InvalidArgumentException | \RangeException | \TypeError | \Exception $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

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
	public function setCommentId($newCommentId) : void {
		try {
			$uuid = self::validateUuid($newCommentId);
		} catch(\RangeException | \InvalidArgumentException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->commentId = $newCommentId;
	}
	/**
	 * accessor method for commentPhotoId
	 *
	 * @return Uuid value of commentPhotoId
	 */
	public function getCommentPhotoId() : Uuid {
		return ($this->commentPhotoId);
	}
	/**
	 * mutator method for commentPhotoId
	 *
	 *@param Uuid|string $newCommentPhotoId new value of commentPhotoId
	 *@throws \RangeException if $newCommentPhotoId is not positive
	 *@throws \TypeError if $newCommentPhotoId is not Uuid or string
	 */
	public function setCommentPhotoId($newCommentPhotoId) : void {
		try {
			$uuid = self::validateUuid($newCommentPhotoId);
		} catch(\RangeException | \InvalidArgumentException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->commentPhotoId = $newCommentPhotoId;
	}
	/**
	 * accessor method for comment Profile Id
	 *
	 * @return Uuid value of commentProfileId
	 */
	public function getCommentProfileId() : Uuid {
		return ($this->commentProfileId);
	}
	/**
	 * mutator method for commentProfileId
	 *
	 *@param Uuid|string $newCommentProfileId new value of commentProfileId
	 *@throws \RangeException if $newCommentProfileId is not positive
	 *@throws \TypeError if $newCommentProfileId is not Uuid or string
	 */
	public function setCommentProfileId($newCommentProfileId) : void {
		try {
			$uuid = self::validateUuid($newCommentProfileId);
		} catch(\RangeException | \InvalidArgumentException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->commentProfileId = $newCommentProfileId;
	}
	/**
	 * accessor method for comment content
	 *
	 * @return string value of comment content
	 */
	public function getCommentContent() : string {
		return $this->commentContent;
	}

	/**
	 * mutator method for comment content
	 * @param string $newCommentContent
	 */
	public function setCommentContent(string $newCommentContent) : void {
		$newCommentContent = trim($newCommentContent);
		$newCommentContent = filter_var($newCommentContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if($newCommentContent === false) {
			throw(new \InvalidArgumentException("comment content is empty or insecure"));
		}
		if(strlen($newCommentContent) > 1000) {
			throw(new \RangeException("comment content is too large"));
		}
		$this->commentContent = $newCommentContent;
	}
	/**
	 * accessor method for comment date
	 *
	 * @return \DateTime value of comment date
	 */
	public function getCommentDate(): \DateTime {
		return($this->commentDate);
	}

	/**
	 * mutator method for comment date
	 *
	 * @param \DateTime|string|null $newCommentDate comment date as a DateTime object or string (or null to load current time)
	 * @throws \InvalidArgumentException if $newCommentDate is not a valid object or string
	 * @throws \RangeException if $newCommentDate is a date that does not exist
	 * @throws \Exception
	 */
	public function setCommentDate($newCommentDate = null) : void {
		if($newCommentDate === null) {
			$this->commentDate = new \DateTime();
			return;
		}

		try {
			$newCommentDate = self::validateDateTime($newCommentDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->commentDate = $newCommentDate;
	}
	/**
	 * insert this comment into mysql
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) : void {
		// create template for query
		$query = "INSERT INTO comment(commentId, commentPhotoId, commentProfileId, commentContent, commentDate) values(:commentId, :commentPhotoId, :commentProfileId, :commentContent, :commentDate)";
		$statement = $pdo->prepare($query);

		// wire up variables
		$formattedDate = $this->commentDate->format("Y-m-d H:i:s.u");
		$parameters = ["commentId" => $this->commentId->getBytes(), "commentPhotoId" => $this->commentPhotoId->getBytes(), "commentProfileId" => $this->commentProfileId->getBytes(), "commentContent" => $this->commentContent, "commentDate" => $formattedDate];
		$statement->execute($parameters);
	}
	/**
	 * deletes comment from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not PDO connection object
	 */
	public function delete(\PDO $pdo) : void {
		// create template for query
		$query = "DELETE FROM comment WHERE commentId = :commentId";
		$statement = $pdo->prepare($query);

		// wire up variables to template
		$parameters = ["commentId" => $this->commentId->getBytes()];
		$statement->execute($parameters);
	}
	/**
	 * updates comment in sql
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function update(\PDO $pdo) : void {
		// create template for query
		$query = "UPDATE comment SET commentPhotoId = :commentPhotoId, commentProfileId = :commentProfileId, commentContent = :commentContent, commentDate = :commentDate WHERE commentId = :commentId";
		$statement = $pdo->prepare($query);

		// wire up variables
		$formattedDate = $this->commentDate->format("Y-m-d H:i:s.u");
		$parameters = ["commentId" => $this->commentId->getBytes(), "commentPhotoId" => $this->commentPhotoId->getBytes(), "commentProfileId" => $this->commentProfileId->getBytes(), "commentContent" => $this->commentContent, "commentDate" => $formattedDate];
		$statement->execute($parameters);
	}
	/**
	 * get comment by comment id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $commentId comment id used in search
	 * @return Comment|null comment found or null if not found
	 * @throws \PDOException when mySQL errors occur
	 * @throws \TypeError when variables are not correct data type
	 */
	public static function getCommentByCommentId(\PDO $pdo, $commentId) : ?Comment {
		// sanitize commentId before searching
		try {
			$commentId = self::validateUuid($commentId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create template for query
		$query = "SELECT commentId, commentPhotoId, commentProfileId, commentContent, commentDate FROM comment WHERE commentId = :commentId";
		$statement = $pdo->prepare($query);

		//wire up comment id to template
		$parameters = ["commentId" => $commentId->getBytes()];
		$statement->execute($parameters);

		//grab comment from mySQL
		try {
			$comment = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$comment = new Comment($row["commentId"], $row["commentPhotoId"], $row["commentProfileId"],$row["commentContent"], $row["commentDate"]);
			}
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($comment);
	}
	/**
	 * get comment by content
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $commentContent - comment content to include in search
	 * @return \SplFixedArray SplFixedArray of comments found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not correct data type
	 */
	public static function getCommentByCommentContent(\PDO $pdo, string $commentContent) : \SplFixedArray {
		// sanitize input before searching
		$commentContent = trim($commentContent);
		$commentContent = filter_var($commentContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if($commentContent === false) {
			throw(new \PDOException("comment content is invalid"));
		}

		// escape any mySQL wild cards
		$commentContent = str_replace("_", "\\_", str_replace("%", "\\%", $commentContent));

		// create template for query
		$query = "SELECT commentId, commentPhotoId, commentProfileId, commentContent, commentDate FROM comment WHERE commentContent LIKE :commentContent";
		$statement = $pdo->prepare($query);

		// wire up content we want to search to template
		$commentContent = "%$commentContent%";
		$parameters = ["commentContent" => $commentContent];
		$statement->execute($parameters);

		// build array of results
		$comments = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$comment = new Comment($row["commentId"], $row["commentPhotoId"], $row["commentProfileId"],$row["commentContent"], $row["commentDate"]);
				$comments[$comments->key()] = $comment;
				$comments->next();
			} catch(\Exception $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($comments);
	}
	/**
	 * formats state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 */
	public function jsonSerialize() : array {
		$fields = get_object_vars($this);

		$fields["commentId"] = $this->commentId->toString();
		$fields["commentPhotoId"] = $this->commentPhotoId->toString();
		$fields["commentProfileId"] = $this->commentProfileId->toString();

		// format date in digestable way
		$fields["commentDate"] = round(floatval($this->commentDate->format("U.u")) * 1000);
		return($fields);
	}
}