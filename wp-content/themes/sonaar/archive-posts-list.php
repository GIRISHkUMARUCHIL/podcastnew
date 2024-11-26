<?php
/**
 * Template Name: Blog Posts (List)
 */
$iron_sonaar_archive = new Iron_sonaar_Archive();
$iron_sonaar_archive->setPostType( 'post' );
$iron_sonaar_archive->setItemTemplate( 'post' );
$iron_sonaar_archive->compile();

get_template_part('archive'); ?>