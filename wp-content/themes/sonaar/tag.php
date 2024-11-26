<?php
$iron_sonaar_archive = new Iron_sonaar_Archive();
$iron_sonaar_archive->setPostType( 'post' );
$iron_sonaar_archive->setItemTemplate( 'post_classic' );
$iron_sonaar_archive->compile();

get_template_part('archive');