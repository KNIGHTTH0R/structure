<?php

function params_array( $page_title, $page_header, $js, $styles, $init ) {
	return [ 'page_title' => $page_title, 'page_header' => $page_header, 'styles' => $styles, 'scripts' => [ 'js' => $js, 'init' => $init ] ];
}