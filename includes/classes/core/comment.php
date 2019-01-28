<?php
/**
 * Created by Chris.
 * Title: oop
 * Date: 04/12/2017
 * Time: 00:15
 */
	
	namespace Classes\Core;


class Comment extends Db_object
{
	
	private     static  $instance;
	protected static    $db_table = DB_PREFIX."comments";
	protected static    $db_table_fields = array('id', 'show_id', 'author', 'email', 'body', 'created_at');

	public              $id;
	public              $show_id;
	public              $author;
	public              $email;
	public              $body;
	public              $created_at;
	
	public static function instance()
	{
		if(!self::$instance instanceof self){
			self::$instance = new self;
		}
		return self::$instance;
	}

	// Create Comment
	public static function create_comment($show_id, $author, $body) {

		if(!empty($show_id) && !empty($author) && !empty($body)){

			$comment    =   new Comment();

			$comment->show_id         =   (int)$show_id;
			$comment->author           =   $author;
			$comment->body             =   $body;
			$comment->upload_date      =   date("Y-m-d H:i:s");

			return $comment;

		} else {

			return false;

		}

	} // End of create_comment Method
	
	
	/**
	 * Find Comment
	 *
	 * @param $show_id
	 *
	 * @return array
	 */
	public static function find_comments($show_id) {
		global $db;

		$sql    =   "SELECT * FROM " . self::$db_table;
		$sql    .=  " WHERE show_id  = " . $db->escape_string($show_id);
		$sql    .=  " ORDER BY created_at DESC";

		return self::find_by_query($sql);
		
	} // End of Find_comments Method
	
	
	/**
	 * Get comments by showcase author
	 *
	 * @param $author
	 *
	 * @return array|void
	 */
	public static function comments_by_showcase_author( $author )
	{
		
		$author = intval( (int) $author );
		
		$showcases  = Showcase::find_by_user_id( $author );
		$commentArr = [];
		if ( empty( $showcases ) ) {
			return;
		}
		
		foreach ( $showcases as $item ) {
			
			$query = self::find_by_query( "SELECT * FROM `" . self::$db_table . "` WHERE show_id = '" . $item->id . "'" );
			
			$commentArr = array_merge( $commentArr , $query );
			
		}
		
		return $commentArr;
	}
	
	/**
	 * Count comments by showcase author
	 *
	 * @param $author
	 *
	 * @return int|void
	 */
	public static function count_comments_by_showcase_author( $author )
	{
		
		if ( empty( $author ) ) {
			return;
		}
		
		return count( self::comments_by_showcase_author( $author ) );
		
	}


} // End of Comment class