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
	protected static    $db_table = "comments";
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


	// Find Comment
	public static function find_comments($show_id) {
		global $db;

		$sql    =   "SELECT * FROM " . self::$db_table;
		$sql    .=  " WHERE show_id  = " . $db->escape_string($show_id);
		$sql    .=  " ORDER BY created_at DESC";

		return self::find_by_query($sql);


	} // End of Find_comments Method
	
	


} // End of Comment class