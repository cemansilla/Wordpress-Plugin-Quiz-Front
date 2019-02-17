<?php
if(!defined('ABSPATH')) exit;

/**
 * Agrega capabilities para el rol
 */
function quizbook_exam_add_capabilities() {
	$roles = array( 'administrator', 'editor', 'quizbook' );

	foreach( $roles as $the_role ) {
		$role = get_role( $the_role );
		
		if(!is_null($role)){
			$role->add_cap( 'read' );
			$role->add_cap( 'edit_exams' );
			$role->add_cap( 'publish_exams' );
			$role->add_cap( 'edit_published_exams' );
			$role->add_cap( 'edit_others_exams' );
			$role->add_cap( 'delete_exams' );
			$role->add_cap( 'delete_published_exams' );
			$role->add_cap( 'delete_others_exams' );
		}		
	}

	$manager_roles = array( 'administrator', 'editor' );

	foreach( $manager_roles as $the_role ) {
		$role = get_role( $the_role );
		$role->add_cap( 'read_private_exams' );
		$role->add_cap( 'edit_others_exams' );
		$role->add_cap( 'edit_private_exams' );
		$role->add_cap( 'delete_exams' );
		$role->add_cap( 'delete_published_exams' );
		$role->add_cap( 'delete_private_exams' );
		$role->add_cap( 'delete_others_exams' );
	}
}

/**
 * Elimina capabilities para el rol
 */
function quizbook_exam_remove_capabilities() {
	$manager_roles = array( 'administrator', 'editor' );

	foreach( $manager_roles as $the_role ) {
		$role = get_role( $the_role );

		if(!is_null($role)){
			$role->remove_cap( 'read' );
			$role->remove_cap( 'edit_exams' );
			$role->remove_cap( 'publish_exams' );
			$role->remove_cap( 'edit_published_exams' );
			$role->remove_cap( 'read_private_exams' );
			$role->remove_cap( 'edit_others_exams' );
			$role->remove_cap( 'edit_private_exams' );
			$role->remove_cap( 'delete_exams' );
			$role->remove_cap( 'delete_published_exams' );
			$role->remove_cap( 'delete_private_exams' );
			$role->remove_cap( 'delete_others_exams' );
		}
	}
}